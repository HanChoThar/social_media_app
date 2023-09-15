<?php

namespace App\Repositories;

use App\Helpers\SystemNotification;
use App\Jobs\QueueableEmailNotification;
use App\Jobs\QueueableNotification;
use App\Models\User;
use Illuminate\Support\Str;
use App\Services\AuthServices\AuthServiceInterface;
use App\Services\NotificationServices\EmailNotification;

class AuthRepositories
{
    use SystemNotification;

    public function login($request, AuthServiceInterface $authService)
    {
        return $authService->login($request);
    }

    public function logout(AuthServiceInterface $authService)
    {
        return $authService->logout();
    }

    public function resendPassword($request)
    {
        $uppercase = Str::random(1, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $lowercase = Str::random(1, 'abcdefghijklmnopqrstuvwxyz');
        $number = Str::random(1, '0123456789');
        $specialChar = Str::random(1, '!@#$%^&*()_+-=[]{}|;:,.<>?');
    
        $allChars = $uppercase . $lowercase . $number . $specialChar;
    
        $remainingChars = Str::random(4, $allChars);
    
        $password = str_shuffle($allChars . $remainingChars);

        User::where('email', $request->email)->update([
            'password' => bcrypt($password)
        ]);

        $emailNoti = new EmailNotification($request->email, 'Reset Password', $password, 'notification.email');
        $this->sendAsyncNotification(new QueueableNotification($emailNoti));

        return response()->json(['success' => 'Password sent!']);
    }


}