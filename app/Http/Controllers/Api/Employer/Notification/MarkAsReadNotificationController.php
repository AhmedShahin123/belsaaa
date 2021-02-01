<?php
/**
 * User: amir
 * Date: 11/5/20
 * Time: 11:22 AM
 */

namespace App\Http\Controllers\Api\Employer\Notification;

use App\Http\Controllers\Api\Controller;
use App\Repositories\NotificationRepository;
use Illuminate\Notifications\DatabaseNotification;

class MarkAsReadNotificationController extends Controller
{
    public function __invoke(DatabaseNotification $notification, NotificationRepository $repository)
    {
        $notification = $repository->getNotificationByUser($notification, $this->user());

        if (!$notification) {
            abort(403);
        }

        $repository->markAsRead($notification);

        return [
            'notification' => $notification,
            'read_notification_count' => $this->user()->notifications()->getQuery()->whereNull('read_at')->count(),
        ];
    }
}
