<nav class="navbar navbar-default">
    	
	<div class="container-fluid">
	
		<div class="navbar-header">
		
        	<button type="button" 
        			class="navbar-toggle collapsed" 
        			data-toggle="collapse" 
        			data-target="#navbar-collapse-1" 
        			aria-expanded="false">
        			
            	<span class="sr-only">Toggle navigation</span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	
          	</button>
          	
          	<a class="navbar-brand" href="{{ route('home') }}">{{ $club->name }}</a>
          	
        </div>
        
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
        
        	<ul class="nav navbar-nav">
        		
        		@auth
        		
        			<li class="{{ (Request::segment(1) == 'categories' || Request::segment(1) == 'categories') ? 'active' : null }}"><a href="{{ route('categories') }}">Catégories</a></li>
        		
        			<li class="{{ (Request::segment(1) == 'licences' || Request::segment(1) == 'players') ? 'active' : null }}"><a href="{{ route('licences') }}">Joueurs</a></li>

					<li class="{{ Request::segment(1) === 'coachs' ? 'active' : null }}"><a href="{{ route('coachs') }}">Dirigeants</a></li>
				
				@endauth
				
				<li class="{{ Request::segment(1) === 'entrainements' ? 'active' : null }}"><a href="{{ route('entrainements') }}">Entraînements</a></li>

				<li class="{{ Request::segment(1) === 'convocations' ? 'active' : null }}"><a href="{{ route('convocations') }}">Convocations</a></li>
				
				@auth				
				
    				<li class="{{ Request::segment(1) === 'operations' ? 'active' : null }}"><a href="{{ route('operations') }}">Operations</a></li>
    				
    				<li class="{{ Request::segment(1) === 'invitations' ? 'active' : null }}"><a href="{{ route('invitations') }}">Invitations</a></li>
				
				@endauth
				
				<li class="{{ Request::segment(1) === 'inscriptions' ? 'active' : null }}"><a href="{{ route('inscriptions') }}">Inscriptions</a></li>
        	
        	</ul>
        	<ul class="nav navbar-nav navbar-right">
        	
        		@guest
        	
        			<li class="{{ Route::is('login') ? 'active' : null }}"><a href="{{ route('login') }}">Se connecter</a></li>
        			
        		@else
        		
        			<li class="dropdown">
        			
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            {{ Auth::user()->getFullName() }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    Se déconnecter
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                        
                    </li>
        		
        		@endguest
        		
        	</ul>
        
        </div>
	
	</div>

</nav>