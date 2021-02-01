<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Method\TaskerAttributesMethod;
use App\Models\Auth\Traits\Relationship\TaskerAttributesRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskerAttributes
 *
 * @property string    address
 * @property string    national_number
 * @property string    gender
 * @property \DateTime birth_date
 * @property string    bio
 * @property integer   hour_rate
 */
class TaskerAttributes extends Model
{
    use TaskerAttributesRelationship, TaskerAttributesMethod;

    protected $fillable = [
        'address',
        'national_number',
        'gender',
        'birth_date',
        'bio',
        'hour_rate',
        'available_until',
    ];
    protected $casts = [
        'birth_date' => 'date',
        'available_until' => 'date',
    ];
}
