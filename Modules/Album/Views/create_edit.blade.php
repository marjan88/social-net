@extends('templates.default')

@section('content')
<h2>Albums
    <div class="pull-right">
        <a href="{{route('albums.index')}}" class="btn btn-default"><i class="fa fa-backward"></i> Back</a>
    </div>
</h2>
<hr>
<div class="row">
    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{route('albums.store')}}">
        <div class="col-lg-5">

            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="form-group">
                <label for="name">Album name:</label>
                <input type="text" name="name" class="form-control" value="" />
                {!! $errors->first('name', '<span class="help-block error" role="alert"><small>:message</small></span>')!!}
            </div>          

        </div>
        <div class="col-lg-5 col-lg-offset-2">            
            <div class="checkbox">
                <label>
                    <input name="visible" type="checkbox"> Visible
                </label>
            </div>        

        </div>
        <div class="col-lg-12"> 
            <div class="form-group">
                <label for="images">Select photos</label>
                <input id="images" name="images[]" type="file" class="file form-control" multiple="true">  
            </div>  
             {!! $errors->first('images', '<span class="help-block error" role="alert"><small>:message</small></span>')!!}
            <div class="form-group">                
                <button id="images"  type="submit" class="btn btn-success">Submit</button>
            </div>  
        </div>
    </form>
</div>
@stop
@section('scripts')
@parents
<script>
    $("#images").fileinput({
        allowedFileTypes: ["image"],
        maxFileSize: 3000,
        showRemove: false,
        showUpload: false

    });

</script>
@stop