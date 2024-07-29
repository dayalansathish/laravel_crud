<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view("auth.login");
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt user authentication
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'user') {
                return redirect()->route('home-page');
            }
        }

        // Attempt admin authentication
        if (Auth::guard('admin')->attempt($credentials)) {
            if (Auth::guard('admin')->user()->role === 'admin') {
                return redirect()->route("home-page");
            }
        }

        // If neither user nor admin authentication is successful
        return redirect()->route("account.login")->with("error", "Invalid email or password.");
    }


    // Combined method for handling both GET and POST requests
    public function login(Request $request)
    {
        if (request()->isMethod('post')) {
            // dd($request);
            return $this->authenticate($request);
        } else {
            return $this->index();
        }
    }

    // Controller method for logout
    public function logout(Request $request)
    {
        if (auth()->guard('admin')->check()) {
            auth()->guard('admin')->logout(); // Logout admin
        } else {
            auth()->logout(); // Logout regular user
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home-page');
    }

}
