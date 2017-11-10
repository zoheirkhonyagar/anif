<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @include('main.layout.header-styles')
    @include('main.layout.header-scripts')

</head>

<body>

    <div id="app" class="wrapper">

        @include('main.layout.header')
        @include('main.layout.content')
        @include('main.layout.footer')

    </div>

    @include('main.layout.footer-scripts')

</body>

</html>
