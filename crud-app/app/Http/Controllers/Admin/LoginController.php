<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view("admin.login");
    }

    // public function authenticate(Request $request)
    // {
    //     $request->validate([
    //         "email" => "required|email",
    //         "password" => "required",
    //     ]);

    //     $email = $request->input("email");
    //     $password = $request->input("password");

    //     if (Auth::guard('admin')->attempt(["email" => $email, "password" => $password])) {
    //         if(Auth::guard('admin')->user()->role !== 'admin'){
    //             Auth::guard('admin')->logout();
    //             return redirect()->route('admin.login')->with('error','You are not authorized to access this page');
    //         }
    //         return redirect()->route("admin.dashboard");
            
    //     } else {
    //         return redirect()->route("admin.login")->with("error","Either email or password is incorrect");
    //     }
    // }

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
