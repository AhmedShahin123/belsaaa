<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Attribute\EmployerAttributesAttribute;
use App\Models\Auth\Traits\Method\EmployerAttributesMethod;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class EmployerAttributes
 *
 * @property string    address
 * @property string    national_number
 * @property string    gender
 * @property \DateTime birth_date
 * @property string    bio
 * @property string    commercial_email
 * @property string    commercial_business_industry
 */
class EmployerAttributes extends Model implements HasMedia
{
    use EmployerAttributesAttribute,
        EmployerAttributesMethod,
        HasMediaTrait;

    public function registerMediaCollections()
    {
        $this->addMediaCollection('office_photo');
        $this->addMediaCollection('legal_document');
    }

    protected $fillable = [
        'address',
        'national_number',
        'gender',
        'birth_date',
        'bio',
        'commercial_email',
        'commercial_business_industry',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];
}
