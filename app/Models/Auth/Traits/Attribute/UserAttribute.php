<?php

namespace App\Models\Auth\Traits\Attribute;

use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Support\Facades\Hash;
use Webmozart\Assert\Assert;

/**
 * Trait UserAttribute.
 */
trait UserAttribute
{
    /**
     * @param $password
     */
    public function setPasswordAttribute($password) : void
    {
        // If password was accidentally passed in already hashed, try not to double hash it
        if (
            (\strlen($password) === 60 && preg_match('/^\$2y\$/', $password)) ||
            (\strlen($password) === 95 && preg_match('/^\$argon2i\$/', $password))
        ) {
            $hash = $password;
        } else {
            $hash = Hash::make($password);
        }

        // Note: Password Histories are logged from the \App\Observer\User\UserObserver class
        $this->attributes['password'] = $hash;
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        if ($this->user_type === 'employer' && $this->company_name) {
            return $this->company_name;
        }

        return $this->last_name
            ? $this->first_name.' '.$this->last_name
            : $this->first_name;
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->full_name;
    }

    /**
     * @return mixed
     */
    public function getPictureAttribute()
    {
        return $this->getPicture();
    }

    /**
     * @return string
     */
    public function getRolesLabelAttribute()
    {
        $roles = $this->getRoleNames()->toArray();

        if (\count($roles)) {
            return implode(', ', array_map(function ($item) {
                return ucwords($item);
            }, $roles));
        }

        return 'N/A';
    }

    /**
     * @return string
     */
    public function getPermissionsLabelAttribute()
    {
        $permissions = $this->getDirectPermissions()->toArray();

        if (\count($permissions)) {
            return implode(', ', array_map(function ($item) {
                return ucwords($item['name']);
            }, $permissions));
        }

        return 'N/A';
    }

    public function setLocationAttribute(array $location = null)
    {
        if (is_array($location)) {
            Assert::keyExists($location, 'latitude');
            Assert::keyExists($location, 'longitude');
        }

        $this->attributes['latitude'] = $location ? $location['latitude'] : null;
        $this->attributes['longitude'] = $location ? $location['longitude'] : null;
    }

    public function getPhotoUrlAttribute()
    {
        $this->refresh();
        if ($this->getFirstMedia('profile')) {
            return $this->getFirstMedia('profile')->getFullUrl();
        }

        return null;
    }

    public function getNotPaidCommissionAmount()
    {
        return $this->employer_commission_not_paid_invoices->sum('commission');
    }
}
