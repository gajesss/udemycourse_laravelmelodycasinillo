<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Melody</title>
</head>
<body>
    <ul>
        <li><a href="{{ route('welcome') }}">Start</a></li>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
        <li><a href="{{ route('posts.index') }}">Blogpost</a></li>
        <li><a href="{{ route('posts.create') }}">Create</a></li>
    </ul>
    @if (session()->has('status'))
    <p style="color:green">
        {{ session()->get('status') }}        </p>
        @endif
       

     
    @yield('content')
</body>
</html>