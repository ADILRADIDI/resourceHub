<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;


class NotificationController extends Controller
{
    public function getNotifications()
{
    // Get the authenticated user
    $user = auth()->user();

    // Check if the user is authenticated
    if (!$user) {
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    // Retrieve notifications where user_id matches the authenticated user's id
    $notifications = Notification::where('user_id', $user->id)->get();

    return response()->json($notifications);
}



    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->read = true;
            $notification->save();
            return response()->json(['message' => 'Notification marked as read.']);
        }
        return response()->json(['message' => 'Notification not found.'], 404);
    }

    public function markAllAsRead()
    {
        Notification::where('read', false)->update(['read' => true]);
        return response()->json(['message' => 'All notifications marked as read.']);
    }

    public function clearNotifications()
    {
        Notification::truncate();
        return response()->json(['message' => 'All notifications cleared.']);
    }

}
