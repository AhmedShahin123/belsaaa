<?php
/**
 * User: amir
 * Date: 2/2/20
 * Time: 8:15 PM
 */

namespace App\Models\Interfaces;

interface TaskInterface
{
    // Status Constants
    const STATUS_NEW = 'new';
    const STATUS_INITIATE = 'initiate';
    const STATUS_SELECTED_BY_TASKER = 'selected_by_tasker';
    const STATUS_APPROVED_BY_EMPLOYER = 'approved_by_employer';
    const STATUS_SENDING = 'sending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_STARTED = 'started';
    const STATUS_FINISHED = 'finished';
    const STATUS_CANCELED = 'canceled';
    const STATUS_REJECTED = 'sent_to_admin';
    const STATUS_EXPIRED = 'expired';

    const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_INITIATE,
        self::STATUS_SELECTED_BY_TASKER,
//        self::STATUS_APPROVED_BY_EMPLOYER,
        self::STATUS_SENDING,
        self::STATUS_ACCEPTED,
        self::STATUS_REJECTED,
        self::STATUS_STARTED,
        self::STATUS_FINISHED,
        self::STATUS_CANCELED,
        self::STATUS_EXPIRED,
    ];

    // Task Type Constants
    const TASK_TYPE_ONE_TIME = 'one_time';
    const TASK_TYPE_REPEATED = 'repeated';
    const TASK_TYPE_CONTINUED = 'continued';

    const TASK_TYPES = [
        self::TASK_TYPE_ONE_TIME,
        self::TASK_TYPE_REPEATED,
        self::TASK_TYPE_CONTINUED,
    ];
}
