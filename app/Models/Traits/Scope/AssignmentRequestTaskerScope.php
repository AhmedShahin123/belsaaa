<?php
/**
 * User: amir
 * Date: 2/26/20
 * Time: 9:23 AM
 */

namespace App\Models\Traits\Scope;


use Illuminate\Database\Eloquent\Builder;

trait AssignmentRequestTaskerScope
{
    public function scopeStatus(Builder $query, $status, $operator = '=')
    {
        if (is_array($status)) {
            return $query->whereIn('assignment_request_taskers.status', $status);
        } else {
            return $query->where('assignment_request_taskers.status', $operator, $status);
        }
    }
}
