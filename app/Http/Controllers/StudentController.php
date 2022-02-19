<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\Group;

use App\Models\Submission;

use App\Models\Room;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


// similar to my comment in instructor controller
// use another controller for Groups, i.e. GroupController
// for files, you can do FileController
class StudentController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function membersCreate(Request $request) {

        $memdata = new group;
        $memdata->user_id = $request->input('user_id');
        $memdata->group_name = $request->input('gname');
        $memdata->member1 = $request->input('member1');
        $memdata->member2 = $request->input('member2');
        $memdata->member3 = $request->input('member3');
        $memdata->member4 = $request->input('member4');
        $memdata->section = $request->input('yearnsection');
        $memdata->save();

        return redirect()->back()->with('status', 'Group Member Added Successfully');
    }

    /**
     * @param Request $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fileUpload(Request $req) {

        $req->validate([
            'file' => 'required|mimes:csv,docx,txt,xlx,xls,pdf|max:2048'
        ]);
        $fileModel = new Submission;
        $fileModel->user_id = $req->input('user_id');
        $room = Auth::user()->room;
        $fileModel->room_id = Room::where('user_id','LIKE','%'.$room.'%')->first();
        if($req->file()) {
            $fileName = $req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->name = $req->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();
            return back()
                ->with('success','File has been uploaded.')
                ->with('file', $fileName);
        }
    }

    /**
     * @return Application|Factory|View
     */
    public function displayStudentDashboard() {
        //$groups   = Group::all();
        // $files = File::all();
        $user = Auth::user();
        $groups = Auth::user()->groups;
        $files    = Auth::user()->file; // this should be files, not file
        $check_ins = $user->check_ins;
        
        //hello
        return view('/dashboard', compact('groups', 'files', 'check_ins'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function searchRoom(Request $request) {
        $term = $request->input('search_room');
        $filterData = Room::where('rname','LIKE','%'.$term.'%')
            ->get();
        //dd($filterData);
        return view('student.classroom', compact('filterData'));
    }

    public function joinRoom(Request $request) {

        $enroll = new checkin;

        $key = $request->input('mykey');
        $findKey = Room::where('rkey','LIKE','%'.$key.'%')->first();

        if($findKey == true){
            //$rooms = Auth::user()->rooms;
            $enroll->room_id = $findKey->id;
            $enroll->user_id = $request->input('user_id');
            $enroll->save();
            //dd($enroll->room_id);
            return back()
                ->with('success','You Successfully Join.');
        }
    }



}
