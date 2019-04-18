@extends('layout')

@section('title', 'Inscriptions')

@section('header')
	
	<h1>
		{{ $club->name }} - Inscriptions à venir
		
		<span class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            	{{ isset($selectedCategory) ? $selectedCategory->label : 'Filter par Categorie' }} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            	
            	<li><a href="{{ route('inscriptions') }}">Toutes les catégories</a></li>
            	
            	@foreach ($categories as $category)
            	
                <li><a href="{{ route('inscriptionsByCategory', ['categoryId' => $category->id]) }}">{{ $category->label }}</a></li>
                
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
    			<th>Catégories</th>
    			<th>Date compétition</th>    			
    			<th>Libellé</th>
    		</tr>
    	</thead>
    	<tbody>
    	
    		@foreach ($inscriptions as $inscription)
    			
    			<tr>
    				<td>{{ $inscription->getJoinedCategories() }}</td>
        			<th><a href="{{ route('inscription', ['id' => $inscription->id]) }}">{{ $inscription->date_competition }}</a></th>
        			<td>{{ $inscription->libelle }}</<td>
        		</tr>
    			
    		@endforeach
    	
    	</tbody>
    </table>
</div>

@endsection
