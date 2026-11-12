<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StrategyCallController;
use App\Http\Controllers\Admin\CreatorApplicationController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;

// Admin Authentication Routes (Guest accessible)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Protected Admin Panel Routes
Route::middleware(['role'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Strategy Inquiries
    Route::get('/strategy-calls', [StrategyCallController::class, 'index'])->name('strategy-calls.index');
    Route::get('/strategy-calls/export', [StrategyCallController::class, 'export'])->name('strategy-calls.export')->middleware('role:super_admin,admin');
    Route::get('/strategy-calls/{strategyCall}', [StrategyCallController::class, 'show'])->name('strategy-calls.show');
    Route::patch('/strategy-calls/{strategyCall}', [StrategyCallController::class, 'update'])->name('strategy-calls.update')->middleware('role:super_admin,admin,editor');

    // Creator Applications
    Route::get('/creators', [CreatorApplicationController::class, 'index'])->name('creators.index');
    Route::get('/creators/export', [CreatorApplicationController::class, 'export'])->name('creators.export')->middleware('role:super_admin,admin');
    Route::get('/creators/{creator}', [CreatorApplicationController::class, 'show'])->name('creators.show');
    Route::patch('/creators/{creator}', [CreatorApplicationController::class, 'update'])->name('creators.update')->middleware('role:super_admin,admin,editor');

    // Newsletter Subscribers
    Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
    Route::get('/subscribers/export', [SubscriberController::class, 'export'])->name('subscribers.export')->middleware('role:super_admin,admin');
    Route::patch('/subscribers/{subscriber}/toggle', [SubscriberController::class, 'toggle'])->name('subscribers.toggle')->middleware('role:super_admin,admin,editor');
    Route::delete('/subscribers/{subscriber}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy')->middleware('role:super_admin,admin');

    // Activity Logs & Audit Trail
    Route::get('/logs/activity', [LogController::class, 'activityLogs'])->name('logs.activity');
    Route::get('/logs/activity/export', [LogController::class, 'exportActivityLogs'])->name('logs.activity.export')->middleware('role:super_admin,admin');

    // System Logs (Laravel Log Viewer)
    Route::middleware(['role:super_admin,admin'])->group(function () {
        Route::get('/logs/system', [LogController::class, 'systemLogs'])->name('logs.system');
        Route::get('/logs/system/download', [LogController::class, 'downloadSystemLog'])->name('logs.system.download');
        Route::post('/logs/system/clear', [LogController::class, 'clearSystemLog'])->name('logs.system.clear');
    });

    // User Governance & RBAC (Admin / Super Admin only)
    Route::middleware(['role:super_admin,admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Staff Profile & Password
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

// Core Public Pages
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', [InquiryController::class, 'showContact'])->name('contact');
Route::post('/contact', [InquiryController::class, 'storeStrategyCall'])->name('contact.store');

Route::get('/creators', [InquiryController::class, 'showCreators'])->name('creators');
Route::post('/creators', [InquiryController::class, 'storeCreatorApplication'])->name('creators.store');

Route::post('/subscribe', [NewsletterController::class, 'store'])->name('newsletter.store');

// Services Catalog & Subpages
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', function () {
        return view('services.index');
    })->name('index');

    Route::get('/{slug}', function (string $slug) {
        $viewName = 'services.' . str_replace('-', '_', $slug);
        if (view()->exists($viewName)) {
            return view($viewName);
        }
        $altViewName = 'services.' . $slug;
        if (view()->exists($altViewName)) {
            return view($altViewName);
        }
        abort(404);
    })->name('show');
});

// Work Portfolio
Route::prefix('work')->name('work.')->group(function () {
    Route::get('/', function () {
        return view('work.index');
    })->name('index');

    Route::get('/case-study', function () {
        return view('work.case-study');
    })->name('case-study');
});

// Insights
Route::get('/insights', function () {
    return view('insights.index');
})->name('insights');

// SEO Endpoints
Route::get('/robots.txt', function () {
    return response(file_get_contents(public_path('robots.txt')), 200, ['Content-Type' => 'text/plain']);
});

Route::get('/sitemap.xml', function () {
    return response(file_get_contents(public_path('sitemap.xml')), 200, ['Content-Type' => 'application/xml']);
});

// Fallback Route (404 Page)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
