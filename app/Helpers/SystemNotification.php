<?php

namespace App\Helpers;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\NotificationServices\NotificationInterface;

trait SystemNotification
{
     /**
     * send notification immediately
     */
    public function sendNotification(NotificationInterface $notification)
    {
        $notification->sendNotification();
    }

    /**
     * send background process notification
     */
    public function sendAsyncNotification(ShouldQueue $queueNotification)
    {
        dispatch($queueNotification);
    }
}