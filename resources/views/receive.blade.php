<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
</head>
<body>
    <div id="app">

        <example-component  v-bind:usertest="123" v-bind:arr=["{{ $appId }}","{{ $appToken }}","{{ $appChannel }}"] />
    </div>
</body>
</html>
