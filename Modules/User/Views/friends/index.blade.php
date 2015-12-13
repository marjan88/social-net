@extends('templates.default')

@section('content')
<div class="row">

    <div class="col-lg-6">
        <h3>Your friends</h3>
        @if(!$friends->count())
        <p>You have no fiends.</p>
        @else
        @foreach($friends as $user)
        <a class="pull-left" href="{{route('user.profile', ['username' => $user->username])}}">
            <img class="media-object" alt="{{$user->getNameOrUsername()}}" src="{{$user->getAvatarUrl(40)}}">
        </a>
        <div class="media-body">
            <h4 class="media-heading"> <a href="{{route('user.profile', ['username' => $user->username])}}"> {{$user->getFullName()}} </a>
            @include('templates.partials.delete-friend', ['btnName' => 'Remove'])
            </h4>
            @if($user->location)
            <p>{{$user->location}}</p>
            @endif
        </div>
        
        <hr/>
        @endforeach
        @endif
    </div>
    <div class="col-lg-6 ">
        <h4> @if($requests->count() > 0) ({{$requests->count()}}) @endif Friend requests</h4>
        @if(!$requests->count())
        <p>You have no fiend requests.</p>
        @else
        @foreach($requests as $user)
        <a class="pull-left" href="{{route('user.profile', ['username' => $user->username])}}">
            <img class="media-object" alt="{{$user->getNameOrUsername()}}" src="{{$user->getAvatarUrl(40)}}">
        </a>
        <div class="media-body">
            <h4 class="media-heading"> <a href="{{route('user.profile', ['username' => $user->username])}}"> {{$user->getFullName()}} </a>
            @include('templates.partials.delete-friend', ['btnName' => 'Reject'])
            <a href="{{route('user.friends.accept', ['username' => $user->username])}}" class="btn btn-success pull-right"><i class="fa fa-user-plus"></i> Accept friend</a>
            
            </h4>
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