<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\eventUser;
use App\Models\User;
use Illuminate\Http\Request;

class EventUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eveUsu = array();
        $bookings = eventUser::all();
        foreach($bookings as $booking) {
            $color = "black";
            

            $eveUsu[] = [
                'id'   => $booking->id,
                'user_id' => $booking->user_id,
                'event_id' => $booking->event_id
            ];
        }
        return view('event.index', ['events' => $eveUsu]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string'
        ]);
        $booking = eventUser::create([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
        ]);

        return response()->json([
            'id' => $booking->id,
            'user_id' => $booking->user_id,
            'event_id' => $booking->event_id

        ]);
        return redirect('event');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\eventUser  $eventUser
     * @return \Illuminate\Http\Response
     */
    public function show(eventUser $eventUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\eventUser  $eventUser
     * @return \Illuminate\Http\Response
     */
    public function edit(eventUser $eventUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\eventUser  $eventUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, eventUser $eventUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\eventUser  $eventUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(eventUser $eventUser)
    {
        //
    }
}
