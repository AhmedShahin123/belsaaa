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

trait CreateUser
{
    public function createTasker(): User
    {
        return factory(User::class)->state('tasker')->create();
    }

    public function createEmployer(): User
    {
        return factory(User::class)->state('employer')->create();
    }
}
