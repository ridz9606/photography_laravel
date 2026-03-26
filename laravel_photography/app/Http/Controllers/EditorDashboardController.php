<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking; // Assuming tasks are related to bookings/projects
use App\Models\Gallery; // Finalized edits
use App\Models\Notification;

class EditorDashboardController extends Controller
{
    public function index()
    {
        $editor_id = session('editor_id'); 

        $stats = [
            'total_tasks' => 0, // Should link to a tasks table or editor_id in bookings
            'total_edits' => Gallery::count(), 
            'total_notifications' => Notification::count()
        ];
        
        return view('editor.dashboard', compact('stats'));
    }

    public function tasks()
    {
        // Tasks based on editor logic
        return view('editor.tasks');
    }

    public function gallery()
    {
        $gallery_arr = Gallery::all();
        return view('editor.gallery', compact('gallery_arr'));
    }

    public function notifications()
    {
        $notif_arr = Notification::all();
        return view('editor.notifications', compact('notif_arr'));
    }
}