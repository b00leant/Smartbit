<!DOCTYPE html>
<html>
    <head>
        <style>
            body{
                font-size:0.7em;
              font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            }
        </style>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>RIPARAZIONE</title>
    </head>
    <body style="padding-top:1em">
        @yield('content')
    </body>
</html>