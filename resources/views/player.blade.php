@extends('layout')

@section('title', 'Joueur')

@section('header')
	
	<h1>
		{{ $club->name }} - {{ $player->getCurrentLicence()->category->label }} - {{ $player->getFullName() }}	    	
	</h1>
		
@endsection

@section('content')

<main>
	<div class="panel panel-default">
		<div class="panel-heading">Identité</div>
        <div class="panel-body"> 
            <p>Catégorie : {{ $player->getCurrentLicence()->category->label }}</p>   
           	<p>Nom : {{ $player->lastname }}</p>
            <p>Prénom : {{ $player->firstname }}</p>
            <p>Date de naissance : {{ $player->birth }}</p>
        </div>
    </div>
    <div class="panel panel-default">
    	<div class="panel-heading">Licences</div>
        <div class="panel-body">
            <table class="table table-striped">
            	<thead>
            		<tr>
            			<th>Catégorie</th>
            			<th>Date début</th>
            			<th>Date fin</th>
            			<th>Payée</th>
            			<th>Commentaires</th>
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
