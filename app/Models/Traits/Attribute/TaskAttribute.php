<?php
/**
 * User: amir
 * Date: 7/2/20
 * Time: 1:42 AM
 */

namespace App\Models\Traits\Attribute;


use App\Models\Invoice;

/**
 * Trait TaskAttribute
 *
 * @property boolean tasker_amount_paid
 */
trait TaskAttribute
{
    public function getPriceAttribute()
    {
        return $this->employer_amount();
    }

    public function getTaskerAmountPaidAttribute()
    {
        /** @var Invoice $invoice */
        foreach ($this->invoices as $invoice) {
            if (!$invoice->tasker_amount_paid) {
                return false;
            }
        }
        return true;
    }

    public function getDurationAttribute()
    {
        $duration = $this->task_attributes->duration();

        return round($duration < 1 ? 1.0 : $duration , 2);
    }

//    public function getEndAtAttribute()
//    {
//        return $this->attributes['end_at'] ?? (method_exists($this->task_attributes, 'getEndAt') ? $this->task_attributes->getEndAt() : null);
//    }
}
