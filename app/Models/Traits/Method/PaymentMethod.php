<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 4:27 AM
 */

namespace App\Models\Traits\Method;

trait PaymentMethod
{
    public function toArray()
    {
        $data = parent::toArray();
        $data['redirect_url'] = $this->redirect_url;

        return $data;
    }
}
