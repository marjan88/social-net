@extends('templates/default')
@section('content')
<form method="post" class="form-signin" action="{{route('register')}}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <h2 class="form-signin-heading">Chatty</h2>
    <p class="text-center">Be the part of Chatty World</p>
    
    <div class="form-group {{{ $errors->has('username') ? 'has-error' : '' }}}">
        <label class="sr-only" for="email">Username</label>
        <input type="text" placeholder="Username" class="form-control" id="username" name="username" value="{{\Request::old('username') ?: ''}}">
        {!! $errors->first('username', '<span class="help-block" role="alert"><small>:message</small></span>')!!}
    </div>
    <div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
        <label class="sr-only" for="email">Email address</label>
        <input type="email" placeholder="Email address" class="form-control" id="email" name="email" value="{{\Request::old('email') ?: ''}}">
        {!! $errors->first('email', '<span class="help-block" role="alert"><small>:message</small></span>')!!}
    </div>
    <div class="form-group {{{ $errors->has('password') ? 'has-error' : '' }}}">
        <label class="sr-only" for="password">Password</label>
        <input type="password" placeholder="Password" class="form-control" id="password" name="password">
        {!! $errors->first('password', '<span class="help-block error" role="alert"><small>:message</small></span>')!!}
    </div>
    <div class="form-group {{{ $errors->has('password_confirmation') ? 'has-error' : '' }}}">
        <label class="sr-only" for="password_confirmation">Password</label>
        <input type="password" placeholder="Password Confirmation" class="form-control" id="password_confirmation" name="password_confirmation">
        {!! $errors->first('password_confirmation', '<span class="help-block error" role="alert"><small>:message</small></span>')!!}
    </div>
    <div class="form-group {{{ $errors->has('first_name') ? 'has-error' : '' }}}">
        <label class="sr-only" for="first_name">First name</label>
        <input type="text" placeholder="First name" class="form-control" id="first_name" name="first_name" value="{{\Request::old('first_name') ?: ''}}">
        {!! $errors->first('first_name', '<span class="help-block" role="alert"><small>:message</small></span>')!!}
    </div>
    <div class="form-group {{{ $errors->has('last_name') ? 'has-error' : '' }}}">
        <label class="sr-only" for="last_name">Username</label>
        <input type="text" placeholder="Last name" class="form-control" id="last_name" name="last_name" value="{{\Request::old('last_name') ?: ''}}">
        {!! $errors->first('last_name', '<span class="help-block" role="alert"><small>:message</small></span>')!!}
    </div>
    
   
    <button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>
</form>
@stop