<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Display a listing of the events for the authenticated user.
    public function index()
    {
        $user = Auth::user();

        // Check if the user has the 'view events' permission
        if (!$user->can('view events')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        // get all event from DB
        $events = Event::all();
        return response()->json($events);
    }

    // Store a newly created event in storage.
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if the user has the 'create events' permission
        if (!$user->can('create events')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        // validation the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'city' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:planifié,en cours,terminé',
        ]);
        // create a new event
        $event = Event::create(array_merge($request->all(), ['user_id' => Auth::id()]));
        // Return  created event with a status 201
        return response()->json($event, 201); 
    }

    // Display the specified event.
    public function show(Event $event)
    {
        // Ensure the event belongs to the authenticated user
        if ($event->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($event);
    }

    // Update the specified event in storage.
    public function update(Request $request, Event $event)
    {
        $user = Auth::user();

        // Check if the user has the 'edit events' permission
        if (!$user->can('edit events')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        // check id user by this event is !== id user is auth or not
        if ($event->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        // validation the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'city' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:planifié,en cours,terminé',
        ]);
        // update the event in DB
        $event->update($request->all());
        // Return the updating event with a status 200
        return response()->json($event);
    }

    // Search events by title
    public function search(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Retrieve the search term from the request
        $title = $request->input('title');

        // Search for events by title
        $events = Event::where('title', 'like', '%' . $title . '%')->get();
        
        return response()->json($events);
    }



    // Remove the specified event from db
    public function destroy(Event $event)
    {
        $user = Auth::user();

        // Check if the user has the 'delete events' permission
        if (!$user->can('delete events')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        // check id user by this event is !== id user is auth or not
        if ($event->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        // delete the event in DB
        $event->delete();
        // Return a status 200
        return response()->json(['message' => 'Event deleted successfully.']);
    }
}
/**--------------------------| 
 * created by : Adil radidi  |
 * 16 august 2024            |
 * managment Event           |
 *---------------------------| 
 */