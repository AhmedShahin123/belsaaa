<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 2:26 AM
 */

namespace App\Factories;


use App\Models\Auth\User;
use App\Models\Invoice;
use App\Models\Task;

class InvoiceFactory
{
    public function create(Task $task, User $tasker)
    {
        $employerAmount = $task->employer_amount();
        $commission = setting('commission_rate') / 100 * $employerAmount;
        $taskerAmount = $employerAmount - $commission;

        return $task->invoices()->create([
            'tasker_id' => $tasker->id,
            'employer_id' => $task->employer->id,
            'employer_amount' => $employerAmount,
            'commission' => $commission,
            'tasker_amount' => $taskerAmount,
            'payment_type' => Invoice::PAYMENT_TYPE_CASH,
            'employer_must_pay' => $commission,
        ]);
    }
}
