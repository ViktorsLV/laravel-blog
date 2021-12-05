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

    // public function __construct()
    // {
    //     $this->middleware(['guest']); // cant access login page if you are logged in 
    // }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 
            'password' => 'required',  
        ]);

        /* if not  */
        if (!auth()->attempt($request->only('email', 'password'))) { // gonna add remember token in application 
            return back()->with('status', 'Invalid login details'); // go page back
        }; 

        return redirect()->route('home');
    }
}
