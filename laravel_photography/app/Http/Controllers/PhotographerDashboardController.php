<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Gallery;
use App\Models\Slot;
use App\Models\Feedback;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PhotographerDashboardController extends Controller
{
    public function index()
    {
        $photographer_id = Auth::guard('photographer')->id(); 
        
        $stats = [
            'total_bookings' => Booking::where('photographer_id', $photographer_id)->count(),
            'total_gallery' => Gallery::count(),
            'total_notifications' => Notification::count()
        ];
        
        return view('photographer.dashboard', compact('stats'));
    }

    public function appointments()
    {
        // Fetching appointments logic similar to admin but for photographer
        $appo_arr = Appointment::all(); 
        return view('photographer.appointments', compact('appo_arr'));
    }

    public function bookings()
    {
        $photographer_id = Auth::guard('photographer')->id();
        $book_arr = Booking::where('photographer_id', $photographer_id)->get();
        return view('photographer.bookings', compact('book_arr'));
    }

    public function gallery()
    {
        $gallery_arr = Gallery::all();
        return view('photographer.gallery', compact('gallery_arr'));
    }

    public function slots()
    {
        $slot_arr = Slot::all();
        return view('photographer.slots', compact('slot_arr'));
    }

    public function private_gallery()
    {
        return view('photographer.private-gallery');
    }

    public function notifications()
    {
        $notif_arr = Notification::all();
        return view('photographer.notifications', compact('notif_arr'));
    }

    public function feedback()
    {
        $feed_arr = Feedback::all();
        return view('photographer.feedback', compact('feed_arr'));
    }
}