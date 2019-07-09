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
			<div class="media">
				<div class="media-body">
					<p>Nom : {{ $coach->lastname }}</p>
					<p>Prénom : {{ $coach->firstname }}</p>
					<p>E-mail : {{ $coach->email }}</p>
					<p>Actif : {{ $coach->isActive() }}</p>
				</div>
				@if ($coach->photo)
					<div class="media-right media-top">
						<img src="/images/coachs/{{ $coach->photo }}">
					</div>
				@endif
			</div>
		</div>
	</div>
</main>

@endsection
