@extends('layouts.log') @section('auth')
@if($errors->any())
<ul class="m-auto">
    <!-- {!! implode('',$errors->all('<li class="p-2 bg-danger text-white rounded m-auto w-50">:message</li>')) !!} -->
</ul>
@endif
<div class="container w-50 m-auto ">
    <div class="wrapper ">
        <header>Login Form</header>
        <form action="{{route('admin.authenticate')}}" method="post">
            @csrf
            <div class="field email mt-5">
                <div class="input-area">
                    <input type="text" class="input-class @if($errors->has('email')) {{'is-invalid'}} @endif" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}" />
                    @if ($errors->has('email'))
                    <div class="invalid-feedback d-flex">{{$errors->first('email')}}</div>
                    @endif
                </div>
            </div>
            <div class="field password mt-5">
                <div class="input-area">
                    <input type="password" class="input-class 
                    @if($errors->has('password')) {{'is-invalid'}} @endif" id="password" name="password" placeholder="Password" />
                    @if ($errors->has('password'))
                    <div class="invalid-feedback d-flex">{{$errors->first('password')}}</div>
                    @endif

                </div>
            </div>
            <div class="pass-txt mt-5"><a href="#">Forgot password?</a></div>
            <input type="submit" class="btn-class mt-3 rounded" value="Login">
        </form>
        <!-- <div id="signupLink" class="sign-txt">Not yet member? <a href="{{route('account.register')}}">Signup now</a></div> -->
    </div>
</div>
@endsection