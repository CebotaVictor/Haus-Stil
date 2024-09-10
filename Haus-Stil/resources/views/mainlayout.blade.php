<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Untree.co">
        <meta name="description" content="" />
        <meta name="keywords" content="bootstrap, bootstrap4" />
        <meta name="description" content="" />
        <meta name="keywords" content="bootstrap, bootstrap4" />
        <link {{asset('public/css/bootstrap.min.css')}}  rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link {{asset('public/css/tiny-slider.css')}} rel="stylesheet">
		<link {{asset('public/css/style.css')}} rel="stylesheet">
    </head>
    <body>
        @include('header')
        @include('index')
        @include('footer')
    </body>
</html>