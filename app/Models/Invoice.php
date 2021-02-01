<?php

namespace App\Models;

use App\Models\Interfaces\InvoiceInterface;
use App\Models\Traits\Relationship\InvoiceRelationship;
use App\Models\Traits\Scope\InvoiceScope;
use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Invoice
 *
 * @property integer  task_id
 * @property integer  employer_id
 * @property integer  tasker_id
 * @property float    employer_amount
 * @property float    commission
 * @property float    tasker_amount
 * @property float    employer_must_pay
 * @property string   payment_type
 * @property DateTime created_at
 * @property DateTime updated_at
 * @property boolean  tasker_amount_paid
 * @property boolean  tasker_amount_cleared
 * @property boolean  commission_paid
 */
class Invoice extends Model implements InvoiceInterface
{
    use InvoiceRelationship, InvoiceScope;

    protected $fillable = [
        'task_id',
        'employer_id',
        'tasker_id',
        'employer_amount',
        'commission',
        'tasker_amount',
        'employer_must_pay',
        'payment_type',
        'tasker_amount_paid',
        'commission_paid',
        'tasker_amount_cleared',
    ];

    protected $casts = [
        'tasker_amount_paid' => 'boolean',
        'tasker_amount_cleared' => 'boolean',
        'commission_paid' => 'boolean',
    ];
}
