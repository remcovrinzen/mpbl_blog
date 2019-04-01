<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MyPerfectBookLife</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >

    <div class="columns is-mobile is-centered">
      <div class="column is-half is-flex is-horizontal-centered">
          <a class="" href="/">
              <img src="/img/logo.png" alt="MyPerfectBookLife" width="175" height="40">
          </a>
      </div>
    </div>
  </head>

    <div id="app">
      @include('layouts/nav')

    <body>
      <div class="container main-padding">
        @yield('content')
      </div>

      @include('layouts/footer')
    </body>
  </div>
</html>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
