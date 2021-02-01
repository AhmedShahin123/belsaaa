<?php
/**
 * User: amir
 * Date: 5/7/20
 * Time: 4:15 AM
 */

namespace App\Models\Traits\Relationship;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CreditCartRelationship
{
    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
