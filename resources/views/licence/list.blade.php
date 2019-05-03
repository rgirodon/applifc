@extends('layout')

@section('title', 'Licences')

@section('header')
	
	<h1>
		{{ $club->name }} - Licences
	
    	<span class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            	{{ isset($selectedCategory) ? $selectedCategory->label : 'Filter par Categorie' }} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            	
            	<li><a href="{{ route('licences') }}">Toutes les catégories</a></li>
            	
            	@foreach ($categories as $category)
            	
                <li><a href="{{ route('licencesByCategory', ['categoryId' => $category->id]) }}">{{ $category->label }}</a></li>
                
                @endforeach
            </ul>
        </span>
        
        @if(isset($selectedCategory))
        
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
	@if(isset($selectedCategory))
	
	<form id="renewLicencesForm" action="{{ route('licences.renew') }}" method="post">
	
		{{ csrf_field() }}
		
	@endif

    <table class="table table-striped table-hover">
    	<thead>
    		<tr>
    			@if(isset($selectedCategory))
    				
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
    				@if(isset($selectedCategory))
    				
        				<td><input type="checkbox" name="playerIds[]" value="{{ $licence->player->id }}"></td>
        				
        			@endif
        			<th>{{ $licence->category->label }}</th>
        			<td><a href="{{ route('player', ['id' => $licence->player->id]) }}">{{ $licence->player->lastname }}</a></td>
        			<td>{{ $licence->player->firstname }}</td>
        		</tr>
    			
    		@endforeach
    	
    	</tbody>
    </table>
    
    @if(isset($selectedCategory))
	
	</form>
			
	@endif
    
</div>

@endsection
