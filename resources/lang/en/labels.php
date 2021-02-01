<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'empty' => 'No records found',
        'all' => 'All',
        'yes' => 'Yes',
        'no' => 'No',
        'copyright' => 'Copyright',
        'custom' => 'Custom',
        'actions' => 'Actions',
        'active' => 'Active',
        'buttons' => [
            'save' => 'Save',
            'update' => 'Update',
        ],
        'hide' => 'Hide',
        'inactive' => 'Inactive',
        'none' => 'None',
        'show' => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
        'create_new' => 'Create New',
        'toolbar_btn_groups' => 'Toolbar with button groups',
        'more' => 'More',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create' => 'Create Role',
                'edit' => 'Edit Role',
                'management' => 'Role Management',

                'table' => [
                    'number_of_users' => 'Number of Users',
                    'permissions' => 'Permissions',
                    'role' => 'Role',
                    'sort' => 'Sort',
                    'total' => 'role total|roles total',
                ],
            ],

            'users' => [
                'active' => 'Active Users',
                'all_permissions' => 'All Permissions',
                'change_password' => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create' => 'Create User',
                'deactivated' => 'Deactivated Users',
                'deleted' => 'Deleted Users',
                'edit' => 'Edit User',
                'management' => 'User Management',
                'no_permissions' => 'No Permissions',
                'no_roles' => 'No Roles to set.',
                'permissions' => 'Permissions',
                'user_actions' => 'User Actions',

                'table' => [
                    'confirmed' => 'Confirmed',
                    'cellphone' => 'Cellphone',
                    'created' => 'Created',
                    'email' => 'E-mail',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'name' => 'Name',
                    'first_name' => 'First Name',
                    'last_name' => 'Last Name',
                    'no_deactivated' => 'No Deactivated Users',
                    'no_deleted' => 'No Deleted Users',
                    'other_permissions' => 'Other Permissions',
                    'permissions' => 'Permissions',
                    'abilities' => 'Abilities',
                    'roles' => 'Roles',
                    'social' => 'Social',
                    'total' => 'user total|users total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                        'history' => 'History',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar' => 'Avatar',
                            'confirmed' => 'Confirmed',
                            'created_at' => 'Created At',
                            'deleted_at' => 'Deleted At',
                            'email' => 'E-mail',
                            'cellphone' => 'Cellphone',
                            'last_login_at' => 'Last Login At',
                            'last_login_ip' => 'Last Login IP',
                            'last_updated' => 'Last Updated',
                            'name' => 'Name',
                            'first_name' => 'First Name',
                            'last_name' => 'Last Name',
                            'status' => 'Status',
                            'timezone' => 'Timezone',
                            'total_earned' => 'Total Earned Money',
                            'finished_task_count' => 'Number of finished tasks',
                            'not_cleared_tasker_amount' => 'Not cleared tasker amount',
                            'total_paid' => 'Total Amount Paid',
                            'total_must_pay' => 'Total must pay',
                            'not_paid_commission' => 'Not Paid Commission',
                            'average_rate' => 'Average rating',
                        ],
                    ],
                ],

                'view' => 'View User',
            ],
        ],
        'employer' => [
            'management' => 'Employer Management',
            'edit' => 'Edit Employer',
            'view' => 'View Employer',
            'table' => [
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'email' => 'Email',
                'cellphone' => 'Cellphone',
                'company_name' => 'Company Name',
                'total' => 'employer total|employers total',
            ],
            'tabs' => [
                'titles' => [
                    'employer_attributes' => 'Employer Attributes',
                ],
                'content' => [
                    'overview' => [
                        'created_at' => 'Created At',
                        'last_updated' => 'Last Updated',
                    ],
                    'employer_attributes' => [
                        'company_name' => 'Company Name',
                        'address' => 'Address',
                        'national_number' => 'National Number',
                        'gender' => 'Gender',
                        'birth_date' => 'Birth Date',
                        'bio' => 'Bio',
                        'commercial_email' => 'Commercial email',
                        'commercial_business_industry' => 'Commercial Business Industry',
                        'office_photo' => 'Office Photo',
                        'download_office_photo' => 'Download Office Photo',
                        'legal_document' => 'Commercial document',
                        'download_legal_document' => 'Download Commercial document',
                    ]
                ]
            ]
        ],
        'tasker' => [
            'management' => 'Tasker Management',
            'create' => 'Create Tasker',
            'edit' => 'Edit Tasker',
            'view' => 'View Tasker',
            'table' => [
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'email' => 'Email',
                'cellphone' => 'Cellphone',
                'total' => 'tasker total|taskers total',
            ],
            'tabs' => [
                'titles' => [
                    'tasker_attributes' => 'Tasker Attributes',
                ],
                'content' => [
                    'overview' => [
                        'created_at' => 'Created At',
                        'last_updated' => 'Last Updated',
                    ],
                    'tasker_attributes' => [
                        'address' => 'Address',
                        'national_number' => 'National Number',
                        'gender' => 'Gender',
                        'birth_date' => 'Birth Date',
                        'bio' => 'Bio',
                        'shift' => 'Shift',
                        'date' => 'Date',
                        'start' => 'Start',
                        'end' => 'End',
                        'working_days' => 'Working Days',
                        'available_until' => 'Available Until',
                    ]
                ]
            ]
        ],
        'task' => [
            'management' => 'Task Management',
            'view' => 'View Task',
            'edit' => 'Edit Task',
            'create' => 'Create Task',
            'table' => [
                'title' => 'Title',
                'description' => 'Description',
                'task_type' => 'Type',
                'status' => 'Status',
                'city' => 'City',
                'employer' => 'Employer',
                'total' => 'user total|users total',
            ],
            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'assignment_requests' => 'Assignment Requests',
                    'attributes' => 'Attributes',
                    'assigned_taskers' => 'Assigned Taskers',
                    'children_tasks' => 'Children Tasks',
                    'invoices' => 'Invoices',
                ],

                'content' => [
                    'overview' => [
                        'title' => 'Title',
                        'description' => 'Description',
                        'task_type' => 'Task Type',
                        'status' => 'Status',
                        'city' => 'City',
                        'employer' => 'Employer',
                        'hour_rate' => 'Hour Rate',
                        'required_task_number' => 'Required Tasker Number',
                        'required_task_gender' => 'Required Tasker Gender',
                        'one_time_attributes' => [
                            'start_date' => 'Start Date',
                            'start_time' => 'Start Time',
                            'end_time' => 'End Time',
                        ],
                        'repeated_attributes' => [
                            'start_date' => 'Start Date',
                            'end_date' => 'End Date',
                            'days' => 'Days',
                        ],
                        'continued_attributes' => [
                            'start_at' => 'Start At',
                            'daily_duration' => 'Daily Duration',
                            'end_date' => 'End Date',
                        ],
                        'created_at' => 'Created At',
                        'last_updated' => 'Last Updated',
                    ],
                    'assignment_requests' => [
                        'table' => [
                            'created_at' => 'Created At',
                            'status' => 'Status',
                            'taskers' => 'Taskers'
                        ],
                    ],
                    'task_attributes' => [
                        'start_at' => 'Start Date',
                        'start_time' => 'Start Time',
                        'end_time' => 'End Time',
                        'daily_duration' => 'Daily Duration',
                        'end_date' => 'End Date',
                        'duration' => 'Duration',
                        'start_date' => 'Start Date',
                    ],
                    'assigned_taskers' => [
                        'empty' => 'There is no assigned tasker',
                    ],
                    'invoices' => [
                        'tasker' => 'Tasker',
                        'employer_amount' => 'Employer Amount',
                        'tasker_amount' => 'Tasker Amount',
                        'commission' => 'Commission',
                        'tasker_amount_paid' => 'Tasker Amount Paid',
                        'commission_paid' => 'Commission Paid',
                        'paid' => 'Paid',
                        'not_paid' => 'Not Paid',
                        'tasker_amount_cleared' => 'Tasker Amount Cleared',
                    ],
                ],
            ],
        ],
        'city' => [
            'management' => 'City Management',
            'edit' => 'Edit City',
            'table' => [
                'name' => 'Name',
                'last_updated' => 'Last Updated',
                'total' => 'city total|cities total'
            ],
            'tabs' => [
                'content' => [
                    'overview' => [
                        'name' => 'Name'
                    ],
                ],
            ],
            'view' => 'View City',
        ],
        'contact_category' => [
            'management' => 'Contact Category Management',
            'table' => [
                'name' => 'Name',
                'last_updated' => 'Last Updated',
                'total' => 'contact category total|contact categories total'
            ],
            'tabs' => [
                'content' => [
                    'overview' => [
                        'name' => 'Name'
                    ],
                ],
            ],
            'view' => 'View Contact Category',
            'create' => 'Create Contact Category',
            'edit' => 'Edit Contact Category',
        ],
        'skill' => [
            'management' => 'Skill Management',
            'table' => [
                'name' => 'Name',
                'last_updated' => 'Last Updated',
                'total' => 'skill total|skills total'
            ],
            'tabs' => [
                'content' => [
                    'overview' => [
                        'name' => 'Name'
                    ],
                ],
            ],
            'view' => 'View Skill',
        ],
        'notification' => [
            'management' => 'Notification Management',
            'view' => 'View',
            'tabs' => [
                'content' => [
                    'overview' => [
                        'id' => 'ID',
                        'notifiable_type' => 'Notifiable Type',
                        'notifiable_id' => 'Notifiable ID',
                        'data' => 'Data',
                    ],
                ],
            ],
            'table' =>  [
                'notifiable_type' => 'Notifiable Type',
                'notifiable_id' => 'Notifiable ID',
                'data' => 'Data',
                'sent_at' => 'Sent At',
            ],
        ],
        'token' => [
            'management' => 'Token Management',
            'view' => 'View',
            'tabs' => [
                'content' => [
                    'overview' => [
                        'id' => 'ID',
                        'user_id' => 'User ID',
                        'client_id' => 'Client ID',
                        'name' => 'Name',
                        'scopes' => 'Scopes',
                        'revoked' => 'Revoked',
                        'expires_at' => 'Expires At',
                    ],
                ],
            ],
            'table' =>  [
                'user_id' => 'User ID',
                'client_id' => 'Client ID',
                'expires_at' => 'Expires At',
                'total' => 'token total|tokens total'
            ],
        ],
        'client' => [
            'management' => 'Client Management',
            'view' => 'View',
            'tabs' => [
                'content' => [
                    'overview' => [
                        'id' => 'ID',
                        'user_id' => 'User ID',
                        'name' => 'Name',
                        'revoked' => 'Revoked',
                        'redirect' => 'Redirect URL',
                        'personal_access_token' => 'Personal Access Token',
                        'password_client' => 'Password Client',
                    ],
                ],
            ],
            'table' =>  [
                'user_id' => 'User ID',
                'name' => 'Name',
                'redirect' => 'Redirect URL',
                'personal_access_token' => 'Personal Access Token',
                'password_client' => 'Password Client',
                'revoked' => 'Revoked',
                'total' => 'client total|clients total'
            ],
        ],

        'settings' => [
            'management' => 'Manage Application Settings'
        ],
    ],

    'frontend' => [
        'auth' => [
            'login_box_title' => 'Login',
            'login_button' => 'Login',
            'login_with' => 'Login with :social_media',
            'register_box_title' => 'Register',
            'register_button' => 'Register',
            'remember_me' => 'Remember Me',
        ],

        'contact' => [
            'box_title' => 'Contact Us',
            'button' => 'Send Information',
        ],

        'passwords' => [
            'expired_password_box_title' => 'Your password has expired.',
            'forgot_password' => 'Forgot Your Password?',
            'reset_password_box_title' => 'Reset Password',
            'reset_password_button' => 'Reset Password',
            'update_password_button' => 'Update Password',
            'send_password_reset_link_button' => 'Send Password Reset Link',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Change Password',
            ],

            'profile' => [
                'avatar' => 'Avatar',
                'created_at' => 'Created At',
                'edit_information' => 'Edit Information',
                'email' => 'E-mail',
                'last_updated' => 'Last Updated',
                'name' => 'Name',
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'update_information' => 'Update Information',
            ],
        ],
    ],
];
