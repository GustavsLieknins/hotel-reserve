<?php

namespace App\Http\Controllers;
use App\Models\Rooms;
use App\Models\UserRoom;
use Carbon\Carbon;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $rooms = Rooms::all();
        return view("index", ["rooms" => $rooms]);
    }
    public function show($id)
    {
        $room = Rooms::find($id);

        if (isset($room)) {
            return view("room-show", ["room" => $room]);
        }

        return redirect("/");
    }

    public function book($id)
    {
        $room = Rooms::find($id);
        if (isset($room)) {
            return view("book", ["room" => $room]);
        }
        return redirect("/");
    }

    public function checkDate(Request $request)
    {
        $checkin = Carbon::parse($request->input('checkin'));
        $checkout = Carbon::parse($request->input('checkout'));
    
        $room = Rooms::find($request->input('room_id'));
        $available = false;
        $roomNum = $room->availability + 1;
    
        while ($roomNum <= $room->max_availability) {
            $roomCheck = UserRoom::where('room_num', $roomNum)->first();
            if (!isset($roomCheck)) {
                break;
            }
            $roomNum++;
        }
        if ($roomNum > $room->max_availability) {
            $roomNum = $room->availability + 1;
        }
    
        $room->availability = $room->max_availability - UserRoom::where('room_id', $request->input('room_id'))->count() - 1;
        $room->save();

        $userRoom = new UserRoom();
        $userRoom->checkin = $request->input('checkin');
        $userRoom->checkout = $request->input('checkout');
        $userRoom->status_id = 1; // Assuming status_id 1 represents booked
        $userRoom->user_id = auth()->user()->id; // Assuming you are using Laravel's authentication
        $userRoom->room_id = $request->input('room_id');
        $userRoom->room_num = $roomNum;
        $userRoom->save();

        return redirect('/')->with('success', 'Room booked, awaiting admin confirmation!');
    }
}


