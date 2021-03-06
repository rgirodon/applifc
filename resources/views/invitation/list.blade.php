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
        
        @auth
		<a class="btn btn-default" href="{{ route('invitation.create') }}" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter une invitation</a>
		@endauth
	</h1>
		
@endsection

@section('content')

@if (session('action_message_ok'))
    <div class="alert alert-success">
    	{{ session('action_message_ok') }}            
    </div>
@endif

@if (session('action_message_ko'))
    <div class="alert alert-danger">
    	{{ session('action_message_ko') }}            
    </div>
@endif

<div>
    <table class="table table-striped table-hover">
    	<thead>
    		<tr>
    			<th>Catégories</th>
    			<th>Date compétition</th>   
    			<th>Durée</th> 			
    			<th>Date limite réponse</th>
    			<th>Libellé</th>
    			<th>Réponse</th>
    			@auth
    				<th colspan="4">Actions</th>
    			@endauth
    		</tr>
    	</thead>
    	<tbody>
    	
    		@foreach ($invitations as $invitation)
    			
    			<tr>
    				<td>{{ $invitation->getJoinedCategories() }}</td>
        			<th><a href="{{ route('invitation', ['id' => $invitation->id]) }}">{{ $invitation->date_competition }}</a></th>
        			<td>{{ $invitation->duration }}</td>
        			<td>{{ $invitation->date_limite_reponse }}</td>
        			<td>{{ $invitation->libelle }}</td>
        			<td>{{ $invitation->reponseLabel() }}</td>
        			
        			@auth
            			<td><a class="buttonLink" href="{{ route('invitation.edit', $invitation->id) }}" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
            			<td><a class="buttonLink" href="{{ route('invitation.refuse', $invitation->id) }}" role="button"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a></td>
            			<td><a class="buttonLink" href="{{ route('invitation.accept', $invitation->id) }}" role="button"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></a></td>
    					<td>
    						<a class="buttonLink" href="javascript:void(0);" role="button" onclick="$('#deleteInvitationForm_{{ $invitation->id }}').submit();">
    							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
    						</a>
    						<form id="deleteInvitationForm_{{ $invitation->id }}" action="{{ route('invitation.delete', $invitation->id) }}" method="post">
    
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
