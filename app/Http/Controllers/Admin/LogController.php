<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogController extends Controller
{
    /**
     * Display database activity audit logs (telemetry & everything logs).
     */
    public function activityLogs(Request $request)
    {
        $query = ActivityLog::with('user')->latestFirst();

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('event', 'like', $request->category . '.%');
        }

        if ($request->filled('event') && $request->event !== 'all') {
            $query->where('event', $request->event);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $logs = $query->paginate(25)->withQueryString();

        $eventTypes = ActivityLog::distinct()->pluck('event')->sort()->values();

        return view('admin.logs.activity', compact('logs', 'eventTypes'));
    }

    /**
     * Export activity logs as CSV.
     */
    public function exportActivityLogs()
    {
        $logs = ActivityLog::with('user')->latestFirst()->get();

        $csvHeader = ['ID', 'Event', 'Description', 'User', 'Role', 'IP Address', 'User Agent', 'Payload', 'Timestamp'];
        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, $csvHeader);

        foreach ($logs as $l) {
            fputcsv($handle, [
                $l->id,
                $l->event,
                $l->description,
                $l->user ? $l->user->name . " ({$l->user->email})" : 'Guest / System',
                $l->user ? $l->user->role : 'N/A',
                $l->ip_address,
                $l->user_agent,
                json_encode($l->properties),
                $l->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        ActivityLogger::log('admin.export_activity_logs', 'Exported Activity Audit Logs CSV');

        return response($content, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="famewoven-activity-logs-' . date('Ymd-His') . '.csv"',
        ]);
    }

    /**
     * Display server and Laravel storage logs (storage/logs/laravel.log).
     */
    public function systemLogs(Request $request)
    {
        $logPath = storage_path('logs/laravel.log');
        $entries = [];
        $fileSize = 0;

        if (File::exists($logPath)) {
            $fileSize = File::size($logPath);
            $content = File::get($logPath);
            $pattern = '/^\[(?<date>\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\] (?<env>\w+)\.(?<level>[A-Z]+): (?<message>.*?)(?=\n\[\d{4}-\d{2}-\d{2}|\z)/ms';

            if (preg_match_all($pattern, $content, $matches, PREG_SET_ORDER)) {
                foreach (array_reverse($matches) as $match) {
                    $entryLevel = strtoupper($match['level']);
                    $entryMessage = trim($match['message']);

                    // Level filter
                    if ($request->filled('level') && $request->level !== 'all' && $entryLevel !== strtoupper($request->level)) {
                        continue;
                    }

                    // Search filter
                    if ($request->filled('search')) {
                        $search = trim($request->search);
                        if (stripos($entryMessage, $search) === false && stripos($match['date'], $search) === false) {
                            continue;
                        }
                    }

                    $parts = explode("\n[stacktrace]\n", $entryMessage, 2);
                    $headerMessage = $parts[0];
                    $stackTrace = $parts[1] ?? null;

                    $entries[] = [
                        'date' => $match['date'],
                        'env' => $match['env'],
                        'level' => $entryLevel,
                        'message' => $headerMessage,
                        'stacktrace' => $stackTrace,
                    ];

                    if (count($entries) >= 100) {
                        break;
                    }
                }
            }
        }

        return view('admin.logs.system', compact('entries', 'fileSize'));
    }

    /**
     * Clear the system log file.
     */
    public function clearSystemLogs()
    {
        $logPath = storage_path('logs/laravel.log');

        if (File::exists($logPath)) {
            File::put($logPath, '');
            ActivityLogger::log('admin.log_clear', 'Cleared server storage/logs/laravel.log');
        }

        return back()->with('success', 'System log file cleared successfully.');
    }

    /**
     * Download the raw log file.
     */
    public function downloadSystemLogs()
    {
        $logPath = storage_path('logs/laravel.log');

        if (!File::exists($logPath)) {
            return back()->with('error', 'Log file does not exist yet.');
        }

        return response()->download($logPath, 'laravel-' . date('Y-m-d') . '.log');
    }
}
