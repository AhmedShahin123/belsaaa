<?php

namespace App\Models\Auth\Traits\Scope;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class UserScope.
 */
trait UserScope
{
    /**
     * @param $query
     * @param bool $confirmed
     *
     * @return mixed
     */
    public function scopeConfirmed($query, $confirmed = true)
    {
        return $query->where('confirmed', $confirmed);
    }

    /**
     * @param $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeActive($query, $status = true)
    {
        return $query->where('active', $status);
    }

    public function scopeTasker($query)
    {
        return $query->where('user_type', 'tasker');
    }

    public function scopeEmployer($query)
    {
        return $query->where('user_type', 'employer');
    }

    public function scopeSearch(Builder $query, $term)
    {
        return $query->where(function($query) use ($term) {
            $query->where('first_name', 'like', "%$term%")
                ->orWhere('last_name', 'like', "%$term%")
                ->orWhere('company_name', 'like', "%$term%")
                ->orWhere('email', 'like', "%$term%")
                ->orWhere('cellphone', 'like', "%$term%")
            ;
        });
    }

    public function scopeEmptyType(Builder $query)
    {
        return $query->whereNull('user_type');
    }

    public function scopeGender(Builder $query, $gender)
    {
        if ($gender === null) {
            return $query;
        }

        return $query->whereHas('tasker_attributes', function (Builder $query) use ($gender) {
            $query->where('tasker_attributes.gender', $gender);
        });
    }
}
