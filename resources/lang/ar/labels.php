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
        'empty' => 'لا يوجد بيانات',
        'all' => 'الكل',
        'yes' => 'نعم',
        'no' => 'لا',
        'copyright' => 'حقوق النشر',
        'custom' => 'محفوظ',
        'actions' => 'إجراءات',
        'active' => 'مفعل',
        'buttons' => [
            'save' => 'حفظ',
            'update' => 'تعديل',
        ],
        'hide' => 'إخفاء',
        'inactive' => 'غيرمفعل',
        'none' => 'لا يوجد',
        'show' => 'عرض',
        'toggle_navigation' => 'تبديل الانتقال',
        'create_new' => 'إنشاء جديد',
        'toolbar_btn_groups' => 'شريط الأدوات مع مجموعات الأزرار',
        'more' => 'المزيد',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create' => 'إنشاء وظيفة',
                'edit' => 'تعديل وظيفة',
                'management' => 'إدارة الوظائف',

                'table' => [
                    'number_of_users' => 'عدد المستخدمين',
                    'permissions' => 'صلاحيات',
                    'role' => 'وظيفة',
                    'sort' => 'ترتيب',
                    'total' => 'إجمالى الوظائف',
                ],
            ],

            'users' => [
                'active' => 'المستخدمين المفعلين',
                'all_permissions' => 'كل الصلاحيات',
                'change_password' => 'تغيير كلمة المرور',
                'change_password_for' => 'تغيير كلمة المرور :user',
                'create' => 'إنشاء مستخدم',
                'deactivated' => 'المستخدمين المعطلين',
                'deleted' => 'المستخدمين المحذوفين',
                'edit' => 'تعديل مستخدم',
                'management' => 'إدارة المستخدمين',
                'no_permissions' => 'لا يوجد صلاحيات',
                'no_roles' => 'لا يوجد وائف للاسناد.',
                'permissions' => 'صلاحيات',
                'user_actions' => 'اجراءات المستخدم',

                'table' => [
                    'confirmed' => 'مؤكد',
                    'cellphone' => 'الهاتف',
                    'created' => 'مضاف',
                    'email' => 'بريد الكتروني',
                    'id' => ' الرقم المسلسل',
                    'last_updated' => 'احر تحديث',
                    'name' => 'الاسم',
                    'first_name' => 'الاسم الأول',
                    'last_name' => 'الاسم الأخير',
                    'no_deactivated' => 'لا يوجد مستخدمين معطلين',
                    'no_deleted' => 'لا يوجد مستخدمين محذوفين',
                    'other_permissions' => 'صلاحيات أخرى',
                    'permissions' => 'صلاحيات',
                    'abilities' => 'إمكانيات',
                    'roles' => 'وظائف',
                    'social' => 'اجتماعي',
                    'total' => 'إجمالى المستخدمين',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'نظرة عامة',
                        'history' => 'تاريخ',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar' => 'صورة رمزية',
                            'confirmed' => 'مؤكد',
                            'created_at' => 'تم الاضافة في',
                            'deleted_at' => 'تم الحذف في',
                            'email' => 'بريد الكتروني',
                            'cellphone' => 'الهاتف',
                            'last_login_at' => 'أخر دخول في ',
                            'last_login_ip' => 'اخر دخول IP',
                            'last_updated' => 'اخر تحديث',
                            'name' => 'الاسم',
                            'first_name' => 'الاسم الأول',
                            'last_name' => 'الاسم الأخير',
                            'status' => 'الحالة',
                            'timezone' => 'الوقت',
                            'total_earned' => 'المبلغ المحصل من التطبيق',
                            'finished_task_count' => 'لم يتم مسح كمية تاسير',
                            'total_paid' => 'المبلغ المدفوع',
                            'total_must_pay' => 'ما يجب دفعه ',
                            'not_paid_commission' => 'عمولة غير مدفوعة',
                            'average_rate' => 'متوسط التقييمات',
                        ],
                    ],
                ],

                'view' => 'عرض المستخدم',
            ],
        ],
        'employer' => [
            'management' => 'إدارة طالبي المهام',
            'edit' => 'تعديل طالب المهام',
            'view' => 'عرض طالب المهام',
            'table' => [
                'first_name' => 'الاسم الأول',
                'last_name' => 'الاسم الأخير',
                'email' => 'البريد الالكتروني',
                'cellphone' => 'الهاتف',
                'company_name' => 'اسم الشركة',
                'total' => 'إجمالى طالبي المهام',
            ],
            'tabs' => [
                'titles' => [
                    'employer_attributes' => 'سمات طال المهام',
                ],
                'content' => [
                    'overview' => [
                        'created_at' => 'تم الإضافة في',
                        'last_updated' => 'أخر تحديث',
                    ],
                    'employer_attributes' => [
                        'company_name' => 'اسم الشركة',
                        'address' => 'العنوان',
                        'national_number' => 'رقم الهوية',
                        'gender' => 'النوع',
                        'birth_date' => 'تاريخ الميلاد',
                        'bio' => 'السيرة الذاتيه',
                        'commercial_email' => 'البريد الالكتروني للشركة',
                        'commercial_business_industry' => 'مجال عمل المؤسسة',
                        'office_photo' => 'صور المكتب',
                        'download_office_photo' => 'تحميل صور المكتب',
                        'legal_document' => 'مستند تجاري',
                        'download_legal_document' => 'تنزيل المستند التجاري',
                    ]
                ]
            ]
        ],
        'tasker' => [
            'management' => 'إدارة منفذى المهام',
            'create' => 'إنشاء منفذ مهام',
            'edit' => 'تعديل منفذ مهام',
            'view' => 'عرض منفذ مهام',
            'table' => [
                'first_name' => 'الاسم الأول',
                'last_name' => 'الاسم الأخير',
                'email' => 'االبريد الالكتروني',
                'cellphone' => 'الهاتف',
                'total' => 'إجمالي منفذي المهام',
            ],
            'tabs' => [
                'titles' => [
                    'tasker_attributes' => 'سمات منفذي المهام',
                ],
                'content' => [
                    'overview' => [
                        'created_at' => 'تم الإضافة في',
                        'last_updated' => 'أخر تحديث',
                    ],
                    'tasker_attributes' => [
                        'address' => 'العنوان',
                        'national_number' => 'رقم الهوية',
                        'gender' => 'النوع',
                        'birth_date' => 'تاريخ الميلاد',
                        'bio' => 'السيرة الذاتيه',
                        'shift' => 'تناوب',
                        'date' => 'تاريخ',
                        'start' => 'بداية',
                        'end' => 'النهاية',
                        'working_days' => 'أيام العمل',
                        'available_until' => 'متاح حتى',
                    ]
                ]
            ]
        ],
        'task' => [
            'management' => 'إدارة المهام',
            'view' => 'عرض المهمة',
            'edit' => 'تعديل المهمة',
            'create' => 'إنشاء المهمة',
            'table' => [
                'title' => 'العنوان',
                'description' => 'الوصف',
                'task_type' => 'النوع',
                'status' => 'االحالة',
                'city' => 'المدينة',
                'employer' => 'طالب المهمة',
                'total' => 'الإجمالي ',
            ],
            'tabs' => [
                'titles' => [
                    'overview' => 'نظرة عامة',
                    'assignment_requests' => 'الطلبات المرسلة',
                    'attributes' => 'السمات',
                    'assigned_taskers' => 'منفذي المهام المعينين',
                    'children_tasks' => 'المهام اليومية',
                    'invoices' => 'فواتير',
                ],

                'content' => [
                    'overview' => [
                        'title' => 'العنوان',
                        'description' => 'الوصف',
                        'task_type' =>  'نوع المهمة',
                        'status' => 'االحالة',
                        'city' => 'مدينة',
                        'employer' => 'طالب المهام',
                        'hour_rate' => 'Hour Rate',
                        'required_task_number' =>  'عدد منفذي المهام المطلوب',
                        'required_task_gender' => 'نوع منفذي المهام المطلوب',
                        'one_time_attributes' => [
                            'start_date' => 'تاريخ البداية',
                            'start_time' => 'وقت البدء',
                            'end_time' => 'وقت النهاية',
                        ],
                        'repeated_attributes' => [
                            'start_date' => 'تاريخ البداية',
                            'end_date' => 'تاريخ النهاية',
                            'days' => 'أيام',
                        ],
                        'continued_attributes' => [
                            'start_at' => 'بدأت في',
                            'daily_duration' => 'المدة اليومية',
                            'end_date' => 'تاريخ النهاية',
                        ],
                        'created_at' => 'تم الإضافة في',
                        'last_updated' => 'أخر تحديث',
                    ],
                    'assignment_requests' => [
                        'table' => [
                            'created_at' => 'تم الإضافة في',
                            'status' => 'االحالة',
                            'taskers' => 'منفذي المهام'
                        ],
                    ],
                    'task_attributes' => [
                        'start_at' => 'تاريخ البداية',
                        'start_time' => 'وقت البدء',
                        'end_time' => 'وقت النهاية',
                        'daily_duration' => 'المدة اليومية',
                        'end_date' => 'تاريخ النهاية',
                        'duration' => 'المدة',
                        'start_date' => 'تاريخ البداية',
                    ],
                    'assigned_taskers' => [
                        'empty' => 'لا يوجد منفذين للمهام',
                    ],
                    'invoices' => [
                        'tasker' => 'أكياس',
                        'employer_amount' => 'مبلغ صاحب العمل',
                        'tasker_amount' => 'مبلغ تاسكر',
                        'commission' => 'عمولة',
                        'tasker_amount_paid' => 'تاسكر المبلغ المدفوع',
                        'commission_paid' => 'العمولة المدفوعة',
                        'paid' => 'دفع',
                        'not_paid' => 'غير مدفوع',
                        'tasker_amount_cleared' => 'مبلغ تاسكر مسح',
                    ],
                ],
            ],
        ],
        'city' => [
            'management' => 'إدارة المدن',
            'edit' => 'تحرير المدينة',
            'table' => [
                'name' => 'الاسم',
                'last_updated' => 'أخر تحديث',
                'total' => 'الإجمالي'
            ],
            'tabs' => [
                'content' => [
                    'overview' => [
                        'name' => 'الاسم'
                    ],
                ],
            ],
            'view' => 'عرض المدينة',
        ],
        'contact_category' => [
            'management' => 'إدارة أنواع التواصل',
            'table' => [
                'name' => 'الاسم',
                'last_updated' => 'أخر تحديث',
                'total' => 'الإجمالي'
            ],
            'tabs' => [
                'content' => [
                    'overview' => [
                        'name' => 'الاسم'
                    ],
                ],
            ],
            'view' => 'عرض نوع التواصل',
            'create' => 'إنشاء نوع التواصل',
            'edit' => 'تعديل نوع التواصل',
        ],
        'skill' => [
            'management' => 'إدارة المهارات',
            'table' => [
                'name' => 'الاسم',
                'last_updated' => 'أخر تحديث',
                'total' => 'الإجمالي'
            ],
            'tabs' => [
                'content' => [
                    'overview' => [
                        'name' => 'الاسم'
                    ],
                ],
            ],
            'view' => 'عرض المهارة',
        ],
        'notification' => [
            'management' => 'إدارة الإشعارات',
            'view' => 'عرض',
            'tabs' => [
                'content' => [
                    'overview' => [
                        'id' =>  'الرقم التسلسلي',
                        'notifiable_type' => 'نوع الإشعار',
                        'notifiable_id' => 'رقم الإشعار',
                        'data' => 'التاريخ',
                    ],
                ],
            ],
            'table' =>  [
                'notifiable_type' => 'نوع الإشعار',
                'notifiable_id' => 'رقم الإشعار',
                'data' => 'التاريخ',
                'sent_at' => 'تم الإرسال في',
            ],
        ],
        'token' => [
            'management' => 'إدارة المسجلين',
            'view' => 'عرض',
            'tabs' => [
                'content' => [
                    'overview' => [
                        'id' =>  'الرقم التسلسلي',
                        'user_id' =>  'الرقم التسلسلي للمستخدم',
                        'client_id' => 'الرقم التسلسلي للعميل',
                        'name' => 'الاسم',
                        'scopes' => 'النطاقات',
                        'revoked' =>  'مرفوض',
                        'expires_at' => 'ستنتهي الصلاحية في',
                    ],
                ],
            ],
            'table' =>  [
                'user_id' =>  'الرقم التسلسلي للمستخدم',
                'client_id' => 'الرقم التسلسلي للعميل',
                'expires_at' => 'ستنتهي الصلاحية في',
                'total' => 'الإجمالي'
            ],
        ],
        'client' => [
            'management' => 'إدارة العملاء',
            'view' => 'عرض',
            'tabs' => [
                'content' => [
                    'overview' => [
                        'id' =>  'الرقم التسلسلي',
                        'user_id' =>  'الرقم التسلسلي للمستخدم',
                        'name' => 'الاسم',
                        'revoked' =>  'مرفوض',
                        'redirect' => 'انتقل لرابط',
                        'personal_access_token' => 'رمز الوصول الشخصي',
                        'password_client' => 'كلمة مرور العميل',
                    ],
                ],
            ],
            'table' =>  [
                'user_id' => 'رقم تسلسل المستخدم',
                'name' => 'الاسم',
                'redirect' => 'انتقل لرابط',
                'personal_access_token' => 'رمز الوصول الشخصي',
                'password_client' => 'كلمة مرور العميل',
                'revoked' => 'ملغي',
                'total' => 'الإجمالي'
            ],
        ],

        'settings' => [
            'management' => 'الإعدادات العامة للتطبيق'
        ],
    ],

    'frontend' => [
        'auth' => [
            'login_box_title' => 'سجل دخول',
            'login_button' => 'سجل دخول',
            'login_with' => 'سجل دخول بواسطة :social_media',
            'register_box_title' => 'سجل',
            'register_button' => 'سجل',
            'remember_me' => 'تذكرني',
        ],

        'contact' => [
            'box_title' => 'اتصل بنا',
            'button' => 'ارسل المعلومات',
        ],

        'passwords' => [
            'expired_password_box_title' => 'صلاحية كلمة المرور منتهية.',
            'forgot_password' => 'نسيت كلمة المرور?',
            'reset_password_box_title' => 'إعادة تعيين كلمة المرور',
            'reset_password_button' => 'إعادة تعيين كلمة المرور',
            'update_password_button' => 'تعديل كلمة المرور',
            'send_password_reset_link_button' => 'إرسال رابط تغيير كلمة المرور',
        ],

        'user' => [
            'passwords' => [
                'change' => 'تغيير كلمة المرور',
            ],

            'profile' => [
                'avatar' => 'صورة رمزية',
                'created_at' => 'تم الإضافة في',
                'edit_information' => 'تعديل المعلومات',
                'email' => 'E-mail',
                'last_updated' => 'أخر تحديث',
                'name' => 'الاسم',
                'first_name' => 'الاسم الأول',
                'last_name' => 'الاسم الأخير',
                'update_information' => 'تحديث المعلومات',
            ],
        ],
    ],
];
