<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store(){
        //validate
        $attributes = request()->validate([ //if it fails it doesnt need to manually redirect to form, laravel does this automatically
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        //attempt to sign in
        if (! Auth::attempt($attributes)){ //this returns a boolean, could it successfully login
            throw ValidationException::withMessages([
                'email' => 'Sorry, these credentials do not match!'
            ]);
        };
        //regenrate the session token
        request()->session()->regenerate(); //protects session hijacking, always regenrage the toekn when signing in, old tokens wont work.
        //redirect
        return redirect('/');
    }

    public function destroy(){
        Auth::logout();

        return redirect('/');
    }
}
