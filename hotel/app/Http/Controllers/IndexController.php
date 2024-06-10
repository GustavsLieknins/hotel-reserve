<?php

namespace App\Http\Controllers;
use App\Models\Rooms;

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
}
