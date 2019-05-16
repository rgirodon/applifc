@extends('layout')

@section('title', 'Invitation')

@section('header')
	
	<h1>
		{{ $club->name }} - Invitation	    	
	</h1>
		
@endsection

@section('content')

<main>
	<div class="panel panel-default">
		<div class="panel-heading">Invitation</div>
        <div class="panel-body"> 
            <p>Catégories : {{ $invitation->getJoinedCategories() }}</p>  
            <p>Date compétition : {{ $invitation->date_competition }}</p>
           	<p>Libellé : {{ $invitation->libelle }}</p>
            <p>Date limite de réponse : {{ $invitation->date_limite_reponse }}</p>
            <p>Commentaires : {!! $invitation->comments !!}</p>
            <p>Reponse : {{ $invitation->reponseLabel() }}</p>
        </div>
    </div>
</main>

@endsection
