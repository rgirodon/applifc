@extends('layout')

@section('title', 'Entrainements')

@section('header')
	
	<h1>
		{{ $club->name }} - Entrainements du mois en cours
	
		<span class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            	{{ isset($selectedCategory) ? $selectedCategory->label : 'Filter par Categorie' }} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            	
            	<li><a href="{{ route('entrainements') }}">Toutes les catégories</a></li>
            	
            	@foreach ($categories as $category)
            	
                <li><a href="{{ route('entrainementsByCategory', ['categoryId' => $category->id]) }}">{{ $category->label }}</a></li>
                
                @endforeach
            </ul>
        </span>
	
    	<span class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            	{{ isset($selectedCoach) ? $selectedCoach->getFullName() : 'Filter par Coach' }} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            	
            	<li><a href="{{ route('entrainements') }}">Tous les coachs</a></li>
            	
            	@foreach ($coachs as $coach)
            	
                <li><a href="{{ route('entrainementsByCoach', ['coachId' => $coach->id]) }}">{{ $coach->getFullName() }}</a></li>
                
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
    		</tr>
    	</thead>
    	<tbody>
    	
    		@foreach ($entrainements as $entrainement)
    			
    			<tr>
        			<th><a href="{{ route('entrainement', ['id' => $entrainement->id]) }}">{{ $entrainement->date_entrainement }}</a></th>
        			<td>{{ $entrainement->getJoinedCategories() }}</td>
        			<td>{{ $entrainement->coach->getFullName() }}</<td>
        		</tr>
    			
    		@endforeach
    	
    	</tbody>
    </table>
</div>

@endsection
