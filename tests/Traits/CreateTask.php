<?php
/**
 * User: amir
 * Date: 5/12/20
 * Time: 4:41 AM
 */

namespace Tests\Traits;

use App\Factories\TaskFactory;
use App\Models\Auth\User;
use Carbon\Carbon;

trait CreateTask
{
    public function createOneTimeTask(User $employer = null, \DateTime $startAt = null, array $data = [])
    {
        if (!$employer instanceof User) {
            $employer = User::query()->where('email', 'employer2@user.com')->first();
        }

        $startDate = is_null($startAt) ? Carbon::now()->format('Y-m-d') : $startAt->format('Y-m-d');
        $startTime = '08:00';
        $endTime = '16:00';

        return app(TaskFactory::class)->create(array_merge([
            'title' => 'Task Title',
            'description' => 'Task Description',
            'hour_rate' => '10',
            'required_tasker_number' => 1,
            'task_type' => 'one_time',
            'latitude' => 10.2,
            'active' => true,
            'longitude' => 10.2,
        ], $data), [
            'start_date' => $startDate,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ], $employer);
    }

    public function createRepeatedTask(User $employer = null, array $days = [], array $data = [])
    {
        if (!$employer instanceof User) {
            $employer = User::query()->where('email', 'employer2@user.com')->first();
        }

        return app(TaskFactory::class)->create(array_merge([
            'title' => 'Task Title',
            'description' => 'Task Description',
            'hour_rate' => '10',
            'required_tasker_number' => 1,
            'task_type' => 'repeated',
            'latitude' => 10.2,
            'longitude' => 10.2,
        ], $data), [
            'days' => $days,
            'repeat' => false,
        ], $employer);
    }
}
