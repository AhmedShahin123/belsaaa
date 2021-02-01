<?php

use App\Http\Controllers\Api\Employer\AssignmentRequestTasker\AcceptAssignmentRequestTaskerController;
use App\Http\Controllers\Api\Employer\AssignmentRequestTasker\IndexAssignmentRequestTasker;
use App\Http\Controllers\Api\Employer\AssignmentRequestTasker\RateAssignmentRequestTaskerController;
use App\Http\Controllers\Api\Employer\AssignmentRequestTasker\RejectAssignmentRequestTaskerController;
use App\Http\Controllers\Api\Employer\Auth\ChangePasswordController;
use App\Http\Controllers\Api\Employer\Auth\PhoneVerificationController;
use App\Http\Controllers\Api\Employer\Auth\RecoverForgottenPasswordController;
use App\Http\Controllers\Api\Employer\Auth\RegisterController;
use App\Http\Controllers\Api\Employer\Auth\LoginController;
use App\Http\Controllers\Api\Employer\Auth\ForgetPasswordController;
use App\Http\Controllers\Api\Employer\Auth\VerifyForgetPasswordController;
use App\Http\Controllers\Api\Employer\City\IndexCityController;
use App\Http\Controllers\Api\Employer\Contact\IndexContactCategoryController;
use App\Http\Controllers\Api\Employer\Contact\SubmitContactController;
use App\Http\Controllers\Api\Employer\CreditCard\CreateCreditCardController;
use App\Http\Controllers\Api\Employer\CreditCard\DeleteCreditCardController;
use App\Http\Controllers\Api\Employer\CreditCard\GetCreditCardFormLinkController;
use App\Http\Controllers\Api\Employer\CreditCard\IndexCreditCardController;
use App\Http\Controllers\Api\Employer\Device\RegisterDeviceController;
use App\Http\Controllers\Api\Employer\Employer\ShowEmployerController;
use App\Http\Controllers\Api\Employer\Employer\UpdateEmployerController;
use App\Http\Controllers\Api\Employer\Invoice\IndexInvoicesController;
use App\Http\Controllers\Api\Employer\Invoice\PayInvoiceController;
use App\Http\Controllers\Api\Employer\Notification\IndexNotificationController;
use App\Http\Controllers\Api\Employer\Notification\MarkAsReadNotificationController;
use App\Http\Controllers\Api\Employer\Tasker\IndexRatingForTaskerController;
use App\Http\Controllers\Api\Employer\Settings\IndexSettingsController;
use App\Http\Controllers\Api\Employer\Task\CancelTaskController;
use App\Http\Controllers\Api\Employer\Task\CreateTaskController;
use App\Http\Controllers\Api\Employer\Task\IndexTaskController;
use App\Http\Controllers\Api\Employer\Task\PayTaskController;
use App\Http\Controllers\Api\Employer\Task\ShowTaskController;
use App\Http\Controllers\Api\Employer\Task\StartTaskController;
use App\Http\Controllers\Api\Employer\Task\Status\IndexTaskStatusController;
use App\Http\Controllers\Api\Employer\Tasker\ShowTaskerController;

Route::group(['prefix' => 'employer', 'as' => 'employer.'], function () {
    Route::post('device', [RegisterDeviceController::class, '__invoke']);
    Route::post('register', [RegisterController::class, '__invoke']);
    Route::post('login', [LoginController::class, '__invoke']);
    Route::post('password/forget', [ForgetPasswordController::class, '__invoke']);

    // Setting Resource
    Route::get('setting', [IndexSettingsController::class, '__invoke']);

    // Contact Resource
    Route::get('contact/contact_category', [IndexContactCategoryController::class, '__invoke']);
    Route::post('contact/contact', [SubmitContactController::class, '__invoke']);

    // Rating Resource
    Route::get('tasker/{tasker}/rating', [IndexRatingForTaskerController::class, '__invoke']);
    Route::get('tasker/{tasker}', [ShowTaskerController::class, '__invoke']);

    Route::group(['middleware' => ['auth:api']], function () {
        Route::group(['middleware' => ['scope:employer_forget_password_verify']], function () {
            Route::post('password/verify', [VerifyForgetPasswordController::class, '__invoke']);
        });
        Route::group(['middleware' => ['scope:employer_forget_password_recover']], function () {
            Route::post('password/recover', [RecoverForgottenPasswordController::class, '__invoke']);
        });

        Route::group(['middleware' => ['scope:employer']], function () {
            // Notification Resource
            Route::get('notification', [IndexNotificationController::class, '__invoke']);
            Route::put('notification/{notification}', [MarkAsReadNotificationController::class, '__invoke']);

            // Employer Resource
            Route::get('employer', [ShowEmployerController::class, '__invoke']);
            Route::post('employer', [UpdateEmployerController::class, '__invoke']);

            // Auth
            Route::put('password/change', [ChangePasswordController::class, '__invoke']);
            Route::put('phone/verify', [PhoneVerificationController::class, 'verify']);
            Route::put('phone/resend', [PhoneVerificationController::class, 'resend']);

            // Phone Verified Scope
            Route::group(['middleware' => ['verified_phone']], function () {
                // Task Resource
                Route::post('task', [CreateTaskController::class, '__invoke']);
                Route::get('task', [IndexTaskController::class, '__invoke']);
                Route::get('task/{taskId}', [ShowTaskController::class, '__invoke'])->where('taskId', '[0-9]+');
                Route::put('task/{task}/cancel', [CancelTaskController::class, '__invoke']);
                Route::put('task/{task}/start', [StartTaskController::class, '__invoke']);
                Route::put('task/{task}/pay', [PayTaskController::class, '__invoke']);

                // Task Status Resource
                Route::get('task/status', [IndexTaskStatusController::class, '__invoke']);

                // City Resource
                Route::get('city', [IndexCityController::class, '__invoke']);

                // AssignmentRequestTasker Resource
                Route::post(
                    'assignment_request_tasker/{assignmentRequestTasker}/rating',
                    [RateAssignmentRequestTaskerController::class, '__invoke']
                );
                Route::put(
                    'assignment_request_tasker/{assignmentRequestTasker}/accept',
                    [AcceptAssignmentRequestTaskerController::class, '__invoke']
                );
                Route::put(
                    'assignment_request_tasker/{assignmentRequestTasker}/reject',
                    [RejectAssignmentRequestTaskerController::class, '__invoke']
                );
                Route::get(
                    'assignment_request_tasker',
                    [IndexAssignmentRequestTasker::class, '__invoke']
                );

                // Credit Card Resource
                Route::post('credit_card', [CreateCreditCardController::class, '__invoke']);
                Route::get('credit_card/link', [GetCreditCardFormLinkController::class, '__invoke']);
                Route::get('credit_card', [IndexCreditCardController::class, '__invoke']);
                Route::delete('credit_card/{creditCardId}', [DeleteCreditCardController::class, '__invoke']);

                // Invoice Resource
                Route::get('invoice', [IndexInvoicesController::class, '__invoke']);
            });
        });
    });
});

