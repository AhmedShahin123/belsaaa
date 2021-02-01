<?php

use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\LanguageController;

/*
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LanguageController::class, 'swap']);

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.', 'domain' => config('app.front_domain')], function () {
    include_route_files(__DIR__.'/frontend/');
});

/*
 * Payment Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Payment', 'as' => 'payment.', 'prefix' => 'payment', 'domain' => config('app.front_domain')], function () {
    include_route_files(__DIR__.'/payment/');
});

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'as' => 'admin.', 'domain' => config('app.admin_domain')], function () {

    Route::group(['middleware' => 'guest'], function () {
        // Authentication Routes
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.post');
    });

    Route::group(['middleware' => 'admin'], function() {
        /*
         * These routes need view-backend permission
         * (good if you want to allow more than one group in the backend,
         * then limit the backend features by different roles or permissions)
         *
         * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
         * These routes can not be hit if the password is expired
         */
        include_route_files(__DIR__.'/backend/');
    });
});
