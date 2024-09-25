<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PodcastsTableSeeder extends Seeder
{
    public function run()
    {
        // Sample data for the podcasts table with online resources
        DB::table('podcasts')->insert([
            [
                'title' => 'Tech Innovations',
                'description' => 'Exploring the latest in technology and innovation.',
                'logo' => '9NujcNeD6kLBaSFZUKiLxla4CVPNYxtmnze7YGlA.jpg',
                'audio_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Health and Wellness',
                'description' => 'Tips and advice for a healthier lifestyle.',
                'logo' => '9NujcNeD6kLBaSFZUKiLxla4CVPNYxtmnze7YGlA.jpg',
                'audio_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Financial Freedom',
                'description' => 'Guides and strategies for financial independence.',
                'logo' => '9NujcNeD6kLBaSFZUKiLxla4CVPNYxtmnze7YGlA.jpg',
                'audio_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
