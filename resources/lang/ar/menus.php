<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => 'الوصول',

            'roles' => [
                'all' => 'جميع الوظائف',
                'create' => 'إنشاء وظيفة',
                'edit' => 'تعديل وظيفة',
                'management' => 'إدارة الوظائف',
                'main' => 'الوظائف',
            ],

            'users' => [
                'all' => 'جميع المستخدمين',
                'change-password' => 'تغيير كلمة المرور',
                'create' => 'إنشاء مستخدم',
                'deactivated' => 'المستخدمين المعطلين',
                'deleted' => 'المستخدمين المحذوفين',
                'edit' => 'تعديل مستخدم',
                'main' => 'المستخدمين',
                'view' => 'عرض مستخدم',
            ],
        ],

        'log-viewer' => [
            'main' => 'الحركات التاريخية',
            'dashboard' => 'لوحة التحكم',
            'logs' => 'الحركات التاريخية',
        ],

        'sidebar' => [
            'dashboard' => 'لوحة التحكم',
            'general' => 'عام',
            'history' => 'التاريخ',
            'system' => 'النظام',
            'notification' => 'الإشعارات',
            'employer' => 'طال مهام',
            'tasker' => 'منفذ مهام',
            'settings' => 'الإعدادات',
        ],

        'task' => [
            'title' => 'المهمة',
            'view' => 'عرض مهمة',
            'edit' => 'تعديل مهمة',
            'create' => 'إنشاء مهمة',
        ],
        'city' => [
            'view' => 'عرض المدينة',
            'edit' => 'تحرير المدينة',
        ],
        'contact_category' => [
            'view' => 'عرض نوع التواصل',
            'edit' => 'تعديل نوع التواصل',
        ],
        'tasker' => [
            'create' => 'إنشاء منفذ مهمة',
            'edit' => 'تعديل منفذ مهمة',
            'view' => 'عرض منفذ مهمة'
        ],
        'employer' => [
            'create' => 'Create Employer (translate)',
            'view' => 'View Employer (translate)',
            'edit' => 'Edit Employer (translate)',
        ],
    ],

    'language-picker' => [
        'language' => 'اللغة',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar' => 'عربي',
            'az' => 'Azerbaijan',
            'zh' => 'Chinese Simplified',
            'zh-TW' => 'Chinese Traditional',
            'da' => 'Danish',
            'de' => 'German',
            'el' => 'Greek',
            'en' => 'English',
            'es' => 'Spanish',
            'fa' => 'Persian',
            'fr' => 'French',
            'he' => 'Hebrew',
            'id' => 'Indonesian',
            'it' => 'Italian',
            'ja' => 'Japanese',
            'nl' => 'Dutch',
            'no' => 'Norwegian',
            'pt_BR' => 'Brazilian Portuguese',
            'ru' => 'Russian',
            'sv' => 'Swedish',
            'th' => 'Thai',
            'tr' => 'Turkish',
            'uk' => 'Ukrainian',
        ],
    ],
];
