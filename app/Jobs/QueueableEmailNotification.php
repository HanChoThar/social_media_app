<?php

namespace App\Jobs;

use App\Services\NotificationServices\EmailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class QueueableEmailNotification extends EmailNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct($to, $subject, $message)
    {
        parent::__construct($to, $subject, $message);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
