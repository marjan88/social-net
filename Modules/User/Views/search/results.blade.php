@extends('templates/default')
@section('content')
<h3>Results for: "{{ \Request::input('q') }}"</h3>
<div class="row">
    <div class="col-lg-12">
        <div class="media">
            @if($users)
            @foreach($users as $user)
            <a class="pull-left" href="#"><img class="media-object" alt="" src=""></a>
            <div class="media-body">
                <h4 class="media-heading"><a href="#">{{$user->getNameOrUsername()}}</a></h4>
                @if($user->location)
                <p>{{$user->location}}</p>
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