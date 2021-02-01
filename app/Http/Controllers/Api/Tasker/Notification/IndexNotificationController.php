<?php

namespace App\Http\Controllers\Api\Tasker\Notification;

use App\Http\Controllers\Api\Controller;
use App\Repositories\NotificationRepository;
use Illuminate\Http\Request;

class IndexNotificationController extends Controller
{
    public function __invoke(NotificationRepository $notificationRepository)
    {
        return $notificationRepository->getForUserPaginated($this->user());
    }
}
