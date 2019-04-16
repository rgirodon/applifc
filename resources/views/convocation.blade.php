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
            <p>Convocation émise par : {{ $convocation->coach->getFullName() }}</p>   
           	<p>Date de la convocation : {{ $convocation->date_convocation }}</p>
           	<p>Heure / Lieu : {{ $convocation->heure_lieu }}</p>
           	<p>Description : {{ $convocation->description }}</p>
            <p>Commentaires : {!! nl2br($convocation->comments) !!}</p>
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

@endsection
