<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use App\Jobs\UpdateEventStatus;

   
class DispatchEventStatusJob extends Command
{ 
    protected $signature = 'event:update-status';
    protected $description = 'Dispatch the UpdateEventStatus job to update event statuses';

    public function __construct()
    {
        parent::__construct(); 
    }

    public function handle()
    {
        UpdateEventStatus::dispatch();
        Log::info('Status update job dispatched successfully');
        Log::info('Scheduler test command ran at ' . now());
        Log::info('---------------------------------------------------------------------------------------------');
        $this->info('Status update job dispatched success bro');
    }
}

