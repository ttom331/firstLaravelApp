<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

use function PHPSTORM_META\type;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('auth.register', [
            'roles' => Role::get(),  //pass the availabe roles to use in register form
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $attributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
            'role_id' => ['required', 'exists:roles,id'], //checks the role id exists in table, should always be working as its a dropdwon
            'employer' => ['required_if:role_id,1'],
            'logo' => ['required_if:role_id,1', File::types(['png', 'jpg', 'webp'])],
            'cv_path' => ['nullable', 'file']
        ]);


        $role_id = $attributes['role_id'];

        $rolename = Role::find($role_id)->name;  // ?-> null safe operator

        if ($rolename === 'job_seeker' ){
            $cvpath = $request->file('cv_path')->store('cv', 'private'); //stores the cv file in a private folder
            $userAttributes = collect($attributes)->only(['name', 'email', 'password'])->put('cv_path', $cvpath)->toArray(); //put('cv_path, $cvpath) takes new cvpath and puts in back into attributes
        }else{
            $userAttributes = collect($attributes)->only(['name', 'email', 'password'])->toArray(); //put('cv_path, $cvpath) takes new cvpath and puts in back into attributes
        }

        $user = User::create($userAttributes);
        $user->roles()->attach($role_id);

        if ($rolename === 'employer'){

            $logoPath = $request->logo->store('logos'); //env file, filesystem disk to public. Will be stored in storage/app/public

            $user->employer()->create([ //this way automatically assigns the user id to the employer record.
                'name' => $attributes['employer'],
                'logo' => $logoPath
            ]); 
        }

        Auth::login($user);

        return redirect('/');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
