@extends('templates.default')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/albums.css')}}"/>
@stop
@section('content')
<h2>Albums
    <div class="pull-right">
        <a href="{{route('albums.create')}}" class="btn btn-default"><i class="fa fa-image"></i> Create Album</a>
    </div>
</h2>
<hr>
<div class="row">
    <div class="col-lg-12">
        <ul id="album-list" class="list-inline">
            <li><a href="#all" title="">All</a></li>
            @foreach($albums as $album)
            <li><a href="#{{$album->slug}}" title="">{{$album->name}}</a></li>            
            @endforeach
        </ul>
        <ul id="album-filter">
            @foreach($images as $image)
            <li style="display: inline-block;" class="{{$image->album->slug}}">
                <a href="{{$image->album->slug}}" title=""><img width="200" src="{{$image->getImagePath()}}" alt="{{$image->getImagePath()}}"></a>                
            </li>
            @endforeach            
            <li style="overflow: hidden; clear: both; height: 0px; position: relative; float: none; display: block;"></li>
        </ul>
    </div>
</div>
@stop
@section('scripts')
@parents
<script type="text/javascript" src="{{asset('assets/site/js/filterable.js')}}"></script>
@stop