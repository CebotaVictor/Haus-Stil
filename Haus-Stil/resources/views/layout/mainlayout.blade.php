<!DOCTYPE html>
    <html lang="en">
    <head>
        @include('shared.head')
    </head>
    <body>
        @include('shared.header')
        @yield('content');
        @include('shared.footer')
    </body>
</html>