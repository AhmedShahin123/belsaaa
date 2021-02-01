<?php

namespace App\Notifications\Frontend\Auth;

use App\Channels\SmsChannel;
use App\Models\Auth\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyCellphone extends Notification
{
    use Queueable;
    /**
     * @var string|null
     */
    private $code;

    /**
     * Create a new notification instance.
     *
     * @param string|null $code
     */
    public function __construct($code = null)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', SmsChannel::class];
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
            'code' => $this->code ?? $notifiable->verification_code,
        ];
    }

    /**
     * @param User $notifiable
     * @return string
     */
    public function toSms($notifiable)
    {
        return sprintf('Your verification code is: %s', $notifiable->verification_code);
    }
}
