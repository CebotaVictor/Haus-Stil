<!DOCTYPE html>
    <html lang="en">
    <head>
        @include('shared.head')
    </head>
    <body>
        @include('shared.header')
        @yield('content')
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('js/tiny-slider.js') }}"></script>
		<script src="{{ asset('js/custom.js') }}"></script>
    </body>
</html>