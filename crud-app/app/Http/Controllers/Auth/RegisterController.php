<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function index()
    {
        return view("auth.register");
    }
    public function registerProcess(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $hashedPassword = Hash::make($request->password);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $hashedPassword;
        // $user->password = $request->input('confirm_password');   
        if ($user->save()) {
            Auth::login($user);
            return redirect()->route("account.dashboard")->with('success','You have registered successfully');

            // return redirect()->route('account.login')->with('success','You have registered successfully');
        } else {
            // Handle registration failure, if needed
            return redirect()->back()->with('error', 'Registration failed. Please try again.');
        }
    }

    public function register(Request $request){
        if(request()->isMethod('post')){
            // dd($request);
            return $this->registerProcess($request);
        }else{
            return $this->index();
        }
    }

}
