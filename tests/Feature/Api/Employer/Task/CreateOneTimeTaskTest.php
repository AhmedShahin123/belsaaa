<?php

namespace Tests\Feature\Api\Employer\Task;

use App\Models\Auth\User;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CreateOneTimeTaskTest extends TestCase
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
            'hour_rate' => '10',
            'required_tasker_number' => 2,
            'task_type' => 'one_time',
            'one_time_start_date' => Carbon::tomorrow()->format('Y-m-d'),
            'one_time_start_time' => '10:00',
            'one_time_end_time' => '16:00',
            'latitude' => 10.2,
            'longitude' => 10.2,
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('tasks', [
            'title' => 'Task Title',
            'description' => 'Task Description',
            'task_type' => 'one_time',
            'status' => 'initiate',
            'latitude' => 10.2,
            'longitude' => 10.2,
            'employer_id' => $employer->id,
            'hour_rate' => 10,
            'required_tasker_number' => 2,
            'required_tasker_gender' => null,
            'start_at' => Carbon::tomorrow()->format('Y-m-d').' 10:00:00',
        ]);

        $task = Task::query()->where('employer_id', $employer->id)->latest()->first();

        $this->assertDatabaseHas('task_one_time_attributes', [
            'id' => $task->attributes_id,
            'start_date' => Carbon::tomorrow()->format('Y-m-d'),
            'start_time' => "10:00:00",
            'end_time' => "16:00:00",
        ]);
    }
}
