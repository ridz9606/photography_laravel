<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website.booking');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $table = new Booking;

    // Main Booking Data
    $table->client_id = $request->client_id;
    $table->category_id = $request->category_id;
    $table->package_id = $request->package_id;

    // Multiple themes (checkbox array)
    $table->catalogue_id = implode(',', $request->catalogue_id ?? []);

    // Date & Slot
    $table->appointment_date = $request->appointment_date;
    $table->slot_id = $request->slot_id;

    // Venue
    $table->venue_type = $request->venue_type;
    $table->venue_address = $request->venue_address;

    // Addons (multiple)
    $table->addons = implode(',', $request->addons ?? []);

    // Save
    $table->save();

    // Email (optional)
    /*
    $data = ["name" => $request->name];
    Mail::to($request->email)->send(new enquirymail($data));
    */

    // Success Message
    Alert::success('Booking Request Sent Successfully');

    return redirect('/booking');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
