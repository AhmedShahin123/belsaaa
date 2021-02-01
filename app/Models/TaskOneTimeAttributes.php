<?php

namespace App\Models;

use App\Models\Traits\Method\TaskOneTimeAttributesMethod;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskOneTimeAttributes
 *
 * @property \DateTime start_date
 * @property string    start_time
 * @property string    end_time
 */
class TaskOneTimeAttributes extends Model
{
    use TaskOneTimeAttributesMethod;

    protected $fillable = ['start_date', 'start_time', 'end_time'];

    protected $casts = [
        'start_date' => 'datetime',
    ];
}
