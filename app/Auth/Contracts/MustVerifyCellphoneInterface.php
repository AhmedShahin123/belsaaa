<?php
/**
 * User: amir
 * Date: 7/12/19
 * Time: 6:46 PM
 */

namespace App\Auth\Contracts;


use Illuminate\Support\Carbon;

interface MustVerifyCellphoneInterface
{
    public function hasVerifiedPhone();

    public function markPhoneAsVerified();

    public function callToVerify();

    public function isValidVerificationCode($code);
}
