<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Podcast;
use App\Models\Event;
use App\Models\Tag;
use App\Models\YouTubeChannel;

class StatistiqueAdmin extends Controller
{
    //number of the total posts
    public function getTotalPosts()
    {
        // Get the total number of posts
        $totalPosts = Post::count();
        $totalPodcasts = Podcast :: count();
        $totalEvents = Event :: count();
        $totalTag = Tag :: count();
        $totalYouTubeChannel = YouTubeChannel :: count();
        // Return the count of posts as a response
        return response()->json([
            'total_posts' => $totalPosts,
            'total_events' => $totalEvents,
            'total_tag' => $totalTag,
            'total_youTubeChannel' => $totalYouTubeChannel,
            'total_podcasts' => $totalPodcasts
        ]);
    }


    // function for gte not accepted have status draft (post, events, podcasts, yt-chennels , tags)
    public function getDraftItems()
    {
        // get  all items has the status is 'draft'
        $draftPosts = Post::where('status', 'draft')->count();
        $draftPodcasts = Podcast::where('status', 'draft')->count();
        $draftEvents = Event::where('status', 'draft')->count();
        $draftTags = Tag::where('status', 'draft')->count();
        $draftYouTubeChannels = YouTubeChannel::where('status', 'draft')->count();

        // return response the draft items as  a form JSON
        return response()->json([
            'draft_posts' => $draftPosts,
            'draft_podcasts' => $draftPodcasts,
            'draft_events' => $draftEvents,
            'draft_tags' => $draftTags,
            'draft_youTubeChannels' => $draftYouTubeChannels
        ]);
    }

}
