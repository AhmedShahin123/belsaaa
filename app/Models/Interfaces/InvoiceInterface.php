<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 3:01 AM
 */

namespace App\Models\Interfaces;

interface InvoiceInterface
{
    const PAYMENT_TYPE_CASH = 'cash';
    const PAYMENT_TYPE_ONLINE = 'online';

    const PAYMENT_TYPES = [
        self::PAYMENT_TYPE_CASH,
        self::PAYMENT_TYPE_ONLINE,
    ];
}
