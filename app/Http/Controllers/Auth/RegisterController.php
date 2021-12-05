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

    /* (https://laravel.com/docs/8.x/authentication) */
    public function store(Request $request)
    {
        /* dd($request->email); // dumps the email field from request  */
        
        $this->validate($request, [ /* https://laravel.com/docs/8.x/validation#quick-writing-the-validation-logic - Laravel validation method for HTTP requests */
            'name' => 'required|max:200', // sets the rules that need to be met in order for http requesst to validate
            'username' => 'required|max:200',
            'email' => 'required|email|max:200', 
            'password' => 'required|confirmed',  
        ]);

        User::create([ 
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password) // Hashing the password - so we don't store the actual users password as a string but instead store it as HASH (https://laravel.com/docs/8.x/hashing#hashing-passwords)
        ]);

        /* auth()->user(); // returns back the whole user model which is signed it - useful to show users name in template e.g. */
        auth()->attempt($request->only('email', 'password')); 

        return redirect()->route('home');
    }
}
