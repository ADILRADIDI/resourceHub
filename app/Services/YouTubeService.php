<?php

namespace App\Services;

use GuzzleHttp\Client;

class YouTubeService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('YOUTUBE_API_KEY');
    }

    public function searchVideos($query, $maxResults = 10)
    {
        $response = $this->client->get('https://www.googleapis.com/youtube/v3/search', [
            'query' => [
                'part' => 'snippet',
                'q' => $query,
                'maxResults' => $maxResults,
                'key' => $this->apiKey,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
