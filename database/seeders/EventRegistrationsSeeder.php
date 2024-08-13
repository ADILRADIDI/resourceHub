<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventRegistrationsSeeder extends Seeder
{
    public function run()
    {
        DB::table('event_registrations')->insert([
            [
                'event_id' => 5,
                'user_id' => 3,
                'status' => 'registered',
            ],
            [
                'event_id' => 8,
                'user_id' => 2,
                'status' => 'registered',
            ],
        ]);
    }
}
