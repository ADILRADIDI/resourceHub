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
        // Validate that the 'language' parameter is present in the request
        $request->validate([
            'language' => 'required|string|max:50',
        ]);

        // Get the language input from the request
        $language = $request->input('language');

        // Create the search query by appending "Crash Course" to the language
        $searchQuery = $language . ' Crash Course';

        // Retrieve videos using the YouTubeService
        $videos = $this->youtube->searchVideos($searchQuery);

        // Add a direct video link to each video in the results
        $videos['items'] = array_map(function($video) {
            if (isset($video['id']['videoId'])) {
                $video['video_link'] = 'https://www.youtube.com/watch?v=' . $video['id']['videoId'];
            } else {
                // Handle case where videoId is not set
                $video['video_link'] = null; 
            }
            return $video;
        }, $videos['items']);

        // Return the modified videos as a JSON response
        return response()->json($videos);
    }
}
