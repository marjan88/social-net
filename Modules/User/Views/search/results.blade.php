@extends('templates/default')
@section('content')
<h3>Results for: "{{ \Request::input('q') }}"</h3>
<div class="row">
    <div class="col-lg-12">
        <div class="media">
            @if($users)
            @foreach($users as $user)
            <a class="pull-left" href="{{route('user.profile', ['username' => $user->username])}}">
                <img class="media-object" alt="{{$user->getNameOrUsername()}}" src="{{$user->getAvatarUrl(40)}}">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><a href="{{route('user.profile', ['username' => $user->username])}}">{{$user->getFullName()}}</a></h4>
                @if($user->location)
                <p>{{$user->location}}</p>
                @endif
                @if(\Auth::user()->hasFriendRequestPending($user))
                <button disabled="" class="btn btn-default ">Cancel Friend Request</button>
                @elseif(\Auth::user()->hasFriendRequestReceived($user))
                <a href="{{route('user.friends.accept', ['username' => $user->username])}}" class="btn btn-success "><i class="fa fa-user-plus"></i> Accept friend</a>
                @elseif(\Auth::user()->isFriendsWith($user))
                <p>You are friends with {{$user->getFullName()}}</p>
                @else
                <a href="{{route('user.friends.add', ['username' => $user->username])}}" class="btn btn-success "><i class="fa fa-user-plus"></i> Add friend</a>
                @endif
            </div>
            <hr/>
            @endforeach
            @else
            <div class="media-body">
                <p>Sorry, there are no users with this criteria :(</p>
            </div>
            @endif
        </div>
    </div>
</div>    
@stop