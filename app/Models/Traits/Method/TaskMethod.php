<?php
/**
 * User: amir
 * Date: 2/2/20
 * Time: 8:03 PM
 */

namespace App\Models\Traits\Method;


use App\Models\AssignmentRequestTasker;
use App\Models\Auth\User;
use App\Models\Rating;
use App\Models\Task;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait TaskMethod
{
    public function setStatus($status, array $context = [])
    {
        $this->fill(array_merge(['status' => $status], $context));
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function initiate()
    {
        $this->apply('initiate');
    }

    public function send()
    {
        $this->apply('send');
    }

    public function send_to_admin()
    {
        $this->update(['sent_to_admin' => true]);
    }

    public function reject()
    {
        $this->apply('reject');
    }

    public function start()
    {
        $this->apply('start');
    }

    public function accept()
    {
        $this->apply('accept');
    }

    public function accept_by_taskers()
    {
        $this->apply('accept_by_taskers');
    }

    public function finish()
    {
        $this->apply('finish');
    }

    public function cancel(User $canceledBy)
    {
        $this->apply('cancel', null, ['canceled_by_id' => $canceledBy->id]);
    }

    public function expire()
    {
        $this->apply('expire');
    }

    public function cab_initiate()
    {
        return $this->can('initiate');
    }

    public function can_send()
    {
        return $this->can('send');
    }

    public function can_reject()
    {
        return $this->can('reject');
    }

    public function can_start()
    {
        return $this->can('start');
    }

    public function can_accept_by_taskers()
    {
        return $this->can('accept_by_taskers');
    }

    public function can_accept()
    {
        return $this->can('accept');
    }

    public function can_finish()
    {
        return $this->can('start');
    }

    public function can_cancel()
    {
        return $this->can('cancel');
    }

    public function can_expire()
    {
        return $this->can('expire');
    }

    public function employer_amount()
    {
        if ($this->task_type === 'repeated') {
            return null;
        }

        $duration = $this->task_attributes->duration();

        return $this->task_attributes ? ($duration >= 1 ? $duration : 1) * $this->hour_rate : 0;
    }

    public function should_request_count()
    {
        $remainingNeededTaskersCount = $this->required_tasker_number - $this->employer_accepted_requests()->count();

        return ($remainingNeededTaskersCount * setting('requesting_tasker_count')) -
            ($this->tasker_accepted_requests()->count());
    }

    public function toArray()
    {
        $data = parent::toArray();
        $data['price'] = $this->price * $this->employer_accepted_requests->count();
        $data['tasker_amount_paid'] = $this->tasker_amount_paid;
        $data['duration'] = sprintf('%02d:%02d', (int) $this->duration, fmod($this->duration, 1) * 60);;
        $data['commission_not_paid_amount'] = $this->commission_not_paid_invoices->sum('commission');

        return $data;
    }

    /**
     * @return bool
     */
    public function hasPendingRequests()
    {
        return $this->pending_requests()->getQuery()->exists();
    }

    public function hasNotFinishedRequests()
    {
        return $this->not_finished_requests()->getQuery()->exists();
    }

    public function canRate(int $userId)
    {
        if ($this->status !== self::STATUS_FINISHED) {
            return false;
        }

        /** @var AssignmentRequestTasker $request */
        foreach ($this->employer_accepted_requests as $request) {
            if ($request->tasker_id === $userId) {
                return true;
            }
        }

        return false;
    }

    public function aggregateUserRating(Rating $rating, ?int $oldRate = null)
    {
        $this->employer->addRate($rating->rating, $oldRate);
    }
}
