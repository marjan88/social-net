@extends('templates/default')
@section('content')
<h1>Welcome to Chatty</h1>
<p>Please <a href="{{route('register')}}">sign up</a> or if you are already with us, <a href="{{route('login')}}">sign in</a></p>
@stop