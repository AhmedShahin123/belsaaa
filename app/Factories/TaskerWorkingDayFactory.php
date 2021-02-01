<?php
/**
 * User: amir
 * Date: 2/15/20
 * Time: 12:47 AM
 */

namespace App\Factories;


use App\Models\Auth\TaskerAttributes;
use App\Models\Auth\TaskerWorkingDay;

class TaskerWorkingDayFactory
{
    public function create(TaskerAttributes $taskerAttributes, \DateTime $date, $shift, $startTime, $endTime)
    {
        $taskerWorkingDay = new TaskerWorkingDay();
        $taskerWorkingDay->fill([
            'shift' => $shift,
            'date' => $date,
            'start' => $startTime,
            'end' => $endTime,
        ]);
        $taskerWorkingDay->tasker_attributes()->associate($taskerAttributes);
        $taskerWorkingDay->save();

        return $taskerWorkingDay;
    }
}
