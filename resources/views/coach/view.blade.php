@extends('layout')

@section('title', 'Player')

@section('header')
	
	<h1>
		{{ $club->name }} - {{ $player->getFullName() }}
	</h1>
		
@endsection

@section('content')

<main>
	<div class="panel panel-default">
		<div class="panel-heading">Identité</div>
		<div class="panel-body">
			<div class="media">
				<div class="media-body">
					<p>Nom : {{ $player->lastname }}</p>
					<p>Prénom : {{ $player->firstname }}</p>
					<p>E-mail : {{ $player->email }}</p>
				</div>
				@if ($player->photo)
					<div class="media-right media-top">
						<img src="/images/coachs/{{ $player->photo }}">
					</div>
				@endif
			</div>
		</div>
	</div>
</main>

@endsection
