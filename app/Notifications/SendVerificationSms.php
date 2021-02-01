<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Models\Auth\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendVerificationSms extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     * @param User $notifiable
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $via = ['database'];

        if ($notifiable->hasNonExpiredCode()) {
            $via[] = SmsChannel::class;
        }

        return $via;
    }

    /**
     * @param User $notifiable
     * @return string
     */
    public function toSms($notifiable)
    {
        return sprintf('Your verification code is: %s', $notifiable->verification_code);
    }

    /**
     * Get the array representation of the notification.
     * @param User $notifiable
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'verification_code' => $notifiable->verification_code,
            'verification_expires_at' => $notifiable->phone_verification_expires_at->format('Y-m-d H:i:s'),
        ];
    }
}
