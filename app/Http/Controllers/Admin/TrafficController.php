<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorTraffic;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TrafficController extends Controller
{
    /**
     * Executive Traffic Overview Dashboard.
     */
    public function index(Request $request)
    {
        $period = $request->input('period', '30d');
        $filterBot = $request->input('filter_bot', '0') === '1'; // default false: humans only

        // Base query
        $baseQuery = VisitorTraffic::query();
        if (!$filterBot) {
            $baseQuery->humans();
        }
        $baseQuery->period($period);

        // Core KPIs
        $totalPageviews = (clone $baseQuery)->count();
        $uniqueVisitors = (clone $baseQuery)->distinct('visitor_id')->count('visitor_id');
        $totalSessions = (clone $baseQuery)->whereNotNull('session_id')->distinct('session_id')->count('session_id');
        $avgViewsPerSession = $totalSessions > 0 ? round($totalPageviews / $totalSessions, 1) : ($totalPageviews > 0 ? 1.0 : 0.0);

        // Today's Real-time Live Counters
        $todayPageviews = VisitorTraffic::humans()->whereDate('created_at', today())->count();
        $todayUniques = VisitorTraffic::humans()->whereDate('created_at', today())->distinct('visitor_id')->count('visitor_id');
        $todayBots = VisitorTraffic::bots()->whereDate('created_at', today())->count();

        // Top Visited Pages (Paths)
        $topPages = (clone $baseQuery)
            ->select('path', DB::raw('count(*) as views'), DB::raw('count(distinct visitor_id) as uniques'))
            ->groupBy('path')
            ->orderByDesc('views')
            ->limit(10)
            ->get();

        // Top Referrers
        $topReferrers = (clone $baseQuery)
            ->select('referer_domain', DB::raw('count(*) as count'))
            ->groupBy('referer_domain')
            ->orderByDesc('count')
            ->limit(8)
            ->get();

        // Device Breakdown
        $devices = (clone $baseQuery)
            ->select('device_type', DB::raw('count(*) as count'))
            ->groupBy('device_type')
            ->orderByDesc('count')
            ->get();

        // Browser Breakdown
        $browsers = (clone $baseQuery)
            ->select('browser', DB::raw('count(*) as count'))
            ->groupBy('browser')
            ->orderByDesc('count')
            ->limit(6)
            ->get();

        // OS Breakdown
        $operatingSystems = (clone $baseQuery)
            ->select('os', DB::raw('count(*) as count'))
            ->groupBy('os')
            ->orderByDesc('count')
            ->limit(6)
            ->get();

        // Daily Traffic Trend (last 14 days or chosen period)
        $timelineDays = match ($period) {
            'today', '24h' => 1,
            '7d' => 7,
            '30d' => 14,
            default => 14,
        };

        $chartData = [];
        $maxDailyViews = 1;

        for ($i = $timelineDays - 1; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            $label = $date->format('M d');

            $dayViews = VisitorTraffic::query()
                ->when(!$filterBot, fn($q) => $q->humans())
                ->whereDate('created_at', $date)
                ->count();

            $dayUniques = VisitorTraffic::query()
                ->when(!$filterBot, fn($q) => $q->humans())
                ->whereDate('created_at', $date)
                ->distinct('visitor_id')
                ->count('visitor_id');

            if ($dayViews > $maxDailyViews) {
                $maxDailyViews = $dayViews;
            }

            $chartData[] = [
                'date' => $dateStr,
                'label' => $label,
                'views' => $dayViews,
                'uniques' => $dayUniques,
            ];
        }

        // Recent 10 Live Visitor Hits
        $recentHits = VisitorTraffic::latest()->limit(10)->get();

        return view('admin.traffic.index', compact(
            'period',
            'filterBot',
            'totalPageviews',
            'uniqueVisitors',
            'totalSessions',
            'avgViewsPerSession',
            'todayPageviews',
            'todayUniques',
            'todayBots',
            'topPages',
            'topReferrers',
            'devices',
            'browsers',
            'operatingSystems',
            'chartData',
            'maxDailyViews',
            'recentHits'
        ));
    }

    /**
     * Dedicated Granular Visitor Stream & Audit Table ("All details and everything").
     */
    public function visitors(Request $request)
    {
        $query = VisitorTraffic::latest();

        // Search
        if ($request->filled('search')) {
            $term = trim($request->search);
            $query->where(function ($q) use ($term) {
                $q->where('path', 'like', "%{$term}%")
                  ->orWhere('visitor_id', 'like', "%{$term}%")
                  ->orWhere('ip_address', 'like', "%{$term}%")
                  ->orWhere('referer', 'like', "%{$term}%")
                  ->orWhere('referer_domain', 'like', "%{$term}%");
            });
        }

        // Filter by Device
        if ($request->filled('device') && $request->device !== 'all') {
            $query->where('device_type', $request->device);
        }

        // Filter by Browser
        if ($request->filled('browser') && $request->browser !== 'all') {
            $query->where('browser', $request->browser);
        }

        // Filter by Bot vs Human
        if ($request->filled('bot_filter')) {
            if ($request->bot_filter === 'humans') {
                $query->humans();
            } elseif ($request->bot_filter === 'bots') {
                $query->bots();
            }
        }

        // Filter by Status Code
        if ($request->filled('status_code') && $request->status_code !== 'all') {
            $query->where('status_code', (int) $request->status_code);
        }

        // Filter by Timeframe
        if ($request->filled('period') && $request->period !== 'all') {
            $query->period($request->period);
        }

        $visitors = $query->paginate(25)->withQueryString();

        $counts = [
            'total_hits' => VisitorTraffic::count(),
            'unique_visitors' => VisitorTraffic::distinct('visitor_id')->count('visitor_id'),
            'human_hits' => VisitorTraffic::humans()->count(),
            'bot_hits' => VisitorTraffic::bots()->count(),
            'today_hits' => VisitorTraffic::whereDate('created_at', today())->count(),
        ];

        return view('admin.traffic.visitors', compact('visitors', 'counts'));
    }

    /**
     * Export Visitor Traffic Analytics to CSV.
     */
    public function export(Request $request)
    {
        $query = VisitorTraffic::latest();

        if ($request->input('filter_bot', '0') === '0') {
            $query->humans();
        }

        if ($request->filled('period') && $request->period !== 'all') {
            $query->period($request->period);
        }

        $logs = $query->limit(5000)->get();

        $csvHeader = [
            'Hit ID',
            'Visitor ID Token',
            'Session ID',
            'HTTP Method',
            'Path',
            'Full URL',
            'Referrer',
            'Referrer Domain',
            'Anonymized IP (GDPR)',
            'Device Category',
            'Browser',
            'Operating System',
            'HTTP Status Code',
            'Is Bot Crawler',
            'Timestamp (UTC)'
        ];

        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, $csvHeader);

        foreach ($logs as $log) {
            fputcsv($handle, [
                $log->id,
                $log->visitor_id,
                $log->session_id ?? 'N/A',
                $log->method,
                $log->path,
                $log->url,
                $log->referer ?? 'Direct / None',
                $log->referer_domain ?? 'Direct / None',
                $log->ip_address ?? '127.0.0.xxx',
                $log->device_type,
                $log->browser,
                $log->os,
                $log->status_code,
                $log->is_bot ? 'YES' : 'NO',
                $log->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        ActivityLogger::log('admin.traffic_export', 'Exported visitor traffic dataset CSV (' . count($logs) . ' records)');

        return response($content, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="famewoven-traffic-analytics-' . date('Ymd-His') . '.csv"',
        ]);
    }

    /**
     * Purge old visitor traffic records (Admin / Super Admin).
     */
    public function purge(Request $request)
    {
        $days = (int) $request->input('days', 90);
        $cutoff = Carbon::now()->subDays($days);

        $deletedCount = VisitorTraffic::where('created_at', '<', $cutoff)->delete();

        ActivityLogger::log('admin.traffic_purge', "Purged {$deletedCount} visitor traffic logs older than {$days} days");

        return back()->with('success', "Purged {$deletedCount} visitor records older than {$days} days.");
    }
}
