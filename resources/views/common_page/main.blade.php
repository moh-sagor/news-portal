<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS here -->
    @include('common_page.link')

</head>

<body>

    {{-- header  --}}
    @include('common_page.header')
    <main>

        @yield('content')

    </main>

    {{-- footer  --}}
    @include('common_page.footer')


    <!-- JS here -->
    @include('common_page.script')

</body>

</html>
