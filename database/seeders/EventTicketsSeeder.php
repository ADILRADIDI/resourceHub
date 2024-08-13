<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventTicketsSeeder extends Seeder
{
    public function run()
    {
        DB::table('event_tickets')->insert([
            [
                'event_registration_id' => 5,
                'token' => Str::random(32),
            ],
            [
                'event_registration_id' => 6,
                'token' => Str::random(32),
            ],
        ]);
    }
}
