@extends('layout')

@section('title', 'Licenses')

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
	</h1>
		
@endsection

@section('content')



<div>
    <table class="table table-striped table-hover">
    	<thead>
    		<tr>
    			<th>Catégorie</th>
    			<th>Nom</th>
    			<th>Prénom</th>
    		</tr>
    	</thead>
    	<tbody>
    	
    		@foreach ($licences as $licence)
    			
    			<tr>
        			<th>{{ $licence->category->label }}</<th>
        			<td><a href="{{ route('player', ['id' => $licence->player->id]) }}">{{ $licence->player->lastname }}</a></<td>
        			<td>{{ $licence->player->firstname }}</<td>
        		</tr>
    			
    		@endforeach
    	
    	</tbody>
    </table>
</div>

@endsection
