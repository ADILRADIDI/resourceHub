<?php

namespace App\Jobs;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class UpdateEventStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        // Optional parameters
    }

    
    public function handle()
    {
        Log::info('Job started for event update.');

        // Update events to 'en cours'
        $updatedEnCours = Event::where('status', 'planifié')
            ->where('end_time', '>', now())
            ->where('start_time', '<=', now())
            ->update(['status' => 'en cours']);

        // Update events to 'terminé'
        $updatedTermine = Event::where('status', 'planifié')
            ->where('end_time', '<', now())
            ->update(['status' => 'terminé']);

        Log::info('Number of events updated to \'En cours\': ' . $updatedEnCours);
        Log::info('Number of events updated to \'Terminé\': ' . $updatedTermine);

        Log::info('Job completed.');
    }


    

}
