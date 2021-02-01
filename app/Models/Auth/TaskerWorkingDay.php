<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Relationship\TaskerWorkingDayRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string weekday
 */
class TaskerWorkingDay extends Model
{
    use TaskerWorkingDayRelationship;

    protected $fillable = ['shift', 'date', 'start', 'end'];

    protected $casts = [
        'date' => 'datetime',
    ];
}
