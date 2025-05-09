<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\MyJobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create'])->middleware(['auth', 'role:employer']);
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
Route::get('/myJobs', [MyJobController::class, 'index'])->middleware(['auth', 'role:employer']);
Route::get('/jobs/{job}', [JobController::class, 'show']);
Route::get('/jobs/{job}/edit' , [JobController::class, 'edit'])->middleware(['auth'])->can('edit', 'job'); //only allows users to edi tjobs they own, refers to edit polciy
Route::patch('/jobs/{job}', [JobController::class, 'update'])->middleware('auth')->can('edit', 'job');

Route::get('/search', SearchController::class); 
Route::get('/tags/{tag:name}', TagController::class); //laravel expects this to be the id so change to name, tags/frontend

Route::middleware('guest')->group(function (){  //routes for guests, stop signed in users accessign it. 
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});


Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');