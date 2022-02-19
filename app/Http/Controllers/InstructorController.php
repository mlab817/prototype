<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Room;

class InstructorController extends Controller
{
    // it's better to have a RoomController instead
    // Instructor controller should only be used (as much as possible) to manage instructors
    public function roomCreate(Request $request)
    {
    	$data = new room;

//        $data->user_id = $request->input('user_id');
    	$data->rname = $request->input('name');
    	$data->rkey = $request->input('key');
    	$data->description = $request->input('desc');
    	// $data->user_id = $request->input('user_id'); // use auth()->id() to use current users id
        $data->user_id = auth()->id();
    	$data->save();

    	return redirect()->back()->with('status', 'Room Added Successfully');
    }

    // suggestion to save you from headache later: use rooms to reflect plural room
    // rlist is difficult to guess
    public function roomList()
    {
    	$room = Room::all();
    	return view('instructor.roomlist', ['rlist' => $room]);
    }
}
