<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Yarikul, Adil Bashir">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title class="d-print-none">@yield('title', '') {{ __( '| Yarikul Test') }} </title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Include stylesheets here -->
    @include('includes.styles')
    @stack('head')
</head>

<body>

    @include('partials.header')
    <div class="row border border-2 d-print-none">
        <div class="col-12 p-3">
            @stack('breadcrumb')
        </div>
    </div>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            @yield('content')
            <!-- Include the Footer partial -->
            @include('partials.footer')
        </div>
    </div>
    <!-- Include the Header partial -->

    <!-- Include your scripts here -->
    @include('includes.scripts')
    @stack('bottom-scripts')
</body>

</html>