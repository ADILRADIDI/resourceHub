<?php

namespace App\Http\Controllers;

use App\Services\YouTubeService;
use Illuminate\Http\Request;

class YouTubeController extends Controller
{
    protected $youtube;

    public function __construct(YouTubeService $youtube)
    {
        $this->youtube = $youtube;
    }

    // Function to search for crash courses based on programming language
    public function search(Request $request)
    {
        \Log::info('YouTube search method called.');

        $request->validate([
            'language' => 'required|string|max:50',
        ]);

        $language = $request->input('language');
        $searchQuery = $language . ' Crash Course';

        \Log::info('Search query: ' . $searchQuery);

        $videos = $this->youtube->searchVideos($searchQuery);

        \Log::info('YouTube API search result: ', $videos);

        if (isset($videos['items']) && !empty($videos['items'])) {
            $videos['items'] = array_map(function($video) {
                if (isset($video['id']['videoId'])) {
                    $video['video_link'] = 'https://www.youtube.com/watch?v=' . $video['id']['videoId'];
                } else {
                    $video['video_link'] = null;
                }
                return $video;
            }, $videos['items']);

            return response()->json($videos);
        } else {
            return response()->json(['error' => 'No videos found.'], 404);
        }
    }

}
