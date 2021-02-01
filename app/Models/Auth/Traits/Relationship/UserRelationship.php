<?php

namespace App\Models\Auth\Traits\Relationship;

use App\Device;
use App\Models\AssignmentRequestTasker;
use App\Models\Auth\PasswordHistory;
use App\Models\Auth\SocialAccount;
use App\Models\Auth\TaskerAttributes;
use App\Models\CreditCard;
use App\Models\Invoice;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class UserRelationship.
 *
 * @property Collection|Device[] devices
 * @property Collection|Invoice[] employer_commission_not_paid_invoices
 * @property Collection|Invoice[] employer_commission_paid_invoices
 * @property Collection|Invoice[] employer_tasker_amount_paid_invoices
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->hasMany(PasswordHistory::class);
    }

    /**
     * @return MorphTo
     */
    public function user_attributes()
    {
        return $this->morphTo('user_attributes', 'user_type', 'attributes_id');
    }

    /**
     * @return HasMany
     */
    public function credit_cards()
    {
        return $this->hasMany(CreditCard::class);
    }

    public function tasker_assignment_request_taskers()
    {
        return $this->hasMany(AssignmentRequestTasker::class, 'tasker_id');
    }

    public function employer_assignment_request_taskers()
    {
        return $this->hasManyThrough(AssignmentRequestTasker::class, Task::class, 'employer_id', 'task_id');
    }

    public function owned_tasks()
    {
        $this->hasMany(Task::class, 'employer_id');
    }

    public function devices()
    {
        return $this->hasMany(Device::class, 'owner_id');
    }

    /**
     * @return HasMany
     */
    public function tasker_invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'tasker_id');
    }

    /**
     * @return HasMany
     */
    public function employer_invoices()
    {
        return $this->hasMany(Invoice::class, 'employer_id');
    }

    public function tasker_attributes()
    {
        return $this->belongsTo(TaskerAttributes::class, 'attributes_id')->where('user_type', 'tasker');
    }

    /**
     * @return HasMany
     */
    public function employer_commission_not_paid_invoices()
    {
        return $this->employer_invoices()->where('commission_paid', false);
    }

    /**
     * @return HasMany
     */
    public function tasker_invoices_not_cleared()
    {
        return $this->tasker_invoices()->where('tasker_amount_cleared', false);
    }

    /**
     * @return HasMany
     */
    public function employer_tasker_amount_not_paid_invoices()
    {
        return $this->employer_invoices()->where('tasker_amount_paid', false);
    }

    /**
     * @return HasMany
     */
    public function employer_commission_paid_invoices()
    {
        return $this->employer_invoices()->where('commission_paid', true);
    }

    /**
     * @return HasMany
     */
    public function employer_tasker_amount_paid_invoices()
    {
        return $this->employer_invoices()->where('tasker_amount_paid', true);
    }
}
