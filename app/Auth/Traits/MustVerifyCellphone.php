<?php
/**
 * User: amir
 * Date: 7/12/19
 * Time: 6:46 PM
 */

namespace App\Auth\Traits;


use App\Notifications\Frontend\Auth\VerifyCellphone;
use App\Notifications\SendVerificationSms;
use Illuminate\Support\Carbon;

/**
 * Trait MustVerifyCellphone
 *
 * @property string    verification_code
 * @property string    phone_verified_at
 * @property \DateTime phone_verification_expires_at
 */
trait MustVerifyCellphone
{
    public function hasVerifiedPhone()
    {
        return ! is_null($this->phone_verified_at);
    }

    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function callToVerify()
    {
        if (!$this->hasNonExpiredCode()) {
            $this->verification_code = random_int(1000, 9999);
            $this->phone_verification_expires_at = Carbon::now()->addSeconds(60 * 5);
            $this->save();
        }

        $this->notify(new SendVerificationSms());
    }

    public function isValidVerificationCode($code)
    {
        return $this->hasNonExpiredCode() && $code == $this->verification_code;
    }

    public function hasNonExpiredCode()
    {
        return
            !empty($this->verification_code) &&
            $this->phone_verification_expires_at instanceof \DateTime &&
            Carbon::now()->lessThan($this->phone_verification_expires_at)
        ;
    }
}
