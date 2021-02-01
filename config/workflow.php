<?php

use App\Models\AssignmentRequestTasker;
use App\Models\Interfaces\TaskInterface;
use App\Models\Task;

return [
    'workflows' => [
        'enabled' => true,
        'workflows' => [
            'task' => [
                'marking_store' => [
                    'type' => 'single_state',
                    'property' => 'status',
                ],
                'supports' => Task::class,
                'places' => Task::STATUSES,
                'transitions' => [
                    'initiate' => [
                        'from' => Task::STATUS_NEW,
                        'to' => Task::STATUS_INITIATE,
                    ],
                    'send' => [
                        'from' => [Task::STATUS_INITIATE, Task::STATUS_SENDING, Task::STATUS_SELECTED_BY_TASKER],
                        'to' => Task::STATUS_SENDING,
                    ],
                    'accept_by_taskers' => [
                        'from' => Task::STATUS_SENDING,
                        'to' => Task::STATUS_SELECTED_BY_TASKER,
                    ],
                    'accept' => [
                        'from' => [Task::STATUS_SELECTED_BY_TASKER, Task::STATUS_SENDING],
                        'to' => Task::STATUS_ACCEPTED,
                    ],
                    'start' => [
                        'from' => Task::STATUS_ACCEPTED,
                        'to' => Task::STATUS_STARTED,
                    ],
                    'finish' => [
                        'from' => Task::STATUS_STARTED,
                        'to' => Task::STATUS_FINISHED,
                    ],
                    'cancel' => [
                        'from' => [Task::STATUS_STARTED, Task::STATUS_ACCEPTED, Task::STATUS_SENDING, Task::STATUS_INITIATE],
                        'to' => Task::STATUS_CANCELED,
                    ],
                    'reject' => [
                        'from' => [
                            TaskInterface::STATUS_INITIATE,
                            TaskInterface::STATUS_NEW,
                            TaskInterface::STATUS_SENDING,
                        ],
                        'to' => Task::STATUS_REJECTED
                    ],
                    'expire' => [
                        'from' => [
                            TaskInterface::STATUS_INITIATE,
                            TaskInterface::STATUS_NEW,
                            TaskInterface::STATUS_SENDING,
                        ],
                        'to' => Task::STATUS_EXPIRED,
                    ],
                ],
            ],
            'assignment_request_tasker' => [
                'marking_store' => [
                    'type' => 'single_state',
                    'property' => 'status',
                ],
                'supports' => AssignmentRequestTasker::class,
                'places' => AssignmentRequestTasker::STATUSES,
                'transitions' => [
                    'pend' => [
                        'from' => AssignmentRequestTasker::STATUS_NEW,
                        'to' => AssignmentRequestTasker::STATUS_PENDING,
                    ],
                    'tasker_accept' => [
                        'from' => AssignmentRequestTasker::STATUS_PENDING,
                        'to' => AssignmentRequestTasker::STATUS_TASKER_ACCEPTED,
                    ],
                    'tasker_reject' => [
                        'from' => AssignmentRequestTasker::STATUS_PENDING,
                        'to' => AssignmentRequestTasker::STATUS_TASKER_REJECTED,
                    ],
                    'tasker_timeout' => [
                        'from' => AssignmentRequestTasker::STATUS_PENDING,
                        'to' => AssignmentRequestTasker::STATUS_TASKER_TIMEOUT,
                    ],
                    'employer_accept' => [
                        'from' => AssignmentRequestTasker::STATUS_TASKER_ACCEPTED,
                        'to' => AssignmentRequestTasker::STATUS_EMPLOYER_ACCEPTED,
                    ],
                    'employer_reject' => [
                        'from' => AssignmentRequestTasker::STATUS_TASKER_ACCEPTED,
                        'to' => AssignmentRequestTasker::STATUS_EMPLOYER_REJECTED,
                    ],
                    'employer_timeout' => [
                        'from' => AssignmentRequestTasker::STATUS_PENDING,
                        'to' => AssignmentRequestTasker::STATUS_EMPLOYER_TIMEOUT,
                    ],
                    'close' => [
                        'from' => AssignmentRequestTasker::STATUS_PENDING,
                        'to' => AssignmentRequestTasker::STATUS_CLOSED,
                    ],
                ],
            ],
        ]
    ]
];

