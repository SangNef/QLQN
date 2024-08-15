<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function getNotifications(Request $request)
    {
        $userId = session('user')->id;
        $notifications = Notification::where('user_id', $userId)->orderBy('id', 'desc')->paginate(10);

        return response()->json($notifications);
    }

    public function markAllRead(Request $request)
    {
        $userId = session('user')->id;
        Notification::where('user_id', $userId)->update(['is_read' => true]);

        return response()->json(['message' => 'All notifications marked as read']);
    }
}
