<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 2:30 AM
 */

namespace App\Models\Traits\Relationship;


use App\Models\Auth\User;
use App\Models\Payment;
use App\Models\Task;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Trait InvoiceRelationship
 *
 * @property Task    task
 * @property User    tasker
 * @property User    employer
 * @property Payment payment
 */
trait InvoiceRelationship
{
    /**
     * @return BelongsTo
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * @return BelongsTo
     */
    public function tasker()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function employer()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasOne
     */
    public function payments()
    {
        return $this->belongsToMany(Payment::class);
    }
}
