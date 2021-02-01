<?php
/**
 * User: amir
 * Date: 2/16/20
 * Time: 8:08 PM
 */

namespace App\Models\Traits\Relationship;


use App\Models\Auth\User;
use App\Models\Task;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait AssignmentRequestTaskerRelationship
 *
 * @property User              tasker
 * @property Task              task
 */
trait AssignmentRequestTaskerRelationship
{
    /**
     * @return BelongsTo
     */
    public function tasker()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
