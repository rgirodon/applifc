<!doctype html>
<html>
    <head>
        <title>Appli FC - @yield('title')</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}"></link>                
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
        
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>