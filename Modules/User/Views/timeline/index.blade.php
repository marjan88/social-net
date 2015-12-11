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
    <div class="col-lg-5">
        @if(!$statuses)
        <p>There is nothing on your timeline, yet.</p>
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
                    <li><a href=""><i class="fa fa-thumbs-up"></i> Like</a></li>
                    <li>10 likes</li>
                </ul>
                @if($status->replies->count())
                @foreach($status->replies as $reply)
                <div class="media">
                    <a class="pull-left" href="{{route('user.profile', ['username' => $reply->user->username])}}">
                        <img class="media-object" src="{{$reply->user->getAvatarUrl(40)}}" alt="{{$reply->user->getNameOrUsername()}}">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading">
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
                        <p>{{$reply->body}}</p>
                        <ul class="list-inline">
                            <li>{{$reply->created_at->diffForHumans()}}</li>                         
                            <li><a href=""><i class="fa fa-thumbs-up"></i></a></li>
                            <li>10 likes</li>
                        </ul>
                    </div>
                </div>
                @endforeach
                @endif
                <form role="form" action="{{route('reply.status', ['statusId' => $status->id ])}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group {{{ $errors->has("reply-{$status->id}") ? 'has-error' : '' }}}">
                        <textarea placeholder="Reply to this status" name="reply-{{$status->id}}" class="form-control" rows="2"></textarea>
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