<?php
/**
 * User: amir
 * Date: 2/26/20
 * Time: 11:07 AM
 */

namespace App\Models\Traits\Method;

trait TaskRepeatedAttributesMethod
{
    public function getStartAt(): string
    {
        return $this->start_date->format('Y-m-d').' 00:00:00';
    }

    public function getEndAt(): string
    {
        return $this->end_date->format('Y-m-d').' 23:59:59';
    }

    public function duration(): float
    {
        return 0;
    }
}
