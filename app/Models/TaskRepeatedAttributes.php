<?php

namespace App\Models;

use App\Models\Traits\Method\TaskRepeatedAttributesMethod;
use App\Models\Traits\Relationship\TaskRepeatedAttributesRelationship;
use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskRepeatedAttributes
 *
 * @property DateTime         start_date
 * @property DateTime         end_date
 */
class TaskRepeatedAttributes extends Model
{
    const DAY_MONDAY = 'monday';
    const DAY_TUESDAY = 'tuesday';
    const DAY_WEDNESDAY = 'wednesday';
    const DAY_THURSDAY = 'thursday';
    const DAY_FRIDAY = 'friday';
    const DAY_SATURDAY = 'saturday';
    const DAY_SUNDAY = 'sunday';

    const WEEKDAYS = [
        self:: DAY_MONDAY,
        self:: DAY_TUESDAY,
        self:: DAY_WEDNESDAY,
        self:: DAY_THURSDAY,
        self:: DAY_FRIDAY,
        self:: DAY_SATURDAY,
        self:: DAY_SUNDAY,
    ];

    use TaskRepeatedAttributesRelationship, TaskRepeatedAttributesMethod;

    protected $fillable = [
        'start_date',
        'end_date',
        'repeat',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'repeat' => 'boolean'
    ];
}
