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
        $request->validate([
            "name" => ["required", "min:3", "max:50"],
            "price" => ["required", "numeric"],
            "description" => ["required", "min:3", "max:2024"],
            "img_url.*" => ["nullable", "image", "max:10240"],
            "availability" => ["required", "numeric"],
            "location" => ["required", "min:3", "max:50"],
        ]);

        $listings = new Rooms();
        $listings->name = $request->name;
        $listings->price = $request->price;
        $listings->description = $request->description;
        $listings->availability = $request->availability;
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
}


