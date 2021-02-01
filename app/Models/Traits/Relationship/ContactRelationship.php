<?php
/**
 * User: amir
 * Date: 3/24/20
 * Time: 5:00 AM
 */

namespace App\Models\Traits\Relationship;


use App\Models\ContactCategory;

trait ContactRelationship
{
    public function category()
    {
        return $this->belongsTo(ContactCategory::class);
    }
}
