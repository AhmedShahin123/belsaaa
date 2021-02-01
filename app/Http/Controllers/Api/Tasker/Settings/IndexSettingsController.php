<?php

namespace App\Http\Controllers\Api\Tasker\Settings;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;

class IndexSettingsController extends Controller
{
    public function __invoke()
    {
        return [
            'tasker_policy_en' => setting('tasker_policy_en'),
            'tasker_policy_ar' => setting('tasker_policy_ar'),
            'about_us_en' => setting('about_us_en'),
            'about_us_ar' => setting('about_us_ar'),
        ];
    }
}
