@extends('templates.default')

@section('content')
<h2>Update your profile</h2>
<div class="row">

    <div class="col-lg-6">
        <form class="form-vertical" role="form" action="{{route('user.profile.update')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                        <label for="first_name" class="control-label">First name</label>
                        <input type="text" id="first_name" class="form-control" name="first_name" value="{{\Request::old('first_name') ?: \Auth::user()->first_name}}">
                        {!! $errors->first('first_name', '<span class="help-block error" role="alert"><small>:message</small></span>')!!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group  {{ $errors->has('last_name') ? 'has-error' : ''}}">
                        <label for="last_name" class="control-label">Last name</label>
                        <input type="text" id="last_name" class="form-control" name="last_name" value="{{\Request::old('last_name') ?: \Auth::user()->last_name }}">
                        {!! $errors->first('last_name', '<span class="help-block error" role="alert"><small>:message</small></span>')!!}
                    </div>
                </div>                
            </div>


            <div class="form-group  {{ $errors->has('location') ? 'has-error' : ''}}">
                <label for="location" class="control-label">Location</label>
                <input type="text" id="location" class="form-control" name="location" value="{{\Request::old('location') ?: \Auth::user()->location }}">
                {!! $errors->first('location', '<span class="help-block error" role="alert"><small>:message</small></span>')!!}
            </div>




            <div class="form-group">
                <button type="submit" class="btn btn-default">Update</button>
            </div>
        </form>
    </div>
    <div class="col-lg-4 col-lg-offset-3">

    </div>
</div>

@stop