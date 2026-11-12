<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\CreatorApplication;
use App\Models\NewsletterSubscription;
use App\Models\StrategyCall;
use App\Models\User;
use App\Models\VisitorTraffic;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Render the admin dashboard with real-time operational telemetry.
     */
    public function index()
    {
        $metrics = [
            'strategy_calls' => [
                'total' => StrategyCall::count(),
                'pending' => StrategyCall::where('status', 'pending')->count(),
                'contacted' => StrategyCall::where('status', 'contacted')->count(),
            ],
            'creators' => [
                'total' => CreatorApplication::count(),
                'pending' => CreatorApplication::where('status', 'pending')->count(),
                'accepted' => CreatorApplication::where('status', 'accepted')->count(),
            ],
            'subscribers' => [
                'total' => NewsletterSubscription::count(),
                'active' => NewsletterSubscription::subscribed()->count(),
            ],
            'logs' => [
                'total' => ActivityLog::count(),
                'today' => ActivityLog::where('created_at', '>=', now()->startOfDay())->count(),
            ],
            'users' => [
                'total' => User::count(),
                'active' => User::where('status', 'active')->count(),
            ],
            'traffic' => [
                'total' => VisitorTraffic::count(),
                'today' => VisitorTraffic::whereDate('created_at', today())->count(),
                'uniques' => VisitorTraffic::distinct('visitor_id')->count('visitor_id'),
            ],
        ];

        $recentStrategyCalls = StrategyCall::latest()->take(5)->get();
        $recentCreators = CreatorApplication::latest()->take(5)->get();
        $recentActivities = ActivityLog::with('user')->latestFirst()->take(8)->get();

        $systemInfo = [
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'database' => config('database.default') . ' (' . DB::connection()->getDatabaseName() . ')',
            'server_time' => now()->format('Y-m-d H:i:s T'),
            'env' => app()->environment(),
        ];

        return view('admin.dashboard', compact(
            'metrics',
            'recentStrategyCalls',
            'recentCreators',
            'recentActivities',
            'systemInfo'
        ));
    }
}
