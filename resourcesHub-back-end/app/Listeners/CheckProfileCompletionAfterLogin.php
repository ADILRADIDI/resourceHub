<?php

namespace App\Listeners;

use App\Jobs\CheckUserProfileCompletion;
use Illuminate\Auth\Events\Login;

class CheckProfileCompletionAfterLogin
{
    public function handle(Login $event)
    {
        // Dispatch the job to check profile completeness
        CheckUserProfileCompletion::dispatch($event->user);
    }
}
