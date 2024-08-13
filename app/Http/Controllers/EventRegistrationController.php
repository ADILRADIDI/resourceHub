<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventRegistrationMail;

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

        // Generate PDF
        $pdf = Pdf::loadView('pdf.event_ticket', ['event' => $event, 'user' => $user]);

        // Send Email with PDF Attachment
        try {
            Mail::to($user->email)->send(new EventRegistrationMail($pdf->output()));
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

    // // Cancel an event registration.
    // public function cancel(Request $request, Event $event)
    // {
    //     // Ensure the user is authenticated
    //     $user = $request->user();

    //     if (!$user) {
    //         return response()->json([
    //             'message' => 'Unauthenticated.'
    //         ], 401);
    //     }

    //     // Find the registration
    //     $registration = EventRegistration::where('event_id', $event->id)
    //         ->where('user_id', $user->id)
    //         ->first();

    //     if ($registration) {
    //         $registration->update(['status' => 'canceled']);
    //         return response()->json([
    //             'message' => 'Registration canceled.',
    //             'data' => $registration
    //         ], 200);
    //     }

    //     return response()->json([
    //         'message' => 'No registration found to cancel.'
    //     ], 404);
    // }
}
