@extends('templates/default')
@section('content')
<form method="post" class="form-signin" action="{{route('login')}}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <h2 class="form-signin-heading">Chatty</h2>
     <p class="text-center">Please login into your account.</p>

    <div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
        <label class="sr-only" for="email">Email address</label>
        <input type="email" placeholder="Email address" class="form-control" id="email" name="email">
        {!! $errors->first('email', '<span class="help-block" role="alert"><small>:message</small></span>')!!}
    </div>
    <div class="form-group {{{ $errors->has('password') ? 'has-error' : '' }}}">
        <label class="sr-only" for="password">Password</label>
        <input type="password" placeholder="Password" class="form-control" id="password" name="password">
        {!! $errors->first('password', '<span class="help-block error" role="alert"><small>:message</small></span>')!!}
    </div>
    <div class="checkbox">
        <label>
            <input name="remember" type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
</form>
@stop