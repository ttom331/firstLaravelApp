<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MyApplicationController;
use App\Http\Controllers\MyJobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create'])->middleware(['auth', 'role:employer']);
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
Route::get('/jobs/{job}', [JobController::class, 'show']);
Route::get('/jobs/{job}/edit' , [JobController::class, 'edit'])->middleware(['auth'])->can('edit', 'job'); //only allows users to edi tjobs they own, refers to edit polciy
Route::patch('/jobs/{job}', [JobController::class, 'update'])->middleware('auth')->can('edit', 'job');
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->middleware('auth')->can('edit', 'job');
Route::get('/jobs/{job}/apply', [ApplicationController::class, 'index'])->middleware(['auth', 'role:job_seeker']);
Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->middleware(['auth', 'role:job_seeker']);

Route::get('/myJobs', [MyJobController::class, 'index'])->middleware(['auth', 'role:employer']); //my jobs
Route::get('/myjobs/{job}/applicants', [MyJobController::class, 'show'])->middleware(['auth', 'role:employer'])->can('edit', 'job'); //use job policy to make sure you can only view applicants of yuor own jobs 
Route::patch('/myjobs/{job}/applicants', [MyJobController::class, 'update'])->middleware(['auth', 'role:employer'])->can('edit', 'job');
Route::post('/cv', [MyJobController::class, 'download'])->middleware(['auth', 'role:employer']);


Route::get('/myApplied', [MyApplicationController::class, 'index'])->middleware(['auth', 'role:job_seeker']);

Route::get('/file/download/{file}', [ApplicationController::class, 'download']);




Route::get('/search', SearchController::class); 
Route::get('/tags/{tag:name}', TagController::class); //laravel expects this to be the id so change to name, tags/frontend

//applications
//Route::get('/myApplied', [ApplicationController::class, 'index'])->middleware(['auth', 'role:job_seeker']);

Route::middleware('guest')->group(function (){  //routes for guests, stop signed in users accessign it. 
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});


Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');