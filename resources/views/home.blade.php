@extends('layout')

@section('title', 'Home')

@section('header')
	
	<h1>
		{{ $club->name }} 
	</h1>
	
	
		
@endsection

@section('content')

<h2>
	Bienvenue dans l'application de gestion de la vie de votre club au quotidien
</h2>

@endsection
