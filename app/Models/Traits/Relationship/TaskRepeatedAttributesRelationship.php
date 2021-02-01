<?php
/**
 * User: amir
 * Date: 2/13/20
 * Time: 5:39 PM
 */

namespace App\Models\Traits\Relationship;


use App\Models\TaskRepeatedDay;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait TaskRepeatedAttributesRelationship
 *
 * @property TaskRepeatedDay[] days
 */
trait TaskRepeatedAttributesRelationship
{
    /**
     * @return HasMany
     */
    public function days()
    {
        return $this->hasMany(TaskRepeatedDay::class, 'repeated_attributes_id');
    }
}
