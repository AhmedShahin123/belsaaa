<?php
/**
 * User: amir
 * Date: 1/30/20
 * Time: 2:43 PM
 */

namespace App\Models\Auth\Traits\Method;

trait TaskerAttributesMethod
{
    public function toArray()
    {
        $data = parent::toArray();
        $data['gained_money'] = 0;

        return $data;
    }
}
