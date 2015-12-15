@extends('templates.default')

@section('content')

<div class="row">

    <div class="col-lg-6">
        <h2>Update your profile</h2>
        <hr>
        <form class="form-vertical" role="form" action="{{route('user.profile.update')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-md-6 image-box">
                    <a type="button" data-toggle="modal" data-target="#profileImageModal"></a>
                    <div class="image-overlay">
                        <i class="fa fa-edit"></i>
                    </div>
                    <img src="{{\Auth::user()->getProfilePicture()}}" alt="{{\Auth::user()->username}}"/>
                    {!! $errors->first('profile_image', '<span class="help-block error" role="alert"><small>:message</small></span>')!!}
                </div>
            </div>
            <hr>
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
<!-- MODAL IMAGES -->
<div class="modal fade" id="profileImageModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{route('store.image')}}" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="profileModalLabel">Edit profile image</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input id="profile-img" name="profile_image" type="file" class="file" multiple="false">                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="upload-img" type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('scripts')
@parents
<script>
    $("#profile-img").fileinput({
        allowedFileTypes: ["image"],
        maxFileSize: 1500,
        showRemove: false,
        showUpload: false

    });

</script>
@stop