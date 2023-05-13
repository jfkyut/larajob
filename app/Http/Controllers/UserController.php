<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // show create user form
    public function create()
    {
        return view('users.register');
    }

    // store/create a new user
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|confirmed|min:6|max:20',
        ]);

        $credentials['password'] = bcrypt($credentials['password']);

        $user  = User::create($credentials);

        if($user) {
            
            auth()->login($user);

            return redirect('/')->with('message', 'registration successful');
        }

        return back()->with('message', 'registration failed!');
    }


    // show the login form
    public function login()
    {
        return view('users.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if(auth()->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect('/')->with('message', 'You have logged in!');
        }

        return back()->with('message', 'Login failed!');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'you have been logged out!');
    }
}
