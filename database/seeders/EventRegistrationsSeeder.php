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
                'event_id' => 1,
                'user_id' => 2,
                'status' => 'registered',
            ],
            [
                'event_id' => 2,
                'user_id' => 1,
                'status' => 'registered',
            ],
        ]);
    }
}
