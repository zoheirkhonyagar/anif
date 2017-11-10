<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('admin.layout.header-styles')
    @include('admin.layout.header-scripts')

</head>

<body>

    <div id="wrapper">

        @include('admin.layout.sidebar')

        <div id="page-wrapper" class="gray-bg">

            @include('admin.layout.header')
            @include('admin.layout.content')
            @include('admin.layout.footer')

        </div>

    </div>

    @include('admin.layout.footer-scripts')

</body>

</html>
