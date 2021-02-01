<?php

namespace App\Notifications;

use App\Models\AssignmentRequestTasker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;

class TaskSentToTasker extends Notification
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
                ->setTitle('مهمة جديدة')
                ->setBody('تم إرسال طلب مهمة جديدة لك')
        )->setData([
            'assignment_request_tasker_id' => (string) $this->assignmentRequestTasker->id,
            'assignment_request_tasker_status' => $this->assignmentRequestTasker->status,
            'task_id' => (string) $this->assignmentRequestTasker->task_id,
            'task_status' => $this->assignmentRequestTasker->task->status,
            'event' => 'task_sent_to_tasker',
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
            'employer' => [
                'name' => $this->assignmentRequestTasker->task->employer->company_name,
                'photo' => $this->assignmentRequestTasker->task->employer->photo_url,
            ],
            'task_id' => $this->assignmentRequestTasker->task_id,
            'task_status' => $this->assignmentRequestTasker->task->status,
            'user_type' => $notifiable->user_type,
            'type' => \Str::kebab(class_basename(self::class)),
        ];
    }
}
