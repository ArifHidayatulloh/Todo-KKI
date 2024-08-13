<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        $userId = session('nik');

        if ($request->input('markAsRead')) {
            Notification::where('user_id', $userId)
                ->where('is_read', false)
                ->update(['is_read' => true]);

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'failed']);
    }

    public function fetchNotifications()
    {
        $userId = session('nik');
        $notifications = Notification::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $unread = Notification::where('user_id', $userId)->where('is_read', false)->count();

        return response()->json([
            'notifications' => $notifications,
            'unread' => $unread
        ]);
    }
}
