<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Strings Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in strings throughout the system.
    | Regardless where it is placed, a string can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'users' => [
                'delete_user_confirm' => 'هل تريد حذف المستخدم وجمع ما يتعلق به بالنظام ؟ بعد الحذف لا يمكن الاسترجاع.',
                'if_confirmed_off' => '(If confirmed is off)',
                'no_deactivated' => 'لا يوجد مستخدمين معطلين.',
                'no_deleted' => 'لا يوجد مستخدمين محذوفين.',
                'restore_user_confirm' => 'استرجاع المستخددم لحالته الأصلية?',
            ],
        ],

        'dashboard' => [
            'title' =>  'لوحة التحكم',
            'welcome' =>  'مرحبا',
            'last_week_tasks' => 'مهام الأسبوع الماضي',
            'last_month_tasks' => 'مهام الشهر الماضي',
            'last_year_tasks' => 'مهام العام الماضي',
        ],

        'general' => [
            'all_rights_reserved' => 'جميع الحقوق محفوظة.',
            'are_you_sure' => 'هل أنت متأكد من هذا الإجراء?',
            'boilerplate_link' => 'بالساعة',
            'continue' => 'استمر',
            'member_since' => 'عضو منذ',
            'minutes' => ' دقائق',
            'search_placeholder' => 'بحث...',
            'timeout' => 'تم تسجيل خروجك تلقائيًا لأسباب تتعلق بالأمان حيث لم يكن لديك أي نشاط ',

            'see_all' => [
                'messages' => 'قراءة كل الرسائل',
                'notifications' => 'عرض الكل',
                'tasks' => 'عرض جميع المهام',
            ],

            'status' => [
                'online' => 'متاح',
                'offline' => 'غير متاح',
            ],

            'you_have' => [
                'messages' => '{0} You don\'t have messages|{1} You have 1 message|[2,Inf] You have :number messages',
                'notifications' => '{0} You don\'t have notifications|{1} You have 1 notification|[2,Inf] You have :number notifications',
                'tasks' => '{0} You don\'t have tasks|{1} You have 1 task|[2,Inf] You have :number tasks',
            ],
        ],

        'search' => [
            'empty' => 'الرجاء إدخال كلمة البحث.',
            'incomplete' => 'يجب عليك كتابة كلمة البحث الخاص بك لهذا النظام.',
            'title' => 'نتائج البحث',
            'results' => 'نتائج البحث ل :query',
        ],

        'welcome' => 'مرحبا بك في لوحة التحكم',

        'task' => [
            'task_type' => [
                'one_time' => 'مره واحده',
                'continued' => 'متواصل',
                'repeated' => 'مكررخد',
            ],
            '_task_type' => 'نوع المهمة',
            'create_new_task' => 'إنشاء مهمة جديدة',
            'title' => 'عنوان',
            'sent_to_admin' => 'أرسل إلى المسؤول',
            '_status' => 'الحالة',
            'status' => [
                'initiate' => 'Initiate',
                'selected_by_tasker' => 'Selected By Tasker',
                'sending' => 'Sending',
                'accepted' => 'Accepted',
                'rejected' => 'Rejected',
                'started' => 'Started',
                'finished' => 'Finished',
                'canceled' => 'Canceled',
                'expired' => 'Expired',
            ],
            'filter' => 'صفى',
        ],
    ],

    'emails' => [
        'auth' => [
            'account_confirmed' => 'تم تأكيد حسابك.',
            'error' => 'يا إلهي!',
            'greeting' => 'مرحبا!',
            'regards' => 'مع تحياتنا,',
            'trouble_clicking_button' => 'إذا كان لديك مشكلة من فضلك اضغط ":action_text" button, انسخ والصق هذاالرابط في متصفحك:',
            'thank_you_for_using_app' => 'شكرا لاستخدامك تطبيقاتنا!',

            'password_reset_subject' => 'إعادة تعيين كلمة المرور',
            'password_cause_of_email' => 'أنت تلقيت هذا البريد الإلكتروني لأننا تلقينا طلب إعادة تعيين كلمة المرور لحسابك.',
            'password_if_not_requested' => 'إذا لم تطلب إعادة تعيين كلمة المرور ، فلا يلزم اتخاذ أي إجراء آخر.',
            'reset_password' => 'انقر هنا لإعادة تعيين كلمة المرور الخاصة بك',

            'click_to_confirm' => 'انقر هنا لتأكيد حسابك:',
        ],

        'contact' => [
            'email_body_title' => 'لديك طلب نموذج اتصال جديد: فيما يلي التفاصيل:',
            'subject' => 'A new :app_name contact form submission!',
        ],
    ],

    'frontend' => [
        'test' => 'اختبار',

        'tests' => [
            'based_on' => [
                'permission' => 'Permission Based - ',
                'role' => 'Role Based - ',
            ],

            'js_injected_from_controller' => 'Javascript Injected from a Controller',

            'using_blade_extensions' => 'Using Blade Extensions',

            'using_access_helper' => [
                'array_permissions' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does have to possess all.',
                'array_permissions_not' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does not have to possess all.',
                'array_roles' => 'Using Access Helper with Array of Role Names or ID\'s where the user does have to possess all.',
                'array_roles_not' => 'Using Access Helper with Array of Role Names or ID\'s where the user does not have to possess all.',
                'permission_id' => 'Using Access Helper with Permission ID',
                'permission_name' => 'Using Access Helper with Permission Name',
                'role_id' => 'Using Access Helper with Role ID',
                'role_name' => 'Using Access Helper with Role Name',
            ],

            'view_console_it_works' => 'View console, you should see \'it works!\' which is coming from FrontendController@index',
            'you_can_see_because' => 'يمكنك مشاهدة هذا لأنك حصلت على وظيفة \':role\'!',
            'you_can_see_because_permission' => 'يمكنك مشاهدة هذا لأنك حصلت على صلاحية \':permission\'!',
        ],

        'general' => [
            'joined' => 'Joined',
        ],

        'user' => [
            'change_email_notice' => 'إذا قمت بتغيير بريدك الإلكتروني ، فسيتم تسجيل خروجك حتى تؤكد عنوان بريدك الإلكتروني الجديد.',
            'email_changed_notice' => 'يجب تأكيد عنوان بريدك الإلكتروني الجديد قبل أن تتمكن من تسجيل الدخول مرة أخرى.',
            'profile_updated' => 'تم تحديث الحساب بنجاح.',
            'password_updated' => 'تم تحديث كلمة المرور .',
        ],

        'welcome_to' => 'Welcome to :place',
    ],
    'email_cellphone_name' => 'البريد الإلكتروني، الهاتف المحمول، الاسم',
    'filter' => 'منقي',
    'email_name' => 'البريد الإلكتروني ، الاسم',
    'entries' => 'إدخالات',
];
