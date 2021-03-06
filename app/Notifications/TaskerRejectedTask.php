<?php

namespace App\Notifications;

use App\Models\AssignmentRequestTasker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;

class TaskerRejectedTask extends Notification
{
    use Queueable;

    /**
     * @var AssignmentRequestTasker
     */
    private $assignmentRequestTasker;

    /**
     * Create a new notification instance.
     *
     * @param AssignmentRequestTasker $assignmentRequestTasker
     */
    public function __construct(AssignmentRequestTasker $assignmentRequestTasker)
    {
        $this->assignmentRequestTasker = $assignmentRequestTasker;
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
                ->setTitle('Tasker Rejected Task')
                ->setBody('A tasker rejected your task.')
        )->setData([
            'assignment_request_tasker_id' => (string) $this->assignmentRequestTasker->id,
            'assignment_request_tasker_status' => $this->assignmentRequestTasker->status,
            'task_id' => (string) $this->assignmentRequestTasker->task_id,
            'task_status' => $this->assignmentRequestTasker->task->status,
            'event' => 'tasker_rejected_task',
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
            'assignment_request_tasker_id' => $this->assignmentRequestTasker->id,
            'assignment_request_tasker_status' => $this->assignmentRequestTasker->status,
            'task_id' => $this->assignmentRequestTasker->task_id,
            'task_status' => $this->assignmentRequestTasker->task->status,
            'user_type' => $notifiable->user_type,
            'tasker' => [
                'name' => $this->assignmentRequestTasker->tasker->name,
                'photo' => $this->assignmentRequestTasker->tasker->getFirstMediaUrl('profile'),
            ],
            'type' => \Str::kebab(class_basename(self::class)),
        ];
    }
}
