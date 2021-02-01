<?php
/**
 * User: amir
 * Date: 4/22/20
 * Time: 2:34 AM
 */

namespace App\Auth\Traits;


use App\Http\Resources\Auth\PersonalAccessTokenResult;
use App\Notifications\Frontend\Auth\VerifyCellphone;

trait ForgetPasswordByCellphone
{
    public function requestForgetPassword()
    {
        /** @var PersonalAccessTokenResult $tokenResult */
        $tokenResult = $this->createToken('api', [$this->user_type.'_forget_password_verify']);

        return PersonalAccessTokenResult::make($tokenResult);
    }

    public function generateForgetPasswordCode($code = null)
    {
        if (!$code) {
            $code = random_int(1000, 9999);
        }
        $this->notify(new VerifyCellphone($code));

        return \Hash::make($code);
    }

    public function verifyForgetPassword($code, $hash)
    {
        if (!\Hash::check($code, $hash)) {
            return false;
        }

        return $this->generateRecoverForgetPasswordToken();
    }

    public function generateRecoverForgetPasswordToken()
    {
        /** @var PersonalAccessTokenResult $tokenResult */
        $tokenResult = $this->createToken('api', [$this->user_type.'_forget_password_recover']);

        return PersonalAccessTokenResult::make($tokenResult);
    }
}
