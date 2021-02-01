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

class CreateContinuedTaskTest extends TestCase
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
            'task_type' => 'continued',
            "continued_start_at" => "2020-02-15 08:15:00",
            "continued_daily_duration" => 10,
            "continued_end_date" => "2020-03-15"
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('tasks', [
            'title' => 'Task Title',
            'description' => 'Task Description',
            'task_type' => 'continued',
            'status' => 'initiate',
            'latitude' => 10.2,
            'longitude' => 10.2,
            'employer_id' => $employer->id,
            'hour_rate' => 10,
            'required_tasker_number' => 2,
            'required_tasker_gender' => null,
            'start_at' => '2020-02-15 08:15:00',
        ]);

        $task = Task::query()->where('employer_id', $employer->id)->latest()->first();

        $this->assertDatabaseHas('task_continued_attributes', [
            'id' => $task->attributes_id,
            'start_at' => "2020-02-15 08:15:00",
            'daily_duration' => 10,
            'end_date' => '2020-03-15'
        ]);
    }
}
