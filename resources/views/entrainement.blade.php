@extends('layout')

@section('title', 'Entrainement')

@section('header')
	
	<h1>
		{{ $club->name }} - Entrainement    	
	</h1>
		
@endsection

@section('content')

<main>
	<div class="panel panel-default">
		<div class="panel-heading">Entrainement</div>
        <div class="panel-body"> 
        	<p>Catégories : {{ $entrainement->getJoinedCategories() }}</p>
            <p>Séance planifiée par : {{ $entrainement->coach->getFullName() }}</p>   
           	<p>Date : {{ $entrainement->date_entrainement }}</p>
            <p>Commentaires : {!! nl2br($entrainement->comments) !!}</p>
        </div>
    </div>
    <div class="panel panel-default">
    	<div class="panel-heading">Joueurs</div>
        <div class="panel-body">
            <table class="table table-striped">
            	<thead>
            		<tr>
            			<th>Prénom</th>
            			<th>Nom</th>
            		</tr>
            	</thead>
            	<tbody>
            	
            		@foreach ($entrainement->players as $player)
            			
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

@endsection
