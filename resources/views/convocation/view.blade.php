@extends('layout')

@section('title', 'Convocations')

@section('header')
	
	<h1>
		{{ $club->name }} - Convocation    	
	</h1>
		
@endsection

@section('content')

<main>
	<div class="panel panel-default">
		<div class="panel-heading">Convocation</div>
        <div class="panel-body"> 
        	<p>Catégories : {{ $convocation->getJoinedCategories() }}</p>
            <p>Convocation émise par : {{ $convocation->coach->getFullName() }}</p>   
           	<p>Date de la convocation : {{ $convocation->date_convocation }}</p>
           	<p>Heure / Lieu : {{ $convocation->heure_lieu }}</p>
           	<p>Description : {{ $convocation->description }}</p>
            <p>Commentaires : {!! nl2br($convocation->comments) !!}</p>
        </div>
    </div>
    <div class="panel panel-default">
    	<div class="panel-heading panel-btn-bar">
    	
    		Joueurs
 			
 			<form class="form-inline">
 			
                <input type="text" class="form-control" id="addPlayer" placeholder="Ajouter un joueur">
    
        		<a class="btn btn-default" href="#" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
        		
    		</form>
    		
    	</div>
        <div class="panel-body">
            <table class="table table-striped">
            	<thead>
            		<tr>
            			<th>Prénom</th>
            			<th>Nom</th>
            		</tr>
            	</thead>
            	<tbody>
            	
            		@foreach ($convocation->players as $player)
            			
            			<tr>
                			<td>{{ $player->firstname }}</<td>
                			<td>{{ $player->lastname }}</<td>
                		</tr>
            			
            		@endforeach
            	
            	</tbody>
            </table>
        </div>
    </div>
</main>

<script>
$(function() {

	let availablePlayers = [
	    "Romario",
	    "Bebeto",
	    "Mazinho",
	    "Mauro Silva"
	];
	  
	$("#addPlayer").autocomplete({

		source: availablePlayers
	});
});
</script>

@endsection
