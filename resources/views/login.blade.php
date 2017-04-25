<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>

<form action="{{ route('authenticate') }}" method="post">
    {!! csrf_field() !!}

    <input type="email" name="email" value="{{ old('email') }}">
    <input type="password" name="password" value="{{ old('password') }}">
    <button type="submit">Log in</button>
</form>

</body>
</html>