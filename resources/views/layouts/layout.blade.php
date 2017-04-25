@section('header')
        <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>{{ $title }}</title>
    <style>
        #map {
            height: 100%;
            width: 50%;
            float: left;
        }
        .intresting-places-block {
            float: right;
            width: 40%;
        }
    </style>
</head>
<body>
@endsection
@yield('header')

@section('body')

@endsection
@yield('body')

@section('footer')

</body>
</html>
@endsection
@yield('footer')