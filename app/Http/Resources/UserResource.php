<?php

namespace App\Http\Resources;

use App\Models\Auth\User;
use App\Models\Task;
use App\Repositories\NotificationRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = $this->resource->toArray();

        if ($this->resource->user_type === 'tasker') {
            /** @var Collection $tasks */
            $tasks = $this->resource->invoiced_tasker_tasks;
            $data['total_worked_hours'] = $tasks->sum(function (Task $task) {
                return $task->task_attributes->duration();
            });

            $data['total_earned_money'] = $this->resource->tasker_invoices()->sum('tasker_amount');
        }

        /** @var User $user */
        $user = $this->resource;

        /** @var NotificationRepository $notificationRepository */
        $notificationRepository = app(NotificationRepository::class);
        $data['read_notification_count'] = $user->notifications()->getQuery()
            ->whereNull('read_at')
            ->whereIn('type', $notificationRepository->visibleNotificationTypesForUser())
            ->count();

        return $data;
    }
}
