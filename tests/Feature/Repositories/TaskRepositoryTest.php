<?php

namespace Tests\Feature\Repositories;

use App\Factories\TaskFactory;
use App\Models\Auth\User;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\CreateTask;

class TaskRepositoryTest extends TestCase
{
    use RefreshDatabase, CreateTask;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testByStartWithinQuery()
    {
        $this->seed(\UserTableSeeder::class);

        $this->createOneTimeTask(null, Carbon::now()->addDays(1));
        $this->createOneTimeTask(null, Carbon::now()->addDays(14));
        $this->createOneTimeTask(null, Carbon::now()->addDays(15));

        $query = app(TaskRepository::class)->byStartWithinQuery(14);
        $this->assertCount(2, $query->cursor());
    }
}
