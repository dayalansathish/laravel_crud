@extends('layouts.log')
@section('auth')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card d-flex flex-column">
            <div class="card-header text-center">
                <h3>Register</h3>
                <a href="{{route('account.login')}}" class="btn btn-sm text-primary">Login--></a>
            </div>
            <div class="card-body align-items-center">
                <form action="{{route('account.register')}}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-md-12">
                        <label for="name" class="form-label">Name</label>
                          <input type="text" class="form-control @if($errors->has('name')) {{'is-invalid'}} @endif"
                           id="name" name="name" value="{{old('name')}}">
                           @if($errors->has('name'))
                           <div class="invalid-feedback">{{$errors->first('name')}}</div>
                           @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-12">
                        <label for="email" class="form-label">Email Address</label>
                          <input type="email" class="form-control @if($errors->has('email')) {{'is-invalid'}} @endif" id="email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                           <div class="invalid-feedback">{{$errors->first('email')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-12">
                        <label for="password" class="form-label">Password</label>
                          <input type="password" class="form-control @if($errors->has('password')) {{'is-invalid'}} @endif" id="password" name="password" value="{{old('password')}}">
                          @if ($errors->has('password'))
                           <div class="invalid-feedback">{{$errors->first('password')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-12">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                          <input type="password" class="form-control @if($errors->has('password_confirmation')) {{'is-invalid'}} @endif" id="password_confirmation" name="password_confirmation">
                          @if ($errors->has('password_confirmation'))
                           <div class="invalid-feedback">{{$errors->first('password_confirmation')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Register">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                    

@endsection