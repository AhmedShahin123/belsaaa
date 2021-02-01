<?php
/**
 * User: amir
 * Date: 4/30/20
 * Time: 4:28 PM
 */

namespace App\Models\Auth\Traits\Attribute;

trait EmployerAttributesAttribute
{
    public function getOfficePhotoUrlAttribute()
    {
        $this->refresh();
        if ($this->getFirstMedia('office_photo')) {
            return $this->getFirstMedia('office_photo')->getFullUrl();
        }

        return null;
    }

    public function getLegalDocumentUrlAttribute()
    {
        $this->refresh();
        if ($this->getFirstMedia('legal_document')) {
            return $this->getFirstMedia('legal_document')->getFullUrl();
        }

        return null;
    }
}
