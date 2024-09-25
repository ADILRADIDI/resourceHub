<?php

namespace App\Jobs;

use App\Services\UserProfileService;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProfileCompletionNotification;

class CheckUserProfileCompletion implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(UserProfileService $profileService)
    {
        $profileStatus = $profileService->isProfileComplete($this->user);

        if (!$profileStatus['complete']) {
            $completionPercentage = $profileStatus['completion_percentage'];
            $message = $completionPercentage < 55 ? 
                "Complete your profile before reaching 55%." :
                "Your profile is incomplete. Complete your profile for a better experience.";
                
            Notification::send($this->user, new ProfileCompletionNotification($message));
        }
    }
}
