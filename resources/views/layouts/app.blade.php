<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sponsor</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div  class="bg-white" id="app">
            @include('layouts.header')
            
            <main class="my-8">
                @yield('content')
            </main>
            @include('layouts.footer')
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>