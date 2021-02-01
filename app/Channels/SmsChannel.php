<?php
/**
 * User: amir
 * Date: 7/27/20
 * Time: 2:33 PM
 */

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Multicaret\Unifonic\UnifonicFacade;

class SmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);

        $number = (string) $notifiable->routeNotificationForSms($notification);
        if ($number[0] === '+') {
            $number = (int) substr($number, 1);
        }

        $response = UnifonicFacade::send($number, $message);

        Log::channel('request')->info('sms sent', [
            'message' => $message,
            'number' => $number,
            'response' => $response,
        ]);

        return $response;
    }
}
