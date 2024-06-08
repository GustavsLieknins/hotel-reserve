<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }

    public function rooms() {
        return view('admin.rooms');
    }

    public function showAddRoom() {
        return view('admin.addRoom');
    }

    public function roomStore(Request $request)
    {
        $request->validate(
            [
                "name" => ["required", "min:3", "max:50"],
                "price" => ["required", "numeric"],
                "description" => ["required", "min:3", "max:2024"],
                "img_url" => ["required", "image", "max:10240"],
                "availability" => ["required", "numeric"],
                "location" => ["required", "min:3", "max:50"],
            ]
        );
        $listings = new rooms();
        $listings->name = $request->name;
        $listings->price = $request->price;
        $listings->description = $request->description;
        $listings->availability = $request->availability;
        $listings->location = $request->location;


        $image_path = $request->file('img_url'); // storing img to variable

        // creating filename and saving the image
        $fileName = time() . '_' . $image_path->getClientOriginalName();
        $image_path->move(public_path('images'), $fileName);

        // storing filename to the database
        $listings->img_url = '/images/' . $fileName;


        $listings->created_by = auth()->user()->id;

        $listings->save();

        return back();
    }
}
