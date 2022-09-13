<?php

namespace App\Channels;

use Ghasedak\GhasedakApi;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    public function send($notifiable, Notification $notification)
    {
//        dd($notifiable,$notification->code);
        return 'Done';

        $receptor = $notifiable->cellphone;
        $type = 1;
        $template = "Store";
        $param1 = $notification->code;

        $api = new GhasedakApi(env('GHASEDAK_API_KEY'));
        $api->Verify($receptor, $type, $template, $param1);

    }
}
