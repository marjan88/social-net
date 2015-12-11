@extends('templates.default')

@section('content')

<div class="row">
    <div class="col-lg-5">
        <div class="media">            

            <a class="pull-left" href="{{route('user.profile', ['username' => $user->username])}}">
                <img class="media-object" alt="{{$user->getNameOrUsername()}}" src="{{$user->getAvatarUrl(40)}}">
            </a>             
            <div class="media-body">
                <h4 class="media-heading"><a href="{{route('user.profile', ['username' => $user->username])}}">{{$user->getFullName()}}</a></h4>
                @if($user->location)
                <p>{{$user->location}}</p>
                @endif

            </div>
            <hr/>

        </div>
    </div>
    <div class="col-lg-4 col-lg-offset-3">      

        <h4><?php echo (\Auth::user()->id == $user->id) ? 'Your' : $user->getNameOrUsername() . 's' ; ?> friends.
            @if(\Auth::user()->hasFriendRequestPending($user))
            <button disabled="" class="btn btn-default pull-right">Cancel Friend Request</button>
            @elseif(\Auth::user()->hasFriendRequestReceived($user))
            <a href="{{route('user.friends.accept', ['username' => $user->username])}}" class="btn btn-success pull-right"><i class="fa fa-user-plus"></i> Accept friend</a>
            @elseif(\Auth::user()->isFriendsWith($user))
            <p>You are friends with {{$user->getFullName()}}</p>
            @elseif(\Auth::user()->id !== $user->id)           
            <a href="{{route('user.friends.add', ['username' => $user->username])}}" class="btn btn-success pull-right"><i class="fa fa-user-plus"></i> Add friend</a>
            @endif

        </h4>

        @if(!$user->getFriends()->count())
        <p>{{ $user->getNameOrUsername() }} has no fiends.</p>
        @else
        @foreach($user->getFriends() as $user)
        <a class="pull-left" href="{{route('user.profile', ['username' => $user->username])}}">
            <img class="media-object" alt="{{$user->getNameOrUsername()}}" src="{{$user->getAvatarUrl(40)}}">
        </a>
        <div class="media-body">
            <h4 class="media-heading"> <a href="{{route('user.profile', ['username' => $user->username])}}"> {{$user->getFullName()}} </a></h4>
            @if($user->location)
            <p>{{$user->location}}</p>
            @endif

        </div>
        <hr/>
        @endforeach
        @endif
    </div>
</div>

@stop