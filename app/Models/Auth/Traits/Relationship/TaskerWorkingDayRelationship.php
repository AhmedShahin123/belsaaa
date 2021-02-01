<?php
/**
 * User: amir
 * Date: 2/15/20
 * Time: 12:48 AM
 */

namespace App\Models\Auth\Traits\Relationship;


use App\Models\Auth\TaskerAttributes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait TaskerWorkingDayRelationship
 *
 * @property TaskerAttributes tasker_attributes
 */
trait TaskerWorkingDayRelationship
{
    /**
     * @return BelongsTo
     */
    public function tasker_attributes()
    {
        return $this->belongsTo(TaskerAttributes::class);
    }
}
