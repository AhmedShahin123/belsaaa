<?php

namespace App\Models;

use Altek\Accountant\Contracts\Recordable;
use Altek\Accountant\Recordable as RecordableTrait;
use App\Models\Auth\User;
use App\Models\Interfaces\RateableInterface;
use App\Models\Interfaces\TaskInterface;
use App\Models\Traits\Attribute\TaskAttribute;
use App\Models\Traits\Method\TaskMethod;
use App\Models\Traits\Rateable;
use App\Models\Traits\Relationship\TaskRelationShip;
use App\Models\Traits\Scope\TaskScope;
use BeSaah\Concerns\HasWorkflow;
use BeSaah\Concerns\HasWorkflowInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 *
 * @property string                                                               title
 * @property string                                                               description
 * @property integer                                                              city_id
 * @property integer                                                              employer_id
 * @property integer                                                              hour_rate
 * @property integer                                                              required_tasker_number
 * @property string                                                               required_tasker_gender
 * @property \DateTime|Carbon                                                     start_at
 * @property \DateTime|Carbon                                                     end_at
 * @property string                                                               status
 * @property string                                                               task_type
 * @property AssignmentRequestTasker[]|Collection                                 employer_accepted_requests
 * @property float                                                                latitude
 * @property float                                                                longitude
 * @property TaskOneTimeAttributes|TaskContinuedAttributes|TaskRepeatedAttributes task_attributes
 * @property boolean                                                              active
 * @property \DateTime                                                            last_request_sent_at
 * @property \DateTime                                                            last_tasker_accepted_at
 * @property Collection|Invoice[]                                                 tasker_amount_not_paid_invoices
 */
class Task extends Model implements TaskInterface, HasWorkflowInterface, RateableInterface, Recordable
{
    use TaskRelationShip, TaskMethod, HasWorkflow, TaskScope, TaskAttribute, Rateable, RecordableTrait;

    protected $fillable = [
        'active',
        'title',
        'description',
        'city_id',
        'parent_id',
        'employer_id',
        'hour_rate',
        'required_tasker_number',
        'required_tasker_gender',
        'status',
        'task_type',
        'start_at',
        'canceled_by_id',
        'latitude',
        'longitude',
        'last_request_sent_at',
        'last_tasker_accepted_at',
        'sent_to_admin',
        'end_at',
    ];

    protected $attributes = [
        'status' => self::STATUS_NEW,
        'sent_to_admin' => false,
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'last_request_sent_at' => 'datetime',
        'last_tasker_accepted_at' => 'datetime',
        'active' => 'boolean',
        'sent_to_admin' => 'boolean',
    ];

    protected $with = ['employer', 'ratings', 'employer.user_attributes', 'task_attributes', 'invoices', 'commission_not_paid_invoices'];
}
