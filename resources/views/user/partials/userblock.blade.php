<div class="media">
    @if($users)
    @foreach($users as $user)
    <a class="pull-left" href="#"><img class="media-object" alt="" src=""></a>
    <div class="media-body">
        <h4 class="media-heading"><a href="#">{{$user->usernameOrName()}}</a></h4>
        <p>{{$user->location}}</p>
    </div>
    <hr/>
    @endforeach
    @else
    <div class="media-body">
        <p>Sorry, there are no users with this criteria :(</p>
    </div>
    @endif
</div>