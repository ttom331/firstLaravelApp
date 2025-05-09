<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyJobController extends Controller
{
    public function index(){
        $myJobs = Job::whereHas('employer', function ($query){  //this is referencing the relationship model in the Job model
            $query->where('user_id', Auth::id()); //where user_id is the authenitcated user, user_id is column
        })
        ->with('employer')
        ->latest()
        ->get();

        return view('myjobs.index', ['jobs' => $myJobs]);
    }
}
