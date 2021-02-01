<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 3:16 AM
 */

namespace App\Models\Traits\Scope;

use Illuminate\Database\Eloquent\Builder;

trait InvoiceScope
{
    public function scopeTaskerId(Builder $query, int $taskerId)
    {
        return $query->where('tasker_id', $taskerId);
    }

    public function scopeEmployerId(Builder $query, int $employerId)
    {
        return $query->where('employer_id', $employerId);
    }

    public function scopeOnline(Builder $query)
    {
        return $query->where('payment_type', 'online');
    }
}
