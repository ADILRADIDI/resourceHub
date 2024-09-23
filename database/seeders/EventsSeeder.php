<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsSeeder extends Seeder
{
    public function run()
    {
        DB::table('events')->insert([
            [
                'user_id' => 2,
                'title' => 'Tech Conference 2024',
                'description' => 'A conference about the latest in tech.',
                'city' => 'Casablanca',
                'location' => 'Conference Center, Casablanca',
                'start_time' => now()->addDays(10)->setTime(9, 0),  // Start at 9:00 AM
                'end_time' => now()->addDays(11)->setTime(17, 0),    // End at 5:00 PM
                'status' => 'Planifié',  // Ensure the status matches your query in UpdateEventStatus
            ],
            [
                'user_id' => 1,
                'title' => 'Art Exhibition',
                'description' => 'An exhibition of contemporary art.',
                'city' => 'Rabat',
                'location' => 'Art Gallery, Rabat',
                'start_time' => now()->addDays(20)->setTime(10, 0),  // Start at 10:00 AM
                'end_time' => now()->addDays(22)->setTime(18, 0),    // End at 6:00 PM
                'status' => 'Planifié',  // Ensure the status matches your query in UpdateEventStatus
            ],
        ]);
    }
}
