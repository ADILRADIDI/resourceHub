<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class YouTubeService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('YOUTUBE_API_KEY'); // Ensure this is set correctly in your .env file
    }

    public function searchVideos($query, $maxResults = 10)
    {
        try {
            $requestUrl = 'https://www.googleapis.com/youtube/v3/search';

            $response = $this->client->get($requestUrl, [
                'query' => [
                    'part' => 'snippet',
                    'q' => $query,
                    'maxResults' => $maxResults,
                    'key' => $this->apiKey,
                ],
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);
            \Log::info('YouTube API response: ', $responseData);

            return $responseData;
        } catch (ClientException $e) {
            $response = $e->getResponse();
            \Log::error('YouTube API request failed: ' . $e->getMessage());
            if ($response) {
                \Log::error('Response body: ' . $response->getBody()->getContents());
            }
            return ['error' => 'Unable to retrieve videos.'];
        }
    }

}
