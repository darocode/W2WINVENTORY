<?php

namespace App\Http\Controllers;

use App\Mail\CalendarEmail;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\eventUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = array();
        $bookings = Event::all();
        $users = User::all();
        foreach($bookings as $booking) {
            $color = "black";
            

            $events[] = [
                'id'   => $booking->id,
                'title' => $booking->title,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                'color' => $color
            ];
        }
        return view('event.index', ['events' => $events])->with('users',$users);
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
            'title' => 'required|string',
        ]);
        $booking = Event::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        $color = "black";

        $eventUser=eventUser::create([
            'user_id' => $request->user_id,
            'event_id' => $booking->id
        ]);

        Mail::to(Auth::user()->email)->send(new CalendarEmail($booking));

        /*$event = new eventUser;
        $event->id=$request->id;
        $event->user_id=$request->user_id;
        $event->event_id=$booking->id;

        if($event->save()){
            $id=$event->id;
            $key= array();
        foreach($request->user_id as $key=>$v){
                $data = [
                    'id'=>$id,
                    'user_id'=>$request->user_id[$key],
                    'event_id'=>$booking->id[$key],
                ];
            
                

                eventUser::insert($data);
            }
        }*/
        return response()->json([
            'id' => $booking->id,
            'start' => $booking->start_date,
            'end' => $booking->end_date,
            'title' => $booking->title,
            'color' => $color ? $color: '',
            'user_id' => $eventUser->user_id,
            'event_id' => $booking->id

        ]);
        return redirect('event');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $booking = Event::find($id);
        if(! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return response()->json('Event updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Event::find($id);
        if(! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->delete();
        return $id;
    }
}
