@extends('layout')

@section('title', 'Coach')

@section('header')
	
	<h1>
		{{ $club->name }} - {{ $coach->getFullName() }}
	</h1>
		
@endsection

@section('content')

<main>
	<div class="panel panel-default">
		<div class="panel-heading">Identité</div>
        <div class="panel-body">
           	<p>Nom : {{ $coach->lastname }}</p>
            <p>Prénom : {{ $coach->firstname }}</p>
            <p>E-mail : {{ $coach->email }}</p>
        </div>
    </div>
</main>

@endsection
