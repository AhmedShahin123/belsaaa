<?php

namespace App\Providers;

use App\Events\TaskCreated;
use App\Listeners\Auth\ForgetPasswordAccessTokenListener;
use App\Listeners\Workflow\AssignmentRequestTaskerWorkflowListener;
use App\Listeners\Workflow\TaskWorkflowListener;
use App\Listeners\Workflow\WorkflowListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider.
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        TaskCreated::class => [
            'App\Listeners\Task\OnRepeatedTaskCreated',
        ],
    ];

    /**
     * Class event subscribers.
     *
     * @var array
     */
    protected $subscribe = [
        // Frontend Subscribers

        // Auth Subscribers
        \App\Listeners\Frontend\Auth\UserEventListener::class,

        // Backend Subscribers

        // Auth Subscribers
        \App\Listeners\Backend\Auth\User\UserEventListener::class,
        \App\Listeners\Backend\Auth\Role\RoleEventListener::class,

        // Workflow Subscribers
        WorkflowListener::class,
        TaskWorkflowListener::class,
        AssignmentRequestTaskerWorkflowListener::class,
        ForgetPasswordAccessTokenListener::class,
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();

        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
