<?php
/**
 * User: amir
 * Date: 2/26/20
 * Time: 11:07 AM
 */

namespace App\Models\Traits\Method;

use Carbon\Carbon;

trait TaskContinuedAttributesMethod
{
    public function getStartAt(): string
    {
        return $this->start_at;
    }

    public function getEndAt(): string
    {
        $endAt = Carbon::createFromFormat('Y-m-d H:i:s', $this->end_date->format('Y-m-d').' '.$this->start_at->format('H:i:s'))->addHours($this->daily_duration);

        if ($endAt->format('Y-m-d') > $this->end_date->format('Y-m-d')) {
            throw new \InvalidArgumentException("Task's daily duration and start time cause job finish after 23:59:59.");
        }

        return $endAt;

    }

    public function duration(): float
    {
        /** @var Carbon $endDate */
        $endDate = $this->end_date;
        $duration = $endDate->diffInDays($this->start_at->setTime(0,0,0)) + 1;

        return $duration * $this->daily_duration;
    }
}
