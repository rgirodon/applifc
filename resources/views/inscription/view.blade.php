@extends('layout')

@section('title', 'Inscription')

@section('header')
	
	<h1>
		{{ $club->name }} - Inscription	    	
	</h1>
		
@endsection

@section('content')

<main>
	<div class="panel panel-default">
		<div class="panel-heading">Inscription</div>
        <div class="panel-body"> 
            <p>Catégories : {{ $inscription->getJoinedCategories() }}</p>  
            <p>Date compétition : {{ $inscription->date_competition }}</p>
            <p>Durée : {{ $inscription->duration }}</p>
           	<p>Libellé : {{ $inscription->libelle }}</p>
            <p>Commentaires : {!! $inscription->comments !!}</p>
        </div>
    </div>
</main>

@endsection