<!DOCTYPE html>
<html>
    <head>
        <title>Chatty</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="{{asset('assets/site/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/site/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,800,300' rel='stylesheet' type='text/css'>
        <link href="{{asset('assets/site/css/style.css')}}" rel="stylesheet">
    </head>
    <body>
        @include('templates/partials/nav')
        <div class="container">
            @include('templates/partials/notification')
            @yield('content')
        </div>
        @section('scripts')
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{asset('assets/site/js/bootstrap.min.js')}}"></script>
        @show
    </body>
</html>
