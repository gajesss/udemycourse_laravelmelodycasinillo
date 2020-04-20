<?php
use DebugBar\StandardDebugBar;

$debugbar = new StandardDebugBar();
$debugbarRenderer = $debugbar->getJavascriptRenderer();

$debugbar["messages"]->addMessage("hello world!");
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <?php echo $debugbarRenderer->renderHead() ?>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Melody</title>
</head>
<body>
   
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">MELODY GAJES CASINILLO</h5>
        <nav class="my-2 my-md-0 mr-md-3">
           
            <a class="p-2 text-dark" href="{{ route('home') }}">Home</a>
            <a class="p-2 text-dark" href="{{ route('contact') }}">Contact</a>
            <a class="p-2 text-dark" href="{{ route('posts.index') }}">Blog Posts</a>
            <a class="p-2 text-dark" href="{{ route('posts.create') }}">Add Blog Post</a>
            @guest
               
            @if (Route::has('register'))
                    <a class="p-2 text-dark" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
            <a class="p-2 text-dark" href="{{ route('login') }}">{{ __('Login') }}</a>
        
        @else
        <a class="p-2 text-dark" href="{{ route('logout') }}"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
          
            >Logout ({{ Auth::user()->name }})</a>

        <form id="logout-form" action={{ route('logout') }} method="POST"
            style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest

       
    </div>
    <div class="container">

    @if (session()->has('status'))
    <p style="color:green">
        {{ session()->get('status') }}        </p>
        @endif
       

     
    @yield('content')
    </div>
    
    <?php echo $debugbarRenderer->render() ?>
</body>
</html>