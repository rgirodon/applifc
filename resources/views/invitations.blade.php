@extends('layout')

@section('title', 'Invitations')

@section('header')
	
	<h1>
		{{ $club->name }} - Invitations à venir
		
		<span class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            	{{ isset($selectedCategory) ? $selectedCategory->label : 'Filter par Categorie' }} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            	
            	<li><a href="{{ route('invitations') }}">Toutes les catégories</a></li>
            	
            	@foreach ($categories as $category)
            	
                <li><a href="{{ route('invitationsByCategory', ['categoryId' => $category->id]) }}">{{ $category->label }}</a></li>
                
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
    			<th>Date limite réponse</th>
    			<th>Libellé</th>
    			<th>Réponse</th>
    		</tr>
    	</thead>
    	<tbody>
    	
    		@foreach ($invitations as $invitation)
    			
    			<tr>
    				<td>{{ $invitation->getJoinedCategories() }}</td>
        			<th><a href="{{ route('invitation', ['id' => $invitation->id]) }}">{{ $invitation->date_competition }}</a></th>
        			<td>{{ $invitation->date_limite_reponse }}</<td>
        			<td>{{ $invitation->libelle }}</<td>
        			<td>{{ $invitation->reponse }}</<td>
        		</tr>
    			
    		@endforeach
    	
    	</tbody>
    </table>
</div>

@endsection
