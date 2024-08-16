<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventRegistrationMail;
use Carbon\Carbon;

class EventRegistrationController extends Controller
{
    // Register a user for an event.
    public function register(Request $request, Event $event)
    {
        // Ensure the user is authenticated
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], 401);
        }

        // Create or update event registration
        $registration = EventRegistration::updateOrCreate([
            'event_id' => $event->id,
            'user_id' => $user->id,
        ], [
            'status' => 'registered',
        ]);

        // Format event date and time
        $formattedDateTime = $this->formatDateTime($event->start_date, $event->end_date);

        // Generate PDF with formatted date and time
        $pdf = Pdf::loadView('pdf.event_ticket', [
            'event' => $event, 
            'user' => $user,
            'formattedDateTime' => $formattedDateTime
        ]);

        // Prepare data for the email template
        $data = [
            'user' => $user,
            'event' => $event,
        ];

        // Send Email with PDF Attachment
        try {
            Mail::to($user->email)->send(new EventRegistrationMail($pdf->output(), $data));
            return response()->json([
                'message' => 'Registered successfully and ticket sent to your email.',
                'data' => $registration
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to send email.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Method to format event start and end date and time in English
    public function formatDateTime($start, $end)
    {
        // Set the locale to English
        Carbon::setLocale('en');

        // Parse dates
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        // Format dates in English
        $startDate = $start->format('l, F jS');
        $endDate = $end->format('l, F jS');

        // Format times
        $startTime = $start->format('g:i A');
        $endTime = $end->format('g:i A');

        return "{$startDate} to {$endDate} <br> {$startTime} to {$endTime}";
    }
}
