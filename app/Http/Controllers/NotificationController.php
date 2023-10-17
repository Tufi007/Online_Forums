<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function index()
{
    // Retrieve and display user notifications, ordering them by the latest first
    $notifications = Notification::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('notifications.notifications', compact('notifications'));
}



    public function markAsRead(Notification $notification)
{
    $notification->update(['read_at' => now()]);

    return redirect()->back()->with('success', 'Notification marked as read.');
}



    public function markAllAsRead()
    {
        // Mark all user notifications as read
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();

        return redirect()->back();
    }
}

