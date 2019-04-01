<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MyPerfectBookLife</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>

<div id="app">
    @include('layouts/nav')

    <body>
        <div class="container main-padding bd-main">
            @yield('content')
        </div>

        @include('layouts/footer')
    </body>
</div>

</html>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
