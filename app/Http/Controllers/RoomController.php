<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index(){
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function create(){
        return view('rooms.create');
    }

    public function store(Request $r){
        Room::create($r->all());
        return redirect()->route('rooms.index');
    }

    public function edit(Room $room){
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $r, Room $room){
        $room->update($r->all());
        return redirect()->route('rooms.index');
    }

    public function destroy(Room $room){
        $room->delete();
        return back();
    }
}

