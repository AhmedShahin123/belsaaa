<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 3:01 AM
 */

namespace App\Models\Interfaces;

interface PaymentInterface
{
    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    const STATUS_FAILED = 'failed';

    const TARGET_TASKER_AMOUNT = 'tasker_amount';
    const TARGET_COMMISSION = 'commission';
    const TARGET_FULL = 'full';

    const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_PAID,
    ];

    const TARGETS = [
        self::TARGET_TASKER_AMOUNT,
        self::TARGET_COMMISSION,
        self::TARGET_FULL,
    ];
}
