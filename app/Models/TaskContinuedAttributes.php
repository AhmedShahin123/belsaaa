<?php

namespace App\Models;

use App\Models\Traits\Method\TaskContinuedAttributesMethod;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskContinuedAttributes
 *
 * @property DateTime|Carbon start_at
 * @property DateTime|Carbon end_date
 * @property integer         daily_duration
 */
class TaskContinuedAttributes extends Model
{
    use TaskContinuedAttributesMethod;

    protected $fillable = ['start_at', 'daily_duration', 'end_date'];

    protected $casts = [
        'start_at' => 'datetime',
        'end_date' => 'datetime',
    ];
}
