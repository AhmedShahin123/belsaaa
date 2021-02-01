<?php

namespace Tests\Feature\Command;

use App\Models\Auth\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreateTask;
use Tests\Traits\CreateUser;

class StartSendingTasksToTaskersTest extends TestCase
{
    use RefreshDatabase, CreateTask, CreateUser;

    public function testCanStartOneTime()
    {
        $taskers = [
            1 => $this->createTasker(),
            2 => $this->createTasker(),
            3 => $this->createTasker(),
            4 => $this->createTasker(),
            5 => $this->createTasker(),
            6 => $this->createTasker(),
            7 => $this->createTasker(),
            8 => $this->createTasker(),
            9 => $this->createTasker(),
            10 => $this->createTasker(),
            11 => $this->createTasker(),
        ];

        $employer = $this->createEmployer();

        $task = $this->createOneTimeTask($employer, Carbon::now()->addDay(), [
            'latitude' => 10,
            'longitude' => 10,
            'required_tasker_number' => 2,
        ]);

        $this->artisan('task:send')
            ->assertExitCode(0);


        $this->assertCount(6, $task->assignment_request_taskers);

        for ($i = 1; $i <= 6; $i++) {
            $this->assertDatabaseHas('assignment_request_taskers', [
                'task_id' => $task->id,
                'tasker_id' => $taskers[$i]->id,
                'status' => 'pending',
            ]);
        }

        $this->assertDatabaseMissing('assignment_request_taskers', [
            'task_id' => $task->id,
            'tasker_id' => $taskers[11]->id,
            'status' => 'pending',
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCanNotStartOneTime()
    {
        $this->seed(\UserTableSeeder::class);

        $task = $this->createOneTimeTask(null, Carbon::now()->addDays(15));

        $this->artisan('task:send')
            ->assertExitCode(0);

        $this->assertDatabaseMissing('assignment_request_taskers', [
            'task_id' => $task->id,
        ]);
    }

    public function testCanStartRepeated()
    {
        $days = [
            [
                "weekday" => "saturday",
                "start_time" => "10:23:12",
                "end_time" => "14:23:12",
            ]
        ];

        $taskers = [
            1 => $this->createTasker(),
            2 => $this->createTasker(),
            3 => $this->createTasker(),
            4 => $this->createTasker(),
            5 => $this->createTasker(),
            6 => $this->createTasker(),
            7 => $this->createTasker(),
            8 => $this->createTasker(),
            9 => $this->createTasker(),
            10 => $this->createTasker(),
            11 => $this->createTasker(),
        ];

        $employer = $this->createEmployer();

        $task = $this->createRepeatedTask($employer, $days, [
            'latitude' => 10,
            'longitude' => 10,
            'required_tasker_number' => 2,
        ]);

        $this->artisan('task:send')
            ->assertExitCode(0);

        foreach ($task->children as $childTask) {

            $this->assertCount(6, $task->assignment_request_taskers);


            for ($i = 1; $i <= 6; $i++) {
                $this->assertDatabaseHas('assignment_request_taskers', [
                    'task_id' => $task->id,
                    'tasker_id' => $taskers[$i]->id,
                    'status' => 'pending',
                ]);
            }

            $this->assertDatabaseMissing('assignment_request_taskers', [
                'task_id' => $task->id,
                'tasker_id' => $taskers[11]->id,
                'status' => 'pending',
            ]);
        }
    }
}
