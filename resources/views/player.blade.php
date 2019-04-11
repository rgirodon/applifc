@extends('layout')

@section('title', 'Licenses')

@section('header')
	
	<h1>
		{{ $club->name }} - {{ $player->getCurrentLicence()->category->label }} - {{ $player->getFullName() }}	    	
	</h1>
		
@endsection

@section('content')

<main>
	<div class="panel panel-default">
		<div class="panel-heading">{{ $club->name }} - {{ $player->getCurrentLicence()->category->label }}</div>
        <div class="panel-body">        
           	<p>Nom : {{ $player->lastname }}</p>
            <p>Prénom : {{ $player->firstname }}</p>
            <p>Date de naissance : {{ $player->birth }}</p>
        </div>
    </div>
</main>

@endsection
