@extends('layout')

@section('title', 'Licences')

@section('header')
	
	<h1>

		{{ $club->name }} - Licences


		<a class="btn btn-default" href="{{ route('player.create') }}" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter un joueur</a>
    	<span class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            	{{ isset($selectedCategory) ? $selectedCategory->label : 'Filter par Categorie' }} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            	
            	<li><a href="{{ route('licences') }}">Toutes les catégories</a></li>
            	
            	@foreach ($categories as $category)
            	
                <li><a href="{{ route('licencesByCategory', ['categoryId' => $category->id]) }}">{{ $category->label }}</a></li>
                
                @endforeach
                
                <li><a href="{{ route('licencesByCategory', ['categoryId' => -1]) }}">Joueurs sans licence active</a></li>
            </ul>
        </span>
        
        @if(isset($selectedCategory) && ($selectedCategory->id != -1))
        
        	<a class="btn btn-default" href="javascript:void(0);" role="button" onclick="$('#renewLicencesForm').submit();"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Renouveler les licenses sélectionnées</a>
        
        @endif
	</h1>
		
@endsection

@section('content')

@if (session('renew_message_ok'))
    <div class="alert alert-success">
    	{{ session('renew_message_ok') }}            
    </div>
@endif

@if (session('delete_message_ok'))
	<div class="alert alert-success">
		{{ session('delete_message_ok') }}
	</div>
@endif

@if (session('delete_message_ko'))
	<div class="alert alert-danger">
		{{ session('delete_message_ko') }}
	</div>
@endif

@if(isset($selectedCategory))

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endif

<div>
	@if(isset($selectedCategory) && ($selectedCategory->id != -1))
	
	<form id="renewLicencesForm" action="{{ route('licences.renew') }}" method="post">
	
		{{ csrf_field() }}
		
	@endif

    <table class="table table-striped table-hover">
    	<thead>
    		<tr>
    			@if(isset($selectedCategory) && ($selectedCategory->id != -1))
    				
    				<th>Sélectionner</th>
    				
    			@endif
    			
    			<th>Catégorie</th>
    			<th>Nom</th>
    			<th>Prénom</th>
    		</tr>
    	</thead>
    	<tbody>
    	
    		@foreach ($licences as $licence)
    			
    			<tr>
    				@if(isset($selectedCategory) && ($selectedCategory->id != -1))
    				
        				<td><input type="checkbox" name="playerIds[]" value="{{ $licence->player->id }}"></td>
        				
        			@endif
        			<th>{{ $licence->category->label }}</th>
        			<td><a href="{{ route('player', ['id' => $licence->player->id]) }}">{{ $licence->player->lastname }}</a></td>
        			<td>{{ $licence->player->firstname }}</td>

						<td><a class="buttonLink" href="{{ route('player.edit', $licence->player->id) }}" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
						<td>
							<a class="buttonLink" href="javascript:void(0);" role="button" onclick="$('#deletePlayerForm_{{ $licence->player->id  }}').submit();">
								<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
							</a>
							<form id="deletePlayerForm_{{ $licence->player->id  }}" action="{{ route('player.delete', $licence->player->id ) }}" method="post">

								<input type="hidden" name="_method" value="DELETE">

								{{ csrf_field() }}

							</form>
						</td>
        		</tr>

    		@endforeach
    	
    	</tbody>
    </table>
    
    @if(isset($selectedCategory))
	
	</form>
			
	@endif
    
</div>

@endsection
