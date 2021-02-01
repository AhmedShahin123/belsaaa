<?php
/**
 * User: amir
 * Date: 10/10/19
 * Time: 4:57 PM
 */

namespace App\Auth;

use App\Helpers\General\PhoneNumberHelper;
use \Illuminate\Auth\EloquentUserProvider as BaseProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;

class EloquentUserProvider extends BaseProvider
{
    /**
     * @var PhoneNumberHelper
     */
    private $phoneNumberHelper;

    public function __construct(HasherContract $hasher, $model, PhoneNumberHelper $phoneNumberHelper)
    {
        parent::__construct($hasher, $model);
        $this->phoneNumberHelper = $phoneNumberHelper;
    }

    const PHONE_NUMBER_KEYS = ['cellphone', 'mobile', 'phone'];

    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
            (count($credentials) === 1 &&
                array_key_exists('password', $credentials))) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->newModelQuery();

        foreach ($credentials as $key => $value) {
            if (Str::contains($key, 'password')) {
                continue;
            }

            if (count($ors = explode('_or_', $key)) > 1) {
                $query->where(function (Builder $query) use ($ors, $value) {
                    $this->where($query, $ors[0], $value);
                    unset($ors[0]);
                    foreach ($ors as $key) {
                        $this->orWhere($query, $key, $value);
                    }
                });
            } else {
                $this->where($query, $key, $value);
            }
        }

        return $query->first();
    }

    public function where(Builder $query, $key, $value)
    {
        if (is_array($value) || $value instanceof Arrayable) {
            $query->whereIn($key, in_array($key, self::PHONE_NUMBER_KEYS) ? $this->phoneNumberHelper->normalizeCellphone($value) : $value);
        } else {
            $query->where($key, in_array($key, self::PHONE_NUMBER_KEYS) ? $this->phoneNumberHelper->normalizeCellphone($value)[0] : $value);
        }
    }

    public function orWhere(Builder $query, $key, $value)
    {
        if (is_array($value) || $value instanceof Arrayable) {
            $query->orWhereIn($key, in_array($key, self::PHONE_NUMBER_KEYS) ? $this->phoneNumberHelper->normalizeCellphone($value) : $value);
        } else {
            $query->orWhere($key, in_array($key, self::PHONE_NUMBER_KEYS) ? $this->phoneNumberHelper->normalizeCellphone($value)[0] : $value);
        }
    }
}
