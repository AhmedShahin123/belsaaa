<?php
/**
 * User: amir
 * Date: 5/10/20
 * Time: 3:50 PM
 */

namespace App\Models\Traits\Relationship;


use App\Models\Auth\TaskerAttributes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property TaskerAttributes tasker_attributes
 */
trait TaskerBankAccountRelationship
{
    /**
     * @return BelongsTo
     */
    public function tasker_attributes()
    {
        return $this->belongsTo(TaskerAttributes::class);
    }
}
