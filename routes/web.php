<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\NewsletterController;

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
