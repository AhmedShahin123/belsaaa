<?php

namespace App\Models;

use App\Models\Traits\Relationship\TaskRepeatedDayRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskRepeatedDay
 *
 * @property string date
 * @property string start_time
 * @property string end_time
 * @property string weekday
 */
class TaskRepeatedDay extends Model
{
    use TaskRepeatedDayRelationship;

    protected $fillable = ['date', 'weekday', 'start_time', 'end_time'];

    public $timestamps = false;
}
