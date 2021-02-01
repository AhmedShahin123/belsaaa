<?php
/**
 * User: amir
 * Date: 4/12/20
 * Time: 6:40 PM
 */

namespace App\Models\Traits\Scope;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait TaskScope
{
    public function scopeParent(Builder $query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeChild(Builder $query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function scopeTitle(Builder $query, $title)
    {
        return $query->where('tasks.title', 'like', "%$title%");
    }

    public function scopeType(Builder $query, $type)
    {
        return $query->where('tasks.task_type', $type);
    }

    public function scopeStatus(Builder $query, $status)
    {
        return $query->where('tasks.status', $status);
    }

    public function scopeStartWithinDays(Builder $query, int $startWithin)
    {
        return $query
            ->where('tasks.start_at', '<=', Carbon::now()->addDays($startWithin));
    }

    public function scopeCanStart(Builder $query)
    {
        return $query
            ->where('start_at', '<=', Carbon::now())
            ->accepted()
        ;
    }

    public function scopeStartAtPassed(Builder $query)
    {
        return $query->where('start_at', '<=', Carbon::now());
    }

    public function scopeStartAtNotPassed(Builder $query)
    {
        return $query->where('start_at', '>', Carbon::now());
    }

    public function scopeAccepted(Builder $query)
    {
        return $query->status(Task::STATUS_ACCEPTED);
    }

    public function scopeCanFinish(Builder $query)
    {
        return $query
            ->status(Task::STATUS_STARTED)
            ->where('end_at', '<=', Carbon::now())
            ->runnable();
    }

    public function scopeFinished(Builder $query)
    {
        return $query
            ->status(Task::STATUS_FINISHED)
        ;
    }

    public function scopeRunnable(Builder $query)
    {
        return $query
            ->active()
            ->whereIn('task_type', [
                'one_time',
                'continued',
            ]);
    }

    public function scopeActive(Builder $query, $active = true)
    {
        return $query->where('tasks.active', $active);
    }

    public function scopeSentToAdmin(Builder $query)
    {
        return $query->where('tasks.sent_to_admin', true);
    }
}
