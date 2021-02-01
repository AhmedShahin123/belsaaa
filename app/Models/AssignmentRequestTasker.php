<?php

namespace App\Models;

use App\Models\Interfaces\AssignmentRequestTaskerInterface;
use App\Models\Interfaces\RateableInterface;
use App\Models\Traits\Method\AssignmentRequestTaskerMethod;
use App\Models\Traits\Rateable;
use App\Models\Traits\Relationship\AssignmentRequestTaskerRelationship;
use App\Models\Traits\Scope\AssignmentRequestTaskerScope;
use BeSaah\Concerns\HasWorkflow;
use BeSaah\Concerns\HasWorkflowInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AssignmentRequestTasker
 *
 * @property integer   id
 * @property integer   assignment_request_id
 * @property integer   tasker_id
 * @property string    status
 * @property \DateTime status_updated_at
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class AssignmentRequestTasker extends Model implements AssignmentRequestTaskerInterface, HasWorkflowInterface, RateableInterface
{
    use AssignmentRequestTaskerRelationship,
        HasWorkflow,
        AssignmentRequestTaskerMethod,
        AssignmentRequestTaskerScope,
        Rateable;

    protected $attributes = [
        'status' => self::STATUS_NEW,
    ];

    protected $casts = [
        'status_updated_at' => 'datetime',
    ];

    protected $fillable = ['status', 'status_updated_at'];

    protected $with = ['ratings'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('age', function (Builder $builder) {
            $builder->where('task_id', '>', 0);
        });

    }
}
