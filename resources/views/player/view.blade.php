@extends('layout')

@section('title', 'Joueur')

@section('header')
	
	<h1>
		{{ $club->name }} - {{ $player->getCurrentLicence()->category->label }} - {{ $player->getFullName() }}	    	
	</h1>
		
@endsection

@section('content')

@if (session('delete_message_ok'))
    <div class="alert alert-success">
    	{{ session('delete_message_ok') }}            
    </div>
@endif

<main>
	<div class="panel panel-default">
		<div class="panel-heading">Identité</div>
        <div class="panel-body">
			<div class="media">
				<div class="media-body">
            <p>Catégorie : {{ $player->getCurrentLicence()->category->label }}</p>   
           	<p>Nom : {{ $player->lastname }}</p>
            <p>Prénom : {{ $player->firstname }}</p>
            <p>Date de naissance : {{ $player->birth }}</p>
				</div>
			@if ($player->photos)
				<div class="media-right media-top">
					<img src="/images/players/{{ $player->photos }}">
				</div>
			@endif
			</div>
		</div>
		</div>
        </div>
    </div>
    <div class="panel panel-default">
    	<div class="panel-heading">
    		Licences
    		<a class="btn btn-default" href="{{ route('licence.create', $player->id) }}" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter une licence</a>
    	</div>
        <div class="panel-body">
            <table class="table table-striped">
            	<thead>
            		<tr>
            			<th>Catégorie</th>
            			<th>Date début</th>
            			<th>Date fin</th>
            			<th>Payée</th>
            			<th>Commentaires</th>
            			<th colspan="2">Actions</th>
            		</tr>
            	</thead>
            	<tbody>
            	
            		@foreach ($player->licences as $licence)
            			
            			<tr>
                			<th>{{ $licence->category->label }}</<th>
                			<td>{{ $licence->starts_at }}</<td>
                			<td>{{ $licence->ends_at }}</<td> 
                			<td>{{ $licence->paid ? 'Oui' : 'Non' }}</<td>  
                			<td>{!! nl2br($licence->comments) !!}</<td> 
                			<td><a class="buttonLink" href="{{ route('licence.edit', $licence->id) }}" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                			<td>
                				<a class="buttonLink" href="javascript:void(0);" role="button" onclick="$('#deleteLicenceForm_{{ $licence->id }}').submit();">
                					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                				</a>
                				<form id="deleteLicenceForm_{{ $licence->id }}" action="{{ route('licence.delete', $licence->id) }}" method="post">
                                    
                                    <input type="hidden" name="_method" value="DELETE">
                                    
                                    {{ csrf_field() }}
                                    
                                </form>
                			</td>    			
                		</tr>
            			
            		@endforeach
            	
            	</tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
    	<div class="panel-heading">Notes</div>
        <div class="panel-body">
            <table class="table table-striped">
            	<thead>
            		<tr>
            			<th>Date</th>
            			<th>Educateur</th>
            			<th>Titre</th>
            			<th>Contenu</th>
            		</tr>
            	</thead>
            	<tbody>
            	
            		@foreach ($notes as $note)
            			
            			<tr>
                			<th>{{ $note->created_at }}</<th>
                			<td>{{ $note->coach->getFullName() }}</<td>
                			<td>{{ $note->title }}</<td>   
                			<td>{!! nl2br($note->content) !!}</<td>     			
                		</tr>
            			
            		@endforeach
            	
            	</tbody>
            </table>
        </div>
    </div>
</main>

@endsection
