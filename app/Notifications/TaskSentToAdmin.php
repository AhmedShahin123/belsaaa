<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;

class TaskSentToAdmin extends Notification
{
    use Queueable;

    /**
     * @var Task
     */
    private $task;

    /**
     * Create a new notification instance.
     *
     * @return void
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
        $via = ['database'];

        if ($notifiable->user_type === 'employer') {
            $via[] = FcmChannel::class;
        }

        return $via;
    }

    public function toArray($notifiable)
    {
        return [
            'content' => 'A task is been sent to admin. Please take an action on that',
            'link' => route('admin.task.show', $this->task->id),
        ];
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
                ->setTitle('A task is been sent to platform reviewing.')
                ->setBody('A task is been sent to platform reviewing. Please contact to support team.')
        )->setData([
            'task_id' => (string) $this->task->id,
            'event' => 'task_sent_to_admin',
        ]);
    }
}
