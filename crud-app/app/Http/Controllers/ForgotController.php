<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ForgotController extends Controller
{
    public function index(){
        return view("auth.forgot");
    }
    public function submitForgot(Request $request){
        $request->validate([
            'email'=>'required|email|exist:users'
        ]);
        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email'=> $request->email,
            'token'=> $token,
            'created_at'=> Carbon::now()
        ]);

        Mail::send('email.forgot',['token'=>$token],function($message) use($request){
            $message->to($request->input('email'))->subject('Reset Password');
        });
        return back()->with('message','we have emailed you  reset password link');

    }

    public function showReset($token){
        return view('auth.forgotLink',['token'=>$token]);
    }

    public function submitReset(Request $request){
        $request->validate([
            'email'=> 'required|email|exists:users',
            'password'=> 'required|confirmed|min:8',
            'password_confirmation'=> 'required'
        ]);

        $password_reset_request = DB::table('password_reset_tokens')
        ->where('email',$request->input('email'))
        ->where('token',$request->token)
        ->first();

        if($password_reset_request){
            return back()->with('error','Invalid Token!');
        }
            
    }
}
