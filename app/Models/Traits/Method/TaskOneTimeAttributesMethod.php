<?php
/**
 * User: amir
 * Date: 2/26/20
 * Time: 11:07 AM
 */

namespace App\Models\Traits\Method;

use Carbon\Carbon;

trait TaskOneTimeAttributesMethod
{
    public function setStartTimeAttribute($startTime)
    {
        if (count(explode(':', $startTime)) === 2) {
            $startTime .= ':00';
        }

        $this->attributes['start_time'] = $startTime;
    }

    public function setEndTimeAttribute($endTime)
    {
        if (count(explode(':', $endTime)) === 2) {
            $endTime .= ':00';
        }

        $this->attributes['end_time'] = $endTime;
    }

    public function getStartAt(): string
    {
        return $this->start_date->format('Y-m-d').' '.$this->start_time;
    }

    public function getEndAt(): string
    {
        return $this->start_date->format('Y-m-d').' '.$this->end_time;
    }

    public function duration(): float
    {
        $durationInMinutes =
            Carbon::createFromFormat('Y-m-d H:i:s', $this->getEndAt())->diffInMinutes(
                Carbon::createFromFormat('Y-m-d H:i:s', $this->getStartAt())
            );
        ;

        return (float) $durationInMinutes / 60;
    }
}
