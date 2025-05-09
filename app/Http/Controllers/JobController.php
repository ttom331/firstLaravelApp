<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Mail\JobPosted;
use App\Models\Tag;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $jobs =  Job::with(['employer', 'tags'])->latest()->get()->groupBy('featured'); //group by if they ar efeatured true, eager load any relationships we require

        return view('jobs.index', [
            'featuredJobs' => $jobs[1], //this is the featured job, 1 is true
            'jobs' => $jobs[0], //0 is false, not feautred jobs.
            'tags' => Tag::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function show(Job $job){
        return view('jobs.show', ['job' => $job]);
    }

    public function create()
    {
        return view('jobs/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'url' => ['required', 'active-url'],
            'tags' => ['nullable'],

        ]);

        $attributes['featured'] = $request->has('featured');

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags')); //when job created the employer id is automatically be set, remove ability to fake as you cant create a job if not a user.
            
        if ($attributes['tags'] ?? false){
            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tag($tag); //frontend and someone else could put front-end
            }
        }

        Mail::to($job->employer->user)->queue(
            new JobPosted($job)
        );

        return redirect('/');


    }

    public function edit(Job $job){

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Request $request, Job $job){

        $attributes = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'url' => ['required', 'active-url'],
            'tags' => ['nullable'],
        ]);

        $job->update([
            'title' => $attributes['title'],
            'salary' => $attributes['salary'],
            'location' => $attributes['location'],
            'schedule' => $attributes['schedule'],
            'url' => $attributes['url'],
        ]);
        
        $job->tags()->detach(); //detaches any records from pivot table
        
        if ($attributes['tags'] ?? false){
            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tag($tag); //frontend and someone else could put front-end
            }
        }
        return redirect("/jobs/{$job->id}");
    }

}
