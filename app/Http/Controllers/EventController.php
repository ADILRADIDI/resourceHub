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
        // $events = Auth::user()->events;
        // get all
        $events = Event::all();
        return response()->json($events);
    }

    // Store a newly created event in storage.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'city' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:planifié,en cours,terminé',
        ]);

        $event = Event::create(array_merge($request->all(), ['user_id' => Auth::id()]));
        return response()->json($event, 201); // Return the created event with a 201 status
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
        // Ensure the event belongs to the authenticated user
        if ($event->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'city' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:planifié,en cours,terminé',
        ]);

        $event->update($request->all());
        return response()->json($event);
    }

    // Remove the specified event from storage.
    public function destroy(Event $event)
    {
        // Ensure the event belongs to the authenticated user
        if ($event->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $event->delete();
        return response()->json(['message' => 'Event deleted successfully.']);
    }
}
