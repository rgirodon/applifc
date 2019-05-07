@extends('layout')

@section('title', 'Convocations')

@section('header')
	
	<h1>
		{{ $club->name }} - Convocations à venir
	
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
        
        @auth
        	<a class="btn btn-default" href="{{ route('convocation.create') }}" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Créer une convocation</a>
        @endauth
	</h1>
		
@endsection

@section('content')

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
    			@auth
    				<th colspan="2">Actions</th>
    			@endauth
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
        			
        			@auth
            			<td><a class="buttonLink" href="{{ route('convocation.edit', $convocation->id) }}" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
            			<td>
            				<a class="buttonLink" href="javascript:void(0);" role="button" onclick="$('#deleteConvocationForm_{{ $convocation->id }}').submit();">
            					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            				</a>
            				<form id="deleteConvocationForm_{{ $convocation->id }}" action="{{ route('convocation.delete', $convocation->id) }}" method="post">
                                
                                <input type="hidden" name="_method" value="DELETE">
                                
                                {{ csrf_field() }}
                                
                            </form>
            			</td>
        			@endauth
        		</tr>
    			
    		@endforeach
    	
    	</tbody>
    </table>
</div>

@endsection
