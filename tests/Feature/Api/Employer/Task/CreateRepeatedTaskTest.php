<?php

namespace Tests\Feature\Api\Employer\Task;

use App\Models\Auth\User;
use App\Models\Task;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CreateRepeatedTaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateSuccessfully()
    {
        $this->seed(\UserTableSeeder::class);

        $employer = User::query()->where('email', 'employer2@user.com')->first();
        Passport::actingAs(
            $employer,
            ['employer']
        );

        $response = $this->postJson("https://api.belsaa.com/employer/task", [
            'title' => 'Task Title',
            'description' => 'Task Description',
            'hour_rate' => 10,
            'required_tasker_number' => 2,
            'latitude' => 10.2,
            'longitude' => 10.2,
            'task_type' => 'repeated',
            'repeated_days' => [
                [
                    "weekday" => "saturday",
                    "start_time" => "10:23:12",
                    "end_time" => "14:23:12",
                ],
                [
                    "weekday" => "sunday",
                    "start_time" => "10:23:12",
                    "end_time" => "15:23:12",
                ]
            ],
            "repeated_repeat" => true,
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('tasks', [
            'title' => 'Task Title',
            'description' => 'Task Description',
            'task_type' => 'repeated',
            'status' => 'initiate',
            'latitude' => 10.2,
            'longitude' => 10.2,
            'employer_id' => $employer->id,
            'hour_rate' => 10,
            'required_tasker_number' => 2,
            'required_tasker_gender' => null,
            'start_at' => Carbon::now()->format('Y-m-d').' 00:00:00',
        ]);

        $task = Task::query()->where('employer_id', $employer->id)->parent()->latest()->first();

        $this->assertDatabaseHas('task_repeated_attributes', [
            'id' => $task->attributes_id,
            'start_date' => Carbon::now()->format('Y-m-d'),
            'end_date' =>  Carbon::now()->addWeeks(2)->subDay()->format('Y-m-d'),
            'repeat' => true,
        ]);

        $period = CarbonPeriod::create(Carbon::now(), Carbon::now()->addWeeks(2)->subDay());

        /** @var Carbon $date */
        foreach ($period as $date) {
            if ($date->englishDayOfWeek === 'Saturday') {
                $this->assertDatabaseHas('task_repeated_days', [
                    'date' => $date->format('Y-m-d'),
                    'weekday' => strtolower($date->englishDayOfWeek),
                    'start_time' => "10:23:12",
                    'end_time' => "14:23:12",
                ]);

                $this->assertDatabaseHas('tasks', [
                    'parent_id' => $task->id,
                    'title' => 'Task Title - '.$date->format('Y-m-d'),
                    'task_type' => 'one_time',
                ]);
            } elseif ($date->englishDayOfWeek === 'Saturday') {
                $this->assertDatabaseHas('task_repeated_days', [
                    'date' => $date->format('Y-m-d'),
                    'weekday' => strtolower($date->englishDayOfWeek),
                    'start_time' => "10:23:12",
                    'end_time' => "15:23:12",
                ]);
            }
        }
    }
}
