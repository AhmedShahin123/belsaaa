<?php
/**
 * User: amir
 * Date: 3/4/20
 * Time: 6:33 PM
 */

namespace App\Http\Controllers\Backend\Notification;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminRequest;
use App\Models\Notification;
use App\Repositories\NotificationRepository;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * @var NotificationRepository
     */
    private $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function index(AdminRequest $request)
    {
        return view('backend.notification.index')
            ->withNotifications($this->notificationRepository->paginate($request->query->get('size', 25)));
    }

    public function show(AdminRequest $request, NotificationRepository $notificationRepository, $notification)
    {
        $notification = $this->notificationRepository->getById($notification);

        if (!$notification) {
            abort(404);
        }

        return view('backend.notification.show')
            ->withNotification($notification);
    }

    public function update(DatabaseNotification $notification)
    {
        $notification->markAsRead();

        return response()->json(['link' => $notification->data['link'] ?? '']);
    }
}
