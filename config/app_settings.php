<?php

return [

    // All the sections for the settings page
    'sections' => [
        'app' => [
            'title' => 'General Settings',
            'descriptions' => 'Application general settings.', // (optional)
            'icon' => 'fa fa-cog', // (optional)

            'inputs' => [
                [
                    'name' => 'app_name', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'App Name', // label for input
                    // optional properties
                    'placeholder' => 'Application Name', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required|min:2|max:20', // validation rules for this input
                    'value' => 'QCode', // any default value
                    'hint' => 'You can set the app name here' // help block text for input
                ],
                [
                    'name' => 'logo',
                    'type' => 'image',
                    'label' => 'Upload logo',
                    'hint' => 'Must be an image and cropped in desired size',
                    'rules' => 'image|max:500',
                    'disk' => 'public', // which disk you want to upload
                    'path' => 'app', // path on the disk,
                    'preview_class' => 'thumbnail',
                    'preview_style' => 'height:40px'
                ],
//                [
//                    'name' => 'tasker_policy_en',
//                    'type' => 'textarea',
//                    'label' => 'Tasker Policy And Policy (English)',
//                    'rules' => 'string|required',
//                ],
                [
                    'name' => 'tasker_policy_ar',
                    'type' => 'textarea',
                    'label' => 'Tasker Policy And Policy (Arabic)',
                    'rules' => 'string|required',
                ],
//                [
//                    'name' => 'employer_policy_en',
//                    'type' => 'textarea',
//                    'label' => 'Employer Policy And Policy (English)',
//                    'rules' => 'string|required',
//                ],
                [
                    'name' => 'employer_policy_ar',
                    'type' => 'textarea',
                    'label' => 'Employer Policy And Policy (Arabic)',
                    'rules' => 'string|required',
                ],
                [
                    'name' => 'about_us_en',
                    'type' => 'wysiwyg',
                    'label' => 'About Us Content (English)',
                    'rules' => 'string|required',
                ],
                [
                    'name' => 'about_us_ar',
                    'type' => 'wysiwyg',
                    'label' => 'About Us Content (Arabic)',
                    'rules' => 'string|required',
                ],
            ]
        ],
        'email' => [
            'title' => 'Email Settings',
            'descriptions' => 'How app email will be sent.',
            'icon' => 'fa fa-envelope',

            'inputs' => [
                [
                    'name' => 'from_email',
                    'type' => 'email',
                    'label' => 'From Email',
                    'placeholder' => 'Application from email',
                    'rules' => 'required|email',
                ],
                [
                    'name' => 'from_name',
                    'type' => 'text',
                    'label' => 'Email from Name',
                    'placeholder' => 'Email from Name',
                ]
            ]
        ],
        'tasker_shift' => [
            'title' => 'Tasker Shift Times',
            'descriptions' => 'Times for start and finish shifts.',
            'icon' => 'far fa-clock',

            'inputs' => [
                [
                    'name' => 'shift_day_start_time',
                    'type' => 'text',
                    'label' => 'Shift Day Start Time',
                    'placeholder' => '00:00:00',
                    'rules' => 'required|date_format:H:i:s',
                ],
                [
                    'name' => 'shift_day_end_time',
                    'type' => 'text',
                    'label' => 'Shift Day End Time',
                    'placeholder' => '00:00:00',
                    'rules' => 'required|date_format:H:i:s',
                ],
                [
                    'name' => 'shift_night_start_time',
                    'type' => 'text',
                    'label' => 'Shift Night Start Time',
                    'placeholder' => '00:00:00',
                    'rules' => 'required|date_format:H:i:s',
                ],
                [
                    'name' => 'shift_night_end_time',
                    'type' => 'text',
                    'label' => 'Shift Night End Time',
                    'placeholder' => '00:00:00',
                    'rules' => 'required|date_format:H:i:s',
                ],
            ],
        ],
        'task_cycle' => [
            'title' => 'Task Cycle Configurations',
            'descriptions' => 'Numbers that will be used during task cycle',
            'icon' => 'far fa-clock',

            'inputs' => [
                [
                    'name' => 'requesting_tasker_count',
                    'type' => 'number',
                    'label' => 'Number of requesting tasker per needed tasker',
                    'value' => 3,
                    'placeholder' => '3',
                    'rules' => 'required|integer|min:1',
                ],
                [
                    'name' => 'requesting_tasker_distance',
                    'type' => 'number',
                    'label' => 'Radius to find near taskers in Kilometer',
                    'value' => 5,
                    'placeholder' => '5',
                    'rules' => 'required|integer|min:0',
                ],
                [
                    'name' => 'commission_rate',
                    'type' => 'number',
                    'label' => 'Percent of commission',
                    'value' => 10,
                    'placeholder' => '10',
                    'rules' => 'required|integer|min:0|max:100',
                ],
                [
                    'name' => 'minimum_hour_rate',
                    'type' => 'number',
                    'label' => 'Minimum Hour Rate',
                    'value' => 10,
                    'placeholder' => '10',
                    'rules' => 'required|integer|min:0',
                ],
            ],
        ],
    ],

    // Setting page url, will be used for get and post request
    'url' => '/settings',

    // Any middleware you want to run on above route
    'middleware' => ['admin'],

    // View settings
    'setting_page_view' => 'backend.setting.index',
    'flash_partial' => 'app_settings::_flash',

    // Setting section class setting
    'section_class' => 'card mb-3',
    'section_heading_class' => 'card-header',
    'section_body_class' => 'card-body',

    // Input wrapper and group class setting
    'input_wrapper_class' => 'form-group',
    'input_class' => 'form-control',
    'input_error_class' => 'has-error',
    'input_invalid_class' => 'is-invalid',
    'input_hint_class' => 'form-text text-muted',
    'input_error_feedback_class' => 'text-danger',

    // Submit button
    'submit_btn_text' => 'Save Settings',
    'submit_success_message' => 'Settings has been saved.',

    // Remove any setting which declaration removed later from sections
    'remove_abandoned_settings' => false,

    // Controller to show and handle save setting
    'controller' => '\QCod\AppSettings\Controllers\AppSettingController',

    // settings group
    'setting_group' => function() {
        // return 'user_'.auth()->id();
        return 'default';
    }
];
