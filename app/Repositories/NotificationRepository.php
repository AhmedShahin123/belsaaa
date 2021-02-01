<?php
/**
 * User: amir
 * Date: 2/1/20
 * Time: 10:41 PM
 */

namespace App\Repositories;


use App\Models\Auth\User;
use App\Notifications\EmployerAcceptedTasker;
use App\Notifications\EmployerTaskCanceled;
use App\Notifications\TaskerTaskCanceled;
use App\Notifications\TaskSentToAdmin;
use App\Notifications\EmployerRejectedTasker;
use App\Notifications\TaskerAcceptedTask;
use App\Notifications\TaskerRejectedTask;
use App\Notifications\TaskSentToTasker;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\VarDumper\Cloner\Data;

class NotificationRepository extends BaseRepository
{
    public function __construct(DatabaseNotification $model)
    {
        $this->model = $model;
        $this->orderBys[] = ['column' => 'created_at', 'direction' => 'desc'];
    }

    /**
     * @param User   $user
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     * @param array  $params
     *
     * @return mixed
     */
    public function getForUserPaginated(
        User $user,
        $paged = 25,
        $orderBy = 'created_at',
        $sort = 'desc',
        array $params = []
    ) : LengthAwarePaginator {
        return $this->forUserQuery($user)
            ->whereIn('type', $this->visibleNotificationTypesForUser())
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function forUserQuery(User $user)
    {
        return $user->notifications()
            ->getQuery();
    }

    /**
     * @param User   $user
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     * @param array  $params
     *
     * @return mixed
     */
    public function getForAdminPaginated(
        User $user,
        $paged = 25,
        $orderBy = 'created_at',
        $sort = 'desc',
        array $params = []
    ) : LengthAwarePaginator {
        return $user->notifications()
            ->getQuery()
            ->whereIn('type', $this->visibleNotificationTypesForAdmin())
            ->whereNull('read_at')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function visibleNotificationTypesForUser()
    {
        return [
            EmployerAcceptedTasker::class,
            EmployerRejectedTasker::class,
            EmployerTaskCanceled::class,
            TaskerAcceptedTask::class,
            TaskerRejectedTask::class,
            TaskerTaskCanceled::class,
            TaskSentToAdmin::class,
            TaskSentToTasker::class,
        ];
    }

    public function markAsRead(DatabaseNotification $notification)
    {
        $notification->markAsRead();
    }

    private function visibleNotificationTypesForAdmin()
    {
        return [
            TaskSentToAdmin::class,
        ];
    }

    /**
     * @param DatabaseNotification $notification
     * @param User $user
     *
     * @return DatabaseNotification|null|object
     */
    public function getNotificationByUser(DatabaseNotification $notification, User $user)
    {
        return $this->forUserQuery($user)->where('id', $notification->id)->first();
    }
}
