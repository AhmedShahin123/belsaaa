<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 4:27 AM
 */

namespace App\Models\Traits\Attribute;


trait PaymentAttribute
{
    public function getRedirectUrlAttribute()
    {
        return $this->details['redirect_url'] ?? null;
    }

    public function setRedirectUrlAttribute($redirectUrl)
    {
        $this->details['redirect_url'] = $redirectUrl;
    }
}
