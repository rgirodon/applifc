<!doctype html>
<html>
    <head>
        <title>Appli FC - @yield('title')</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}"></link>                
    </head>
    <body>
    	<header>
        	@yield('header')
        </header>

        <main>
            @yield('content')                       
        </main>
        
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>