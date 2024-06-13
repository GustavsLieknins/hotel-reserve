<?php

namespace App\Http\Controllers;
use App\Models\Rooms;
use App\Models\UserRoom;
use App\Models\Status;
use Carbon\Carbon;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        // $rooms = Rooms::all();
        $rooms = Rooms::paginate(1);
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


        if ($checkin->lte(now()) || ($checkout->lte(now()))) {
            return back()->with('error', 'Cannot select dates in the past!');
        }
        if (($checkout->lte($checkin))) {
            return back()->with('error', 'Checkout date cannot be before checkin date!');
        }

        $room = Rooms::find($request->input('room_id'));
        $available = false;
        $roomNum = $room->availability;

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

    
    public function account() {
        $user = auth()->user();
        $userRooms = UserRoom::where('user_id', $user->id)->get();
        $rooms = Rooms::all();
        $statues = Status::all();
        return view('account', ['userRooms' => $userRooms, 'rooms' => $rooms, 'statues' => $statues]);
    }


    public function cancel($id) {
        $userRoom = UserRoom::find($id);
        $userRoom->delete();
        Rooms::find($userRoom->room_id)->increment('availability');
        return back()->with('success', 'Reservation cancelled');
    }

    public function search(Request $request) {
        $query = $request->input('search');
        $rooms = Rooms::where('name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->paginate(1);

        
        return view('index', ['rooms' => $rooms]);
    }

    
    public function sort(Request $request) {
        $sort_by = $request->input('sort_by');

        if ($sort_by == 'availability_low') {
            $rooms = Rooms::orderBy('availability', 'asc')->paginate(1);
        } elseif ($sort_by == 'availability_high') {
            $rooms = Rooms::orderBy('availability', 'desc')->paginate(1);
        } elseif ($sort_by == 'price_low') {
            $rooms = Rooms::orderBy('price', 'asc')->paginate(1);
        } elseif ($sort_by == 'price_high') {
            $rooms = Rooms::orderBy('price', 'desc')->paginate(1);
        } else {
            $rooms = Rooms::paginate(1);
        }

        return view('index', ['rooms' => $rooms]);
    }


}


// Rooms::latest()->paginate(1);