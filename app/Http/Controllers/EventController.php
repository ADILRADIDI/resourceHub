<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

        // Fetch all events
        $events = Event::all();

        // Get current time
        $now = Carbon::now();

        // Format each event's date, time, and registration status
        $formattedEvents = $events->map(function ($event) use ($now, $user) {
            // Determine the event status
            $event->status = $this->getEventStatus($event->start_time, $event->end_time, $now);

            // Format date and time
            $event->formatted_date = $this->formatDateTime($event->start_time, $event->end_time);

            // Check if the user is registered for this event
            $event->is_registered = EventRegistration::where('event_id', $event->id)
                ->where('user_id', $user->id)
                ->exists();

            return $event;
        });

        return response()->json($formattedEvents);
    }

    public function getEventStatus($startTime, $endTime, $now)
    {
        // Parse dates
        $start = Carbon::parse($startTime);
        $end = Carbon::parse($endTime);

        // Determine event status
        if ($now->lessThan($start)) {
            return 'planifié';
        } elseif ($now->greaterThan($end)) {
            return 'terminé';
        } else {
            return 'en cours';
        }
    }


    // Function for formatting date and time
    public function formatDateTime($start, $end)
    {
        // Set the locale to English (default)
        Carbon::setLocale('en');

        // Parse dates
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        // Format dates in English
        $startDate = ucfirst($start->translatedFormat('l j'));
        $endDate = ucfirst($end->translatedFormat('l j'));

        // Format times
        $startTime = $start->format('g:i A');
        $endTime = $end->format('g:i A');

        return "{$startDate} to {$endDate} {$startTime} to {$endTime}";
    }

    // Store a newly created event in storage.
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if the user has the 'create events' permission
        if (!$user->can('create events')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'city' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'status' => 'required|in:planned,ongoing,completed',
        ]);

        // Create a new event
        $event = Event::create(array_merge($request->all(), ['user_id' => Auth::id()]));

        // Return created event with a status 201
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

        // Check if the event belongs to the authenticated user
        if ($event->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'city' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'status' => 'required|in:planned,ongoing,completed',
        ]);

        // Update the event in DB
        $event->update($request->all());

        // Return the updated event with a status 200
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

    // Remove the specified event from DB
    public function destroy(Event $event)
    {
        $user = Auth::user();

        // Check if the user has the 'delete events' permission
        if (!$user->can('delete events')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Check if the event belongs to the authenticated user
        if ($event->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Delete the event in DB
        $event->delete();

        // Return a status 200
        return response()->json(['message' => 'Event deleted successfully.']);
    }
}
/**--------------------------|
 * created by : Adil radidi  |
 * 16 august 2024            |
 * management Event          |
 *---------------------------|
 */
