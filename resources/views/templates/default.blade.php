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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.3/react.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.3/react-dom.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.2/marked.min.js"></script>-->
    </head>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('assets/site/js/bootstrap.min.js')}}"></script>
    <!--<script type="text/babel" src="{{asset('assets/site/js/react.js')}}"></script>-->
     <!--<script type="text/babel" src="{{asset('assets/site/js/requests.js')}}"></script>-->

    @show
</body>
</html>
