<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [
        'roles' => [
            'created' => 'The role was successfully created.',
            'deleted' => 'The role was successfully deleted.',
            'updated' => 'The role was successfully updated.',
        ],

        'users' => [
            'cant_resend_confirmation' => 'The application is currently set to manually approve users.',
            'confirmation_email' => 'A new confirmation e-mail has been sent to the address on file.',
            'confirmed' => 'The user was successfully confirmed.',
            'created' => 'The user was successfully created.',
            'deleted' => 'The user was successfully deleted.',
            'deleted_permanently' => 'The user was deleted permanently.',
            'restored' => 'The user was successfully restored.',
            'session_cleared' => "The user's session was successfully cleared.",
            'social_deleted' => 'Social Account Successfully Removed',
            'unconfirmed' => 'The user was successfully un-confirmed',
            'updated' => 'The user was successfully updated.',
            'updated_password' => "The user's password was successfully updated.",
        ],

        'task' => [
            'updated' => 'The task was successfully updated.',
            'tasker_assigned' => 'Tasker assigned to the task successfully',
        ],
        'tasker' => [
            'created' => 'The tasker has been created successfully.',
            'update' => 'The tasker has been updated successfully.',
            'updated' => 'The tasker has been updated successfully.',
        ],
        'employer' => [
            'created' => 'The employer has been created successfully.',
            'update' => 'The employer has been updated successfully.',
            'updated' => 'The employer has been updated successfully.',
        ],
        'city' => [
            'updated' => 'The city is successfully updated',
        ],
    ],

    'frontend' => [
        'contact' => [
            'sent' => 'Your information was successfully sent. We will respond back to the e-mail provided as soon as we can.',
        ],
    ],
];
