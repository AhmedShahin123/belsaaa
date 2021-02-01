<?php
/**
 * User: amir
 * Date: 2/13/20
 * Time: 5:34 PM
 */

namespace App\Factories;


use App\Models\TaskRepeatedAttributes;
use App\Models\TaskRepeatedDay;
use Webmozart\Assert\Assert;

class TaskRepeatedDayFactory
{
    public function create(array $data, TaskRepeatedAttributes $taskRepeatedAttributes): TaskRepeatedDay
    {
        Assert::keyExists($data, 'date');
        Assert::keyExists($data, 'weekday');
        Assert::keyExists($data, 'start_time');
        Assert::keyExists($data, 'end_time');

        $day = new TaskRepeatedDay();
        $day->fill($data);
        $day->repeated_attributes()->associate($taskRepeatedAttributes);
        $day->save();

        return $day;
    }
}
