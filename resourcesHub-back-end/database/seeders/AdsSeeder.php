<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        $ads = [
            [
                'title' => 'Get account premium in resourceHub',
                'description' => 'This is a brief description of the ad. It highlights key information and benefits.',
                'url' => 'https://example.com/premium-account',
                'image_url' => 'https://example.com/images/ad_image_2.jpg',
            ],
            [
                'title' => 'Ad Heading 1',
                'description' => 'Neon is the official database partner of Resource.',
                'url' => 'https://example.com/official-partner',
                'image_url' => 'https://example.com/images/ad_image_1.jpg',
            ],
            [
                'title' => 'Do you know Perplexity ai',
                'description' => 'This is a brief description of the ad. It highlights key information and benefits.',
                'url' => 'https://example.com/perplexity-ai',
                'image_url' => 'https://example.com/images/ad_image_3.jpg',
            ],
            // Add more ads as needed
        ];

        DB::table('ads')->insert($ads);
    }
}
