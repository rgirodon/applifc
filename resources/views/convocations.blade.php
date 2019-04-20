@extends('layout')

@section('title', 'Convocations')

@section('header')
	
	<h1>
		{{ $club->name }} - Convocations de la semaine à venir
	
		<span class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            	{{ isset($selectedCategory) ? $selectedCategory->label : 'Filter par Categorie' }} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            	
            	<li><a href="{{ route('convocations') }}">Toutes les catégories</a></li>
            	
            	@foreach ($categories as $category)
            	
                <li><a href="{{ route('convocationsByCategory', ['categoryId' => $category->id]) }}">{{ $category->label }}</a></li>
                
                @endforeach
            </ul>
        </span>
	
    	<span class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            	{{ isset($selectedCoach) ? $selectedCoach->getFullName() : 'Filter par Coach' }} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            	
            	<li><a href="{{ route('convocations') }}">Tous les coachs</a></li>
            	
            	@foreach ($coachs as $coach)
            	
                <li><a href="{{ route('convocationsByCoach', ['coachId' => $coach->id]) }}">{{ $coach->getFullName() }}</a></li>
                
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
    			<th>Date</th>
    			<th>Catégories</th>
    			<th>Coach</th>
    			<th>Heure / Lieu</th>
    			<th>Description</th>
    			<th>Commentaires</th>
    		</tr>
    	</thead>
    	<tbody>
    	
    		@foreach ($convocations as $convocation)
    			
    			<tr>
        			<th><a href="{{ route('convocation', ['id' => $convocation->id]) }}">{{ $convocation->date_convocation }}</a></th>
        			<td>{{ $convocation->getJoinedCategories() }}</td>
        			<td>{{ $convocation->coach->getFullName() }}</<td>
        			<td>{{ $convocation->heure_lieu }}</<td>
        			<td>{{ $convocation->description }}</<td>        			
        			<td>{!! nl2br($convocation->comments) !!}</<td> 
        		</tr>
    			
    		@endforeach
    	
    	</tbody>
    </table>
</div>

@endsection
