<?php

use App\Http\Controllers\Api\Tasker\AssignmentRequestTasker\AcceptAssignmentRequestTaskerController;
use App\Http\Controllers\Api\Tasker\AssignmentRequestTasker\IndexAssignmentRequestTasker;
use App\Http\Controllers\Api\Tasker\AssignmentRequestTasker\RejectAssignmentRequestTaskerController;
use App\Http\Controllers\Api\Tasker\AssignmentRequestTasker\ShowAssignmentRequestTasker;
use App\Http\Controllers\Api\Tasker\Auth\ChangePasswordController;
use App\Http\Controllers\Api\Tasker\Auth\PhoneVerificationController;
use App\Http\Controllers\Api\Tasker\Auth\RecoverForgottenPasswordController;
use App\Http\Controllers\Api\Tasker\Auth\RegisterController;
use App\Http\Controllers\Api\Tasker\Auth\LoginController;
use App\Http\Controllers\Api\Tasker\Auth\ForgetPasswordController;
use App\Http\Controllers\Api\Tasker\Auth\VerifyForgetPasswordController;
use App\Http\Controllers\Api\Tasker\BankAccount\CreateBankAccountController;
use App\Http\Controllers\Api\Tasker\BankAccount\IndexBankAccountsController;
use App\Http\Controllers\Api\Tasker\BankAccount\MakeBankAccountDefaultController;
use App\Http\Controllers\Api\Tasker\City\IndexCityController;
use App\Http\Controllers\Api\Tasker\Contact\IndexContactCategoryController;
use App\Http\Controllers\Api\Tasker\Contact\SubmitContactController;
use App\Http\Controllers\Api\Tasker\CreditCard\CreateCreditCardController;
use App\Http\Controllers\Api\Tasker\CreditCard\DeleteCreditCardController;
use App\Http\Controllers\Api\Tasker\CreditCard\IndexCreditCardController;
use App\Http\Controllers\Api\Tasker\Device\RegisterDeviceController;
use App\Http\Controllers\Api\Tasker\Invoice\IndexInvoicesController;
use App\Http\Controllers\Api\Tasker\Notification\IndexNotificationController;
use App\Http\Controllers\Api\Tasker\Employer\IndexRatingForEmployerController;
use App\Http\Controllers\Api\Tasker\Notification\MarkAsReadNotificationController;
use App\Http\Controllers\Api\Tasker\Settings\IndexSettingsController;
use App\Http\Controllers\Api\Tasker\Skill\IndexSkillController;
use App\Http\Controllers\Api\Tasker\Task\CancelTaskController;
use App\Http\Controllers\Api\Tasker\Task\IndexTaskController;
use App\Http\Controllers\Api\Tasker\Task\RateTaskController;
use App\Http\Controllers\Api\Tasker\Task\ShowTaskController;
use App\Http\Controllers\Api\Tasker\Task\Status\IndexTaskStatusController;
use App\Http\Controllers\Api\Tasker\Tasker\ShowTaskerController;
use App\Http\Controllers\Api\Tasker\Tasker\UpdatePhotoController;
use App\Http\Controllers\Api\Tasker\Tasker\UpdateTaskerController;

Route::group(['prefix' => 'tasker', 'as' => 'tasker.'], function () {
    Route::post('device', [RegisterDeviceController::class, '__invoke']);
    Route::post('register', [RegisterController::class, '__invoke']);
    Route::post('login', [LoginController::class, '__invoke']);
    Route::post('password/forget', [ForgetPasswordController::class, '__invoke']);

    // Setting Resource
    Route::get('setting', [IndexSettingsController::class, '__invoke']);

    // City Resource
    Route::get('city', [IndexCityController::class, '__invoke']);

    // Contact Resource
    Route::get('contact/contact_category', [IndexContactCategoryController::class, '__invoke']);
    Route::post('contact/contact', [SubmitContactController::class, '__invoke']);

    // Rating Resource
    Route::get('employer/{employer}/rating', [IndexRatingForEmployerController::class, '__invoke']);

    Route::group(['middleware' => ['auth:api']], function () {
        Route::group(['middleware' => ['scope:tasker_forget_password_verify']], function () {
            Route::post('password/verify', [VerifyForgetPasswordController::class, '__invoke']);
        });
        Route::group(['middleware' => ['scope:tasker_forget_password_recover']], function () {
            Route::post('password/recover', [RecoverForgottenPasswordController::class, '__invoke']);
        });

        Route::group(['middleware' => ['scope:tasker']], function () {
            // Notification Resource
            Route::get('notification', [IndexNotificationController::class, '__invoke']);
            Route::put('notification/{notification}', [MarkAsReadNotificationController::class, '__invoke']);

            // Tasker Resource
            Route::get('tasker', [ShowTaskerController::class, '__invoke']);

            // Auth
            Route::put('password/change', [ChangePasswordController::class, '__invoke']);
            Route::put('phone/verify', [PhoneVerificationController::class, 'verify']);
            Route::put('phone/resend', [PhoneVerificationController::class, 'resend']);

            // Phone Verified Scope
            Route::group(['middleware' => ['verified_phone']], function () {
                // Skill Resource
                Route::get('skill', [IndexSkillController::class, '__invoke']);

                // Tasker Resource
                Route::post('tasker/photo', [UpdatePhotoController::class, '__invoke']);
                Route::put('tasker', [UpdateTaskerController::class, '__invoke']);

                // Task Resource
                Route::get('task', [IndexTaskController::class, '__invoke']);
                Route::get('task/{taskId}', [ShowTaskController::class, '__invoke'])->where('taskId', '[0-9]+');
                Route::put('task/{task}/cancel', [CancelTaskController::class, '__invoke']);
                Route::post('task/{task}/rating', [RateTaskController::class, '__invoke']);

                // Task Status Resource
                Route::get('task/status', [IndexTaskStatusController::class, '__invoke']);

                // AssignmentRequestTasker Resource
                Route::get(
                    'assignment_request_tasker',
                    [IndexAssignmentRequestTasker::class, '__invoke']
                );
                Route::get(
                    'assignment_request_tasker/{assignmentRequestTasker}',
                    [ShowAssignmentRequestTasker::class, '__invoke']
                );
                Route::put(
                    'assignment_request_tasker/{assignmentRequestTasker}/accept',
                    [AcceptAssignmentRequestTaskerController::class, '__invoke']
                );
                Route::put(
                    'assignment_request_tasker/{assignmentRequestTasker}/reject',
                    [RejectAssignmentRequestTaskerController::class, '__invoke']
                );

//                // Credit Card Resource
//                Route::post('credit_card', [CreateCreditCardController::class, '__invoke']);
//                Route::get('credit_card', [IndexCreditCardController::class, '__invoke']);
//                Route::delete('credit_card/{creditCardId}', [DeleteCreditCardController::class, '__invoke']);

                // Bank Account Resource
                Route::post('bank_account', [CreateBankAccountController::class, '__invoke']);
                Route::get('bank_account', [IndexBankAccountsController::class, '__invoke']);
                Route::put('bank_account/{bankAccount}/default', [MakeBankAccountDefaultController::class, '__invoke']);

                // Invoice Resource
                Route::get('invoice', [IndexInvoicesController::class, '__invoke']);
            });
        });


    });
});

