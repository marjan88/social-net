@extends('templates.default')

@section('content')

<div class="row">
    <div class="col-lg-5">
        <div class="media">            

            <a class="pull-left" href="{{route('user.profile', ['username' => $user->username])}}">
                <img class="media-object" alt="{{$user->getNameOrUsername()}}" src="{{$user->getAvatarUrl(40)}}">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><a href="{{route('user.profile', ['username' => $user->username])}}">{{$user->getNameOrUsername()}}</a></h4>
                @if($user->location)
                <p>{{$user->location}}</p>
                @endif
            </div>
            <hr/>

        </div>
    </div>
    <div class="col-lg-4 col-lg-offset-3">

    </div>
</div>

@stop