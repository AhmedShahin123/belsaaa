<?php

namespace App\Notifications;

use App\Models\AssignmentRequestTasker;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;

class EmployerTaskCanceled extends Notification
{
    use Queueable;

    /**
     * @var Task
     */
    private $task;

    /**
     * Create a new notification instance.
     *
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', FcmChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return FcmMessage
     */
    public function toFcm($notifiable)
    {
        return FcmMessage::create()->setNotification(
            \NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle('تم إنسحاب أحد منفذي المهمة')
                ->setBody('تم انسحاب أحد منفذي المهمة من تنفيذ المهمة')
        )->setData([
            'task_id' => (string) $this->task->id,
            'event' => 'employer_task_canceled',
            'task_status' => $this->task->status,
            'user_type' => $notifiable->user_type,
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'task_status' => $this->task->status,
            'user_type' => $notifiable->user_type,
            'tasker' => [
                'name' => $this->task->canceled_by->name,
                'photo' => $this->task->canceled_by->getFirstMediaUrl('profile'),
            ],
            'type' => \Str::kebab(class_basename(self::class)),
        ];
    }
}
