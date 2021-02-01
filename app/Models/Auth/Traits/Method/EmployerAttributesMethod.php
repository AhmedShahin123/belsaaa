<?php
/**
 * User: amir
 * Date: 1/30/20
 * Time: 2:43 PM
 */

namespace App\Models\Auth\Traits\Method;

trait EmployerAttributesMethod
{
    public function toArray()
    {
        $data = parent::toArray();
        $data['legal_document_url'] = $this->legal_document_url;
        $data['office_photo_url'] = $this->office_photo_url;

        return $data;
    }
}
