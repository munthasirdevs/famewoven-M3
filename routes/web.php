<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InquiryController;

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

// Fallback Route (404 Page)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
