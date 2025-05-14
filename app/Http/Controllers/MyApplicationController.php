<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyApplicationController extends Controller
{
    public function index(){

        $user = Auth::user();
        return view('myapply.index', ['user' => $user]);
    }
}
