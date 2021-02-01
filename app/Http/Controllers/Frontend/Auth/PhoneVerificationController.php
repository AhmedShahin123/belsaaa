<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PhoneVerification;

class PhoneVerificationController extends Controller
{
    use PhoneVerification;

    protected $section = 'frontend';

    protected $targetRoute = 'home';

    protected $layout = 'frontend.layouts.app';

    protected $view = 'frontend.auth.verification.index';
}
