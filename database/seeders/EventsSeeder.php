<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                'start_date' => now()->addDays(10),
                'end_date' => now()->addDays(11),
                'status' => 'planifié',
            ],
            [
                'user_id' => 3,
                'title' => 'Art Exhibition',
                'description' => 'An exhibition of contemporary art.',
                'city' => 'Rabat',
                'location' => 'Art Gallery, Rabat',
                'start_date' => now()->addDays(20),
                'end_date' => now()->addDays(22),
                'status' => 'planifié',
            ],
        ]);
    }
}
