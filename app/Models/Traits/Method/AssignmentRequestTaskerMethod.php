<?php
/**
 * User: amir
 * Date: 2/2/20
 * Time: 8:03 PM
 */

namespace App\Models\Traits\Method;


use App\Models\Interfaces\TaskInterface;
use App\Models\Rating;
use Illuminate\Support\Carbon;

trait AssignmentRequestTaskerMethod
{
    public function setStatus($status, array $context = [])
    {
        $this->fill(array_merge([
            'status' => $status,
            'status_updated_at' => Carbon::now(),
        ], $context));
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function pend()
    {
        $this->apply('pend');
    }

    public function tasker_accept()
    {
        $this->apply('tasker_accept');
    }

    public function tasker_reject()
    {
        $this->apply('tasker_reject');
    }

    public function tasker_timeout()
    {
        $this->apply('tasker_timeout');
    }

    public function employer_accept()
    {
        $this->apply('employer_accept');
    }

    public function employer_reject()
    {
        $this->apply('employer_reject');
    }

    public function employer_timeout()
    {
        $this->apply('employer_timeout');
    }

    public function close()
    {
        $this->apply('close');
    }

    public function canRate(int $userId)
    {
        return
            $this->status === self::STATUS_EMPLOYER_ACCEPTED &&
            $this->task->status === TaskInterface::STATUS_FINISHED &&
            $this->task->employer->id === $userId
        ;
    }

    public function aggregateUserRating(Rating $rating, ?int $oldRate = null)
    {
        $this->tasker->addRate($rating->rating, $oldRate);
    }
}
