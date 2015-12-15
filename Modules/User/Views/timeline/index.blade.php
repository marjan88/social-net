@extends('templates/default')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <form role="form" action="{{route('add.status')}}" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group {{{ $errors->has('status') ? 'has-error' : '' }}}">
                <textarea placeholder="Whats up {{\Auth::user()->getNameOrUsername()}}?" name="status" class="form-control" rows="2"></textarea>
                {!! $errors->first('status', '<span class="help-block error" role="alert"><small>:message</small></span>')!!}
            </div>
            <button type="submit" class="btn btn-default">Update status</button>
        </form>
        <hr>       
    </div>

</div>
<div class="row">
    <div id="statuses" class="col-lg-5">
        @if(!$statuses)
        <p>There is nothing on your timeline, yet.</p>
        @else
        @foreach($statuses as $status)

        <div class="media">
            <a class="pull-left" href="{{route('user.profile', ['username' => $status->user->username])}}">
                <img width="40" class="media-object" src="{{$status->user->getProfilePicture(40)}}" alt="{{$status->user->getNameOrUsername()}}"/>
            </a>
            <div class="media-body">
                <h4 class="media-heading">
                    <a href="{{route('user.profile', ['username' => $status->user->username])}}">{{$status->user->getFullName()}}</a>
                    @if($status->user->id == \Auth::user()->id)
                    <form method="post" action="{{route('delete.status')}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="statusId" value="{{$status->id}}">
                        <ul class="pull-right list-unstyled  ">
                            <li class="dropdown">
                                <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu status-option-dropdown">
                                    <li><button type="submit" class="btn btn-default btn-sm">Delete</button></li>                       
                                </ul>
                            </li>
                        </ul>
                    </form>
                    @endif
                </h4>

                <p>{{$status->body}}</p>
                <ul class="list-inline">
                    <li><small>{{$status->created_at->diffForHumans()}}</small></li>                         
                    @if(\Auth::user()->isFriendsWith($status->user) && $status->user->id !== \Auth::user()->id  && !\Auth::user()->hasLikedStatus($status))
                    <li><a href="{{route('like.status', ['statusId' => $status->id])}}"><i class="fa fa-thumbs-up grey"></i> Like</a></li>
                    @elseif(\Auth::user()->id !== $status->user->id && \Auth::user()->hasLikedStatus($status))
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
                        <img width="20" class="media-object" src="{{$reply->user->getProfilePicture(20)}}" alt="{{$reply->user->getNameOrUsername()}}">
                    </a>

                    <h5 class="reply-inline">
                        <a href="{{route('user.profile', ['username' => $reply->user->username])}}">{{$reply->user->getFullName()}}</a>
                        @if($reply->user->id == \Auth::user()->id)
                        <form method="post" action="{{route('delete.status')}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="statusId" value="{{$reply->id}}">
                            <ul class="pull-right list-unstyled  ">
                                <li class="dropdown">
                                    <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu status-option-dropdown">
                                        <li><button type="submit" class="btn btn-default btn-sm">Delete</button></li>                       
                                    </ul>
                                </li>
                            </ul>
                        </form>
                        @endif
                    </h5>
                    <p class="reply-inline">{{$reply->body}}</p>
                    <ul class="list-inline">
                        <li><small>{{$reply->created_at->diffForHumans()}}</small></li>                         
                        @if(\Auth::user()->isFriendsWith($reply->user) && \Auth::user()->id !== $reply->user->id  && !\Auth::user()->hasLikedStatus($reply))
                        <li><a href="{{route('like.status', ['statusId' => $reply->id])}}"><i class="fa fa-thumbs-up grey"></i> Like</a></li>
                        @elseif(\Auth::user()->id !== $reply->user->id && \Auth::user()->hasLikedStatus($reply))
                        <li><a href="{{route('unlike.status', ['statusId' => $reply->id])}}"><i class="fa fa-thumbs-up"></i> Unlike</a></li>
                        @endif
                        @if($reply->like->count())
                        <li>{{$reply->like->count()}} {{str_plural('like', $reply->like->count())}}</li>
                        @endif
                    </ul>

                </div>
                @endforeach
                @endif
                <form role="form" action="{{route('reply.status', ['statusId' => $status->id ])}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group {{{ $errors->has("reply-{$status->id}") ? 'has-error' : '' }}}">
                        <textarea placeholder="Leave a comment" name="reply-{{$status->id}}" class="form-control" rows="2"></textarea>
                        {!! $errors->first('reply-' . $status->id, '<span class="help-block error" role="alert"><small>:message</small></span>')!!}
                    </div>
                    <button type="submit" class="btn btn-default">Reply</button>
                </form>

            </div>
        </div>

        @endforeach
        @endif
    </div>
</div>
@stop