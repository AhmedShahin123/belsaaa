<?php
/**
 * User: amir
 * Date: 2/16/20
 * Time: 8:17 PM
 */

namespace App\Models\Interfaces;


interface AssignmentRequestTaskerInterface
{
    const STATUS_NEW = 'new';
    const STATUS_PENDING = 'pending';
    const STATUS_TASKER_REJECTED = 'tasker_rejected';
    const STATUS_TASKER_TIMEOUT = 'tasker_timeout';
    const STATUS_TASKER_ACCEPTED = 'tasker_accepted';
    const STATUS_EMPLOYER_REJECTED = 'employer_rejected';
    const STATUS_EMPLOYER_ACCEPTED = 'employer_accepted';
    const STATUS_EMPLOYER_TIMEOUT = 'employer_timeout';
    const STATUS_CLOSED = 'closed';

    const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_PENDING,
        self::STATUS_TASKER_REJECTED,
        self::STATUS_TASKER_ACCEPTED,
        self::STATUS_TASKER_TIMEOUT,
        self::STATUS_EMPLOYER_REJECTED,
        self::STATUS_EMPLOYER_ACCEPTED,
        self::STATUS_EMPLOYER_TIMEOUT,
        self::STATUS_CLOSED,
    ];
}
