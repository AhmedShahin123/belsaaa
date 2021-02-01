<?php
/**
 * User: amir
 * Date: 2/13/20
 * Time: 5:39 PM
 */

namespace App\Models\Traits\Relationship;


use App\Models\TaskRepeatedAttributes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait TaskRepeatedDayRelationship
{
    /**
     * @return BelongsTo
     */
    public function repeated_attributes()
    {
        return $this->belongsTo(TaskRepeatedAttributes::class, 'repeated_attributes_id');
    }
}
