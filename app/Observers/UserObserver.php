<?php

namespace App\Observers;

use App\Helpers\SystemNotification;
use App\Jobs\QueueableEmailNotification;
use App\Models\User;
use App\Services\NotificationServices\EmailNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    use SystemNotification;
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $welcomeEmail = new EmailNotification($user->email, 'Welcome', $user->name);
        $this->sendAsyncNotification((new QueueableEmailNotification($welcomeEmail)));
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
