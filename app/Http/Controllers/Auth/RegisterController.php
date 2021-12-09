<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    /* (https://laravel.com/docs/8.x/authentication) - docs for authentication and helper methods / Factories */
    public function store(Request $request)
    {
        /* dd($request->email); // dumps the email field from request  */
        
        # Validate the request data 
        $this->validate($request, [ /* https://laravel.com/docs/8.x/validation#quick-writing-the-validation-logic - Laravel validation method for HTTP requests */
            'name' => 'required|max:200', // sets the rules that need to be met in order for http request to validate
            'username' => 'required|max:200',
            'email' => 'required|email|max:200', 
            'password' => 'required|confirmed|min:6',  // set password to min 6 characters  # regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/ - can be added for more complex password validation 
        ]);

        #check if the email is taken
        $emailTaken = User::where('email', '=', $request->email)->first();
        #if it is, come back with an error
        if($emailTaken){
            return back()->with('status', 'This email is already in use'); /* if exists return error/status message */
        } 

        #check if the username is taken
        $usernameTaken = User::where('username', '=', $request->username)->first(); /* check if ir exists already */
        if($usernameTaken){
            return back()->with('status', 'This username is already taken, pick a new one'); /* if exists return error/status message */
        } 
        
        /* if nothing fails, continue: */
        # Create the user
        User::create([ 
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password) // Hashing the password - so we don't store the actual users password as a string but instead store it as HASH (https://laravel.com/docs/8.x/hashing#hashing-passwords)
        ]);


        # Sign in the user and give the data
        /* auth()->user(); // Auth helper returns back the whole user model which is signed it - useful to show users name in template e.g. */
        auth()->attempt($request->only('email', 'password')); 
        /* Auth::  -> alternative way using Facade */

        return redirect()->route('home');
    }
}
