@extends('layout')

@section('title', 'Home')

@section('header')
	
	<h1>
		{{ $club->name }} 
	</h1>
		
@endsection

@section('content')

@if (session('action_message_ok'))
	<div class="alert alert-success">
		{{ session('action_message_ok') }}
	</div>
@endif

<h2>
	Bienvenue dans l'application de gestion de la vie de votre club au quotidien
</h2>

@endsection
