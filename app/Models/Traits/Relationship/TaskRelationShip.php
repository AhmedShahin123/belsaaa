<?php
/**
 * User: amir
 * Date: 2/1/20
 * Time: 10:40 PM
 */

namespace App\Models\Traits\Relationship;


use App\Models\AssignmentRequestTasker;
use App\Models\Auth\EmployerAttributes;
use App\Models\Auth\TaskerAttributes;
use App\Models\Auth\User;
use App\Models\City;
use App\Models\Interfaces\AssignmentRequestTaskerInterface;
use App\Models\Invoice;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use phpDocumentor\Reflection\Types\Self_;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

/**
 * Trait TaskRelationShip
 *
 * @property City                                 city
 * @property User                                 employer
 * @property TaskerAttributes|EmployerAttributes  user_attributes
 * @property User                                 canceled_by
 * @property Task                                 parent
 * @property Task[]                               children
 * @property AssignmentRequestTasker[]|Collection participant_assignment_request_taskers
 * @property Invoice[]|Collection                 invoices
 * @property Invoice[]|Collection                 commission_not_paid_invoices
 * @property Invoice[]|Collection                 tasker_amount_not_paid_invoices
 * @property AssignmentRequestTasker[]|Collection assignment_request_taskers
 * @property AssignmentRequestTasker[]|Collection pending_requests
 * @property AssignmentRequestTasker[]|Collection tasker_accepted_requests
 */
trait TaskRelationShip
{
    use HasRelationships;

    /**
     * @return BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return BelongsTo
     */
    public function employer()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return MorphTo
     */
    public function task_attributes()
    {
        return $this->morphTo('task_attributes', 'task_type', 'attributes_id');
    }

    /**
     * @return HasMany
     */
    public function assignment_request_taskers()
    {
        return $this->hasMany(AssignmentRequestTasker::class);
    }

    /**
     * @return HasMany
     */
    public function participant_assignment_request_taskers()
    {
        return $this->assignment_request_taskers()
            ->whereIn('assignment_request_taskers.status', [
                AssignmentRequestTaskerInterface::STATUS_PENDING,
                AssignmentRequestTaskerInterface::STATUS_TASKER_ACCEPTED,
                AssignmentRequestTaskerInterface::STATUS_EMPLOYER_ACCEPTED,
            ]);
    }

    /**
     * @return HasMany
     */
    public function tasker_accepted_requests()
    {
        return $this->assignment_request_taskers()->where('assignment_request_taskers.status', AssignmentRequestTaskerInterface::STATUS_TASKER_ACCEPTED);
    }

    /**
     * @return HasMany
     */
    public function employer_accepted_requests()
    {
        return $this->assignment_request_taskers()->where('assignment_request_taskers.status', AssignmentRequestTaskerInterface::STATUS_EMPLOYER_ACCEPTED);
    }

    /**
     * @return HasMany
     */
    public function pending_requests()
    {
        return $this->assignment_request_taskers()->where('assignment_request_taskers.status', AssignmentRequestTaskerInterface::STATUS_PENDING);
    }

    /**
     * @return HasMany
     */
    public function not_finished_requests()
    {
        return $this->assignment_request_taskers()->whereIn('assignment_request_taskers.status', [
            AssignmentRequestTasker::STATUS_PENDING,
            AssignmentRequestTasker::STATUS_TASKER_ACCEPTED,
        ]);
    }

    /**
     * @return BelongsTo
     */
    public function canceled_by()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Task::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Task::class, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * @return HasMany
     */
    public function tasker_amount_not_paid_invoices()
    {
        return $this->invoices()->where('tasker_amount_paid', false);
    }

    /**
     * @return HasMany
     */
    public function commission_not_paid_invoices()
    {
        return $this->invoices()->where('commission_paid', false);
    }

    public function payments()
    {
        return $this->hasManyDeepFromRelations($this->invoices(), (new Invoice())->payments())->where('payments.status', 'paid');
    }
}
