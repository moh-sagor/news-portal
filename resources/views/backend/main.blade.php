<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    {{-- link  --}}
    @include('backend.link')

</head>

<body class="sb-nav-fixed">
    {{-- navbar  --}}
    @include('backend.nav')


    <div id="layoutSidenav">
        {{-- side navbar  --}}
        @include('backend.sideNavbar')


        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>

            {{-- footer  --}}
            @include('backend.footer')
        </div>
    </div>


    {{-- script link  --}}
    @include('backend.script')
</body>

</html>
