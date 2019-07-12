<!doctype html>
<html>
    <head>
        <title>Appli FC - @yield('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Barriecito&display=swap" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    </head>
    <body>
    
    	@include('navbar')
    
    	<header>
        	@yield('header')
        </header>

        <main>
            @yield('content')                       
        </main>
        
        <footer>
        	<img src="/images/clubs/{{ $club->logo }}">        
        </footer>        
        
    </body>
</html>