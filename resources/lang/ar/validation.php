<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'phone' => 'صيغة رقم الجوال غير صحيحة',
    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'backend' => [
            'access' => [
                'permissions' => [
                    'associated_roles' =>  'الوظائف المرتبطة',
                    'dependencies' =>  'التبعيات',
                    'display_name' =>  'اسم العرض',
                    'group' =>  'المجموعة',
                    'group_sort' =>  'ترتيب المجموعة',

                    'groups' => [
                        'name' =>  'اسم المجموعة',
                    ],

                    'name' =>  'الاسم',
                    'first_name' =>  ' الاسم الأول',
                    'last_name' =>  ' الاسم الأخير',
                    'system' =>  'النظام',
                ],

                'roles' => [
                    'associated_permissions' =>  'الصلاحيات المرتبطة',
                    'name' =>  'الاسم',
                    'sort' =>  'ترتيب',
                ],

                'users' => [
                    'active' =>  'مفعل',
                    'associated_roles' =>  'الوظائف المرتبطة',
                    'confirmed' => 'تم التأكيد',
                    'email' =>  'البريد الالكتروني',
                    'name' =>  'الاسم',
                    'last_name' =>  ' الاسم الأخير',
                    'first_name' =>  ' الاسم الأول',
                    'other_permissions' =>  'الصلاحيات الأخري',
                    'password' => 'كلمه السر',
                    'password_confirmation' =>  'تأكيد كلمة المرور',
                    'send_confirmation_email' =>  'أرسل بريد الكترونى للتفعيل',
                    'timezone' =>  'الوقت',
                    'language' =>  ' اللغة',
                    'cellphone' =>  'الهاتف',
                    'company_name' =>  'اسم الشركة',
                    'location' => 'موقع',
                ],
            ],

            'contact_category' => [
                'name' =>  'الاسم',
            ],
            'task' => [
                'title' =>  'العنوان',
                'active' =>  'مفعل',
                'description' =>  'الوصف',
                'task_type' =>  'نوع المهمة',
                'status' =>  'الحالة',
                'city' =>  'المدينة',
                'employer' =>  'طالب المهام',
                'hour_rate' =>  'معدل سعر الساعة',
                'required_tasker_number' => 'عدد منفذي المهامالمطلوب',
                'required_tasker_gender' => 'نوع منفذي المهام المطلوب',
                'required_tasker_gender_male' =>  'ذكر',
                'required_tasker_gender_female' => 'أنثى',
                'required_tasker_gender_any' => 'غيرمحدد',
                'one_time_attributes' => [
                    'start_date' =>  'تاريخ البداية',
                    'start_time' =>  'وقت البداية',
                    'duration' => 'المدة',
                    'end_time' => 'وقت الانتهاء'
                ],

                'repeated_attributes' => [
                    'start_date' =>  'تاريخ البداية',
                    'end_date' =>  'تاريخ الانتهاء',
                    'days' => [
                        'sunday' => 'الأحد',
                        'monday' => 'الأثنين',
                        'tuesday' => 'الثلاثاء',
                        'wednesday' => 'الأربعاء',
                        'thursday' => 'الخميس',
                        'friday' => 'الجمعة',
                        'saturday' => 'السبت',
                        'from' => 'من',
                        'to' => 'إلى',
                    ],
                    'repeat' =>  'مكرر',
                ],

                'continued_attributes' => [
                    'start_date' =>  'تاريخ البداية',
                    'start_time' =>  'وقت البداية',
                    'daily_duration' =>  'المدة اليومية',
                    'end_date' =>  'تاريخ الانتهاء',
                ],
            ],
            'employer' => [
                'user_attributes' => [
                    'address' =>  'العنوان',
                    'national_number' =>  'رقم الهوية',
                    'birth_date' =>  'تاريخ الميلاد',
                    'bio' =>  'السيرة الذاتية',
                    'gender' => 'Gender',
                    'commercial_email' =>  'البريد الالكتروني للشركة',
                    'commercial_business_industry' =>  'مجال عمل الشركة',
                    'office_photo' =>  'صورة مكتبية',
                    'legal_document' =>  'مستند تجاري',
                ],
            ],
            'tasker' => [
                'user_attributes' => [
                    'address' =>  'العنوان',
                    'national_number' =>  'رقم الهوية',
                    'birth_date' =>  'تاريخ الميلاد',
                    'bio' => 'السيرة الذاتية',
                    'gender' => 'النوع',
                ],
            ],
            'city' => [
                'name' => 'اسم',
            ],
        ],

        'frontend' => [
            'avatar' => 'الرمز البريدى',
            'email' => 'البريد الالكتروني',
            'first_name' =>  ' الاسم الأول',
            'last_name' =>  ' الاسم الأخير',
            'name' =>  ' الاسم كاملا',
            'password' => 'كلمة المرور',
            'password_confirmation' => 'تأكيد كلمة المرور',
            'phone' => 'الهاتف',
            'message' => 'الرسالة',
            'new_password' =>  ' كلمة المرور الجديدة',
            'new_password_confirmation' => 'تم تأكيد كلمة المرور الجديدة',
            'old_password' =>  ' كلمة المرور القديمة',
            'timezone' =>  'الوقت',
            'language' =>  ' اللغة',
            'cellphone' =>  'رقم الجوال',
        ],
    ],
];
