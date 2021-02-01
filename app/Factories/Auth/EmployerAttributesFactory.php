<?php
/**
 * User: amir
 * Date: 1/29/20
 * Time: 12:53 PM
 */

namespace App\Factories\Auth;


use App\Models\Auth\EmployerAttributes;
use Illuminate\Http\UploadedFile;

class EmployerAttributesFactory
{
    public function create($attributes)
    {
        $taskerAttributes = $this->initialize($attributes);
        $taskerAttributes->save();

        return $taskerAttributes;
    }

    public function initialize($attributes)
    {
        $taskerAttributes = new EmployerAttributes();
        $taskerAttributes->fill($attributes);

        if (isset($attributes['office_photo']) && $attributes['office_photo'] instanceof UploadedFile) {
            $taskerAttributes->addMedia($attributes['office_photo'])->toMediaCollection('office_photo');
        }

        if (isset($attributes['office_photo_base64']) && is_string($attributes['office_photo_base64'])) {
            $taskerAttributes->addMediaFromBase64($attributes['office_photo_base64'])->toMediaCollection('office_photo');
        }

        if (isset($attributes['legal_document']) && $attributes['legal_document'] instanceof UploadedFile) {
            $taskerAttributes->addMedia($attributes['legal_document'])->toMediaCollection('legal_document');
        }

        if (isset($attributes['legal_document_base64']) && is_string($attributes['legal_document_base64'])) {
            $taskerAttributes->addMediaFromBase64($attributes['legal_document_base64'])->toMediaCollection('legal_document');
        }

        return $taskerAttributes;
    }
}
