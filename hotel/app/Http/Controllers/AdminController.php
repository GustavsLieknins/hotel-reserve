<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\UserRoom;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }

    public function rooms() {
        $rooms = Rooms::all();
        return view("admin.rooms", ["rooms" => $rooms]);
    }

    public function showAddRoom() {
        return view('admin.addRoom');
    }

    public function roomStore(Request $request)
    {
        $request->validate([
            "name" => ["required", "min:3", "max:50"],
            "price" => ["required", "numeric", "min:1"],
            "description" => ["required", "min:3", "max:2024"],
            "img_url.*" => ["nullable", "image", "max:10240"],
            "availability" => ["required", "numeric", "min:1"],
            "location" => ["required", "min:3", "max:50"],
        ]);

        $listings = new Rooms();
        $listings->name = $request->name;
        $listings->price = $request->price;
        $listings->description = $request->description;
        $listings->availability = $request->availability;
        $listings->max_availability = $request->availability;
        $listings->location = $request->location;
        $listings->created_by = auth()->user()->id;

        if ($request->hasFile('img_url')) {
            $fileNames = [];
            foreach ($request->file('img_url') as $image) {
                $fileName = '/images/' . $image->getClientOriginalName();
                $image->move(public_path('images'), $fileName);
                $fileNames[] = $fileName;
            }
            $listings->img_url = implode(',', $fileNames);
        }

        $listings->save();

        return back();
    }

    
    public function reservations() {
        $reservations = UserRoom::all();
        $rooms = Rooms::all();
        return view('admin.reservations', ['reservations' => $reservations, 'rooms' => $rooms]);
    }


    public function changeReservationStatus(Request $request, $id) {
        $reservation = UserRoom::find($id);
        $reservation->status_id = $request->status_id;
        if($reservation->status_id == 6){
            Rooms::find($reservation->room_id)->increment('availability');
            $reservation->delete();
        }else{
            $reservation->save();
        }

        return back();
    }


    public function roomDelete($id) {
        $userRooms = UserRoom::where('room_id', $id)->get();

        foreach ($userRooms as $userRoom) {
            $userRoom->delete();
        }

        $room = Rooms::find($id);
        if ($room) {
            $room->delete();
        }

        return back();
    }

    
    public function edit($id) {
        $room = Rooms::find($id);
        return view('admin.edit', ['room' => $room]);
    }
    
    public function update(Request $request, $id) {
        $rules = [
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:1',
            'description' => 'required|string',
            'location' => 'required|string',
            'img_url.*' => 'nullable|image|max:10240',
            'availability' => 'required|integer|min:1',
        ];
        $request->validate($rules);
        $room = Rooms::findOrFail($id);
        $room->update($request->except('_token'));
        return redirect('/rooms')->with('success', 'Room updated successfully.');
    }
    
    




}



