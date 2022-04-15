<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Image Uploader</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div id="app">
    <router-view></router-view>
</div>
<script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
