<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Notifications\JobApplication;
use App\Notifications\JobApplicationStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function show(Job $job){

        return view('myjobs.show', ['job' => $job]);
    }

    public function download(Request $request){
        
        $validated = $request->validate([
            'cv' => ['required'],
            'name' => ['required']
        ]);
        $path= $validated['cv'];
        $name = $validated['name'];
        
        !Storage::disk('private')->exists($path) ? abort(404, 'File not found.') : $fullPath = Storage::disk('private')->path($path);

        return response()->download($fullPath, "CV-$name" );

        
    }

    public function update(Request $request, Job $job){

        $attributes = $request->validate([
            'status' => ['required'],
            'job' => ['required'],
            'applicant' => ['required']
        ]);

        $user = User::find($attributes['applicant']);
        $user->appliedjobs()->updateExistingPivot($attributes['job'], ['status' => $attributes['status']]); //update the status to new status

        $user->notify(new JobApplicationStatusChanged($attributes, $job)); //notification the the user

        return redirect()->back()->with('success', 'Application status has been updated successfully!');


    }
}
