<?php

namespace App\Models;

use App\Models\Interfaces\PaymentInterface;
use App\Models\Traits\Method\PaymentMethod;
use App\Models\Traits\Relationship\PaymentRelationship;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Attribute\PaymentAttribute;
use Illuminate\Support\Collection;

/**
 * Class Payment
 *
 * @property float                amount
 * @property string               status
 * @property string               target
 * @property array                details
 * @property Invoice[]|Collection invoices
 * @property CreditCard           credit_card
 */
class Payment extends Model implements PaymentInterface
{
    use PaymentAttribute, PaymentRelationship, PaymentMethod;

    protected $with = ['credit_card'];

    protected $fillable = [
        'amount',
        'status',
        'details',
        'target',
        'credit_card_id',
    ];

    protected $casts = [
        'details' => 'array',
        'amount' => 'float',
    ];

    protected $attributes = [
        'details' => '[]',
    ];

    protected $hidden = [
        'details',
    ];

    protected $visible = [
        'redirect_url',
        'credit_card_id',
        'credit_card',
        'status',
        'amount',
        'target',
        'id',
    ];
}
