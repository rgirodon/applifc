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
          	
          	<a class="navbar-brand" href="#">{{ $club->name }}</a>
          	
        </div>
        
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
        
        	<ul class="nav navbar-nav">
        	
        		<li class="{{ (Request::segment(1) == 'licences' || Request::segment(1) == 'players') ? 'active' : null }}"><a href="{{ route('licences') }}">Joueurs</a></li>

				<li class="{{ Request::segment(1) === 'coachs' ? 'active' : null }}"><a href="{{ route('coachs') }}">Dirigeants</a></li>
				
				<li class="{{ Request::segment(1) === 'entrainements' ? 'active' : null }}"><a href="{{ route('entrainements') }}">Entraînements</a></li>

				<li class="{{ Request::segment(1) === 'convocations' ? 'active' : null }}"><a href="{{ route('convocations') }}">Convocations</a></li>
				
				<li class="{{ Request::segment(1) === 'operations' ? 'active' : null }}"><a href="{{ route('operations') }}">Operations</a></li>
				
				<li class="{{ Request::segment(1) === 'invitations' ? 'active' : null }}"><a href="{{ route('invitations') }}">Invitations</a></li>
				
				<li class="{{ Request::segment(1) === 'inscriptions' ? 'active' : null }}"><a href="{{ route('inscriptions') }}">Inscriptions</a></li>
        	
        	</ul>
        
        </div>
	
	</div>

</nav>