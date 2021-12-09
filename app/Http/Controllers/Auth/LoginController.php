<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        /* validate the request -> check if the input data is valid */
        $this->validate($request, [
            'email' => 'required|email', 
            'password' => 'required',  
        ]);

        /* if not  */
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) { // adds remember token in application and remembers the users credentials 
            return back()->with('status', 'Invalid login details'); // go page back if the details are invalid
        }; 

        return redirect()->route('home');
    }
}
