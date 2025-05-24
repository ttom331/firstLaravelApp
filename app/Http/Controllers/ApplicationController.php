<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index(Job $job){

        return view('apply.index', ['job' => $job]);
    }

    public function store(Request $request, Job $job){

        $attributes = $request->validate([
            'job_id' => ['required'],
        ]);
        $user = Auth::user();

        $user->appliedjobs()->attach($attributes['job_id'], ['applied_at' => now(), 'status' => 'pending']);
       
        $jobs =  Job::with(['employer', 'tags'])->latest()->get()->groupBy('featured'); //group by if they ar efeatured true, eager load any relationships we require
        
        $job->employer->user->notify(new JobApplication($job, $user));

        return view('jobs.index', [
            'featuredJobs' => $jobs[1], //this is the featured job, 1 is true
            'jobs' => $jobs[0], //0 is false, not feautred jobs.
            'tags' => Tag::all()
        ]);
    }
}
