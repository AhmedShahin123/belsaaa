<?php

use App\Http\Controllers\Backend\DashboardController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['namespace' => 'Task'], function () {
    Route::resource('task', 'TaskController');
    Route::post('task/{task}/assign', 'TaskController@assign')->name('backend.task.assign');
});
Route::group(['namespace' => 'Employer'], function () {
    Route::resource('employer', 'EmployerController');
});
Route::group(['namespace' => 'Tasker'], function () {
    Route::get('tasker/working_days', 'TaskerController@workingDays');
    Route::resource('tasker', 'TaskerController');
});
Route::group(['namespace' => 'City'], function () {
    Route::resource('city', 'CityController');
});
Route::group(['namespace' => 'Skill'], function () {
    Route::resource('skill', 'SkillController');
});
Route::group(['namespace' => 'Notification'], function () {
    Route::resource('notification', 'NotificationController');
});
Route::group(['namespace' => 'Auth\OAuth', 'prefix' => 'auth/oauth'], function () {
    Route::resource('token', 'TokenController');
});
Route::group(['namespace' => 'Auth\OAuth', 'prefix' => 'auth/oauth'], function () {
    Route::resource('client', 'ClientController');
});
Route::group(['namespace' => 'Contact', 'prefix' => 'contact'], function () {
    Route::resource('contact_category', 'ContactCategoryController');
});

Route::group(['namespace' => 'Invoice', 'prefix' => 'invoice'], function () {
    Route::resource('invoice', 'InvoiceController')->only([]);
    Route::put('/{invoice}/pay_commission', 'InvoiceController@payCommission');
    Route::put('/{invoice}/clear_tasker_amount', 'InvoiceController@clearTaskerAmount');
    Route::put('/{employer}/pay_employer_commissions', 'InvoiceController@payAllEmployerCommission');
    Route::put('/{tasker}/clear_tasker_amounts', 'InvoiceController@clearAllTaskerAmount');
});
