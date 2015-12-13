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

            <!-- USER TIMELINE -->
            @if(!$statuses)
            <p>{{$user->getFullName()}} has not posted anything, yet.</p>
            @else
            @foreach($statuses as $status)

            <div class="media">
                <a class="pull-left" href="{{route('user.profile', ['username' => $status->user->username])}}">
                    <img class="media-object" src="{{$status->user->getAvatarUrl(40)}}" alt="{{$status->user->getNameOrUsername()}}">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">
                        <a href="{{route('user.profile', ['username' => $status->user->username])}}">{{$status->user->getFullName()}}</a>
                        @if($status->user->id == \Auth::user()->id)
                        <ul class="pull-right list-unstyled  ">
                            <li class="dropdown">
                                <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu status-option-dropdown">
                                    <li><a href="">Delete</a></li>                       
                                </ul>
                            </li>
                        </ul>
                        @endif
                    </h4>

                    <p>{{$status->body}}</p>
                    <ul class="list-inline">
                        <li><small>{{$status->created_at->diffForHumans()}}</small></li>                         
                        @if($authUserIsFriend && \Auth::user()->id !== $status->user->id && !\Auth::user()->hasLikedStatus($status))
                        <li><a href="{{route('like.status', ['statusId' => $status->id])}}"><i class="fa fa-thumbs-up grey"></i> Like</a></li>
                        @elseif($authUserIsFriend && \Auth::user()->id !== $status->user->id && \Auth::user()->hasLikedStatus($status))
                        <li><a href="{{route('unlike.status', ['statusId' => $status->id])}}"><i class="fa fa-thumbs-up"></i> Unlike</a></li>
                        @endif
                        @if($status->like->count())
                        <li>{{$status->like->count()}} {{str_plural('like', $status->like->count())}}</li>
                        @endif
                    </ul>
                    <!-- REPLY COMMENT -->
                    @if($status->replies->count())
                    @foreach($status->replies as $reply)
                    <div class="media">
                        <a class="pull-left" href="{{route('user.profile', ['username' => $reply->user->username])}}">
                            <img class="media-object" src="{{$reply->user->getAvatarUrl(20)}}" alt="{{$reply->user->getNameOrUsername()}}">
                        </a>

                        <h5 class="reply-inline">
                            <a href="{{route('user.profile', ['username' => $reply->user->username])}}">{{$reply->user->getFullName()}}</a>
                            @if($reply->user->id == \Auth::user()->id)
                            <ul class="pull-right list-unstyled  ">
                                <li class="dropdown">
                                    <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu status-option-dropdown">
                                        <li><a href="">Delete</a></li>                       
                                    </ul>
                                </li>
                            </ul>
                            @endif
                        </h5>
                        <p class="reply-inline">{{$reply->body}}</p>
                        <ul class="list-inline">
                            <li><small>{{$reply->created_at->diffForHumans()}}</small></li>
                            @if($authUserIsFriend && \Auth::user()->id !== $reply->user->id  && !\Auth::user()->hasLikedStatus($reply))
                            <li><a href="{{route('like.status', ['statusId' => $reply->id])}}"><i class="fa fa-thumbs-up grey"></i> Like</a></li>
                            @elseif($authUserIsFriend && \Auth::user()->id !== $reply->user->id && \Auth::user()->hasLikedStatus($reply))
                            <li><a href="{{route('unlike.status', ['statusId' => $reply->id])}}"><i class="fa fa-thumbs-up"></i> Unlike</a></li>
                            @endif
                            @if($reply->like->count())
                            <li>{{$reply->like->count()}} {{str_plural('like', $reply->like->count())}}</li>
                            @endif
                        </ul>

                    </div>
                    @endforeach
                    @endif
                    @if($authUserIsFriend || \Auth::user()->id === $status->user->id)
                    <form role="form" action="{{route('reply.status', ['statusId' => $status->id ])}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group {{{ $errors->has("reply-{$status->id}") ? 'has-error' : '' }}}">
                            <textarea placeholder="Leave a comment" name="reply-{{$status->id}}" class="form-control" rows="2"></textarea>
                            {!! $errors->first('reply-' . $status->id, '<span class="help-block error" role="alert"><small>:message</small></span>')!!}
                        </div>
                        <button type="submit" class="btn btn-default">Reply</button>
                    </form>
                    @endif
                </div>
            </div>

            @endforeach
            @endif            

        </div>
    </div>
    <!-- SIDEBAR -->
    <div class="col-lg-4 col-lg-offset-3">      
        @if(\Auth::user()->isFriendsWith($user))
        <p>You are friends with {{$user->getFullName()}}</p>
        @include('templates.partials.delete-friend', ['btnName' => 'Remove'])
        @endif
        <h4><?php echo (\Auth::user()->id == $user->id) ? 'Your' : $user->getNameOrUsername() . 's'; ?> friends.
            
            @if(\Auth::user()->hasFriendRequestPending($user))
            @include('templates.partials.delete-friend', ['btnName' => 'Cancel Friend Request'])           
            @elseif(\Auth::user()->hasFriendRequestReceived($user))
            @include('templates.partials.delete-friend', ['btnName' => 'Reject'])
            <a href="{{route('user.friends.accept', ['username' => $user->username])}}" class="btn btn-success pull-right"><i class="fa fa-user-plus"></i> Accept friend</a>        
            @elseif(!\Auth::user()->isFriendsWith($user) && \Auth::user()->id !== $user->id)           
            <a href="{{route('user.friends.add', ['username' => $user->username])}}" class="btn btn-success pull-right"><i class="fa fa-user-plus"></i> Add friend</a>
            @endif

        </h4>

        @if(!$user->getFriends()->count())
        <p>{{ $user->getNameOrUsername() }} has no fiends.</p>
        @else
        @foreach($user->getFriends() as $user)
        <div class="media">
            <a class="pull-left" href="{{route('user.profile', ['username' => $user->username])}}">
                <img class="media-object" alt="{{$user->getNameOrUsername()}}" src="{{$user->getAvatarUrl(40)}}">
            </a>
            <div class="media-body">
                <h4 class="media-heading"> <a href="{{route('user.profile', ['username' => $user->username])}}"> {{$user->getFullName()}} </a></h4>
                @if($user->location)
                <p>{{$user->location}}</p>
                @endif

            </div>
        </div>
        <hr/>
        @endforeach
        @endif
    </div>
</div>

@stop