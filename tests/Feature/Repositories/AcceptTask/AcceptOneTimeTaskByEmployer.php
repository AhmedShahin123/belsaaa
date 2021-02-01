<?php

namespace Tests\Feature\Repositories\AcceptTask;

use App\Models\AssignmentRequestTasker;
use App\Models\Interfaces\TaskInterface;
use App\Models\Task;
use App\Repositories\AssignmentRequestTaskerRepository;
use App\Repositories\TaskRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\CreateTask;

class AcceptOneTimeTaskByEmployer extends TestCase
{
    use RefreshDatabase, CreateTask;

    /**
     * @var AssignmentRequestTaskerRepository
     */
    private $assignmentRequestTaskerRepo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->assignmentRequestTaskerRepo = app(AssignmentRequestTaskerRepository::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAcceptOneTimeTask()
    {
        $task = $this->createTaskAndSend();
        $firstRequestTasker = $task->assignment_request_taskers[0];

        $now = Carbon::now();
        Carbon::setTestNow($now);
        $this->assignmentRequestTaskerRepo->taskerAccept($firstRequestTasker);
        Carbon::setTestNow(null);
        /** @var Task $task */
        $task = Task::find($task->id);
        $this->assertEquals($now->format('Y-m-d H:i:s'), $task->last_tasker_accepted_at->format('Y-m-d H:i:s'));
        $this->assertEquals('tasker_accepted', $firstRequestTasker->status);

        $this->assignmentRequestTaskerRepo->employerAccept($firstRequestTasker);
        /** @var Task $task */
        $task = Task::find($task->id);
        $this->assertEquals(TaskInterface::STATUS_ACCEPTED, $task->status);
    }

    public function testAcceptByTaskerButDoesntAcceptByEmployer()
    {
        $task = $this->createTaskAndSend();
        $firstRequest = $task->assignment_request_taskers[0];
        $secondRequest = $task->assignment_request_taskers[1];
        $thirdRequest = $task->assignment_request_taskers[2];
        $this->assignmentRequestTaskerRepo->taskerAccept($firstRequest);
        $this->assignmentRequestTaskerRepo->taskerTimeout($secondRequest);
        $this->assignmentRequestTaskerRepo->taskerTimeout($thirdRequest);

        $this->assertGreaterThan(3, AssignmentRequestTasker::query()->where('task_id', $task->id)->count());

        /** @var Task $task */
        $task = Task::find($task->id);
        $fourthRequest = $task->assignment_request_taskers[3];
        $fifthRequest = $task->assignment_request_taskers[4];

    }

    /**
     * @return Task
     */
    private function createTaskAndSend()
    {
        $this->seed(\UserTableSeeder::class);

        $task = $this->createOneTimeTask(null, Carbon::now()->addDays(1));

        $query = app(TaskRepository::class)->byStartWithinQuery(14);
        $this->assertCount(1, $query->cursor());

        $taskRepo = app(TaskRepository::class);
        $now = Carbon::now();
        Carbon::setTestNow($now);
        $taskRepo->send($task);
        Carbon::setTestNow(null);
        $this->assertDatabaseHas('assignment_request_taskers', [
            'task_id' => $task->id,
        ]);
        $this->assertCount(3, AssignmentRequestTasker::query()->where('task_id', $task->id)->cursor());
        $this->assertEquals($now->format('Y-m-d H:i:s'), $task->last_request_sent_at->format('Y-m-d H:i:s'));

        return $task;
    }
}
