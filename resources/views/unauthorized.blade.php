@extends('layout')

@section('title', 'Home')

@section('header')
	
	<h1>
		{{ $club->name }} 
	</h1>
	
	
		
@endsection

@section('content')

<h2>
	Carton rouge ! Cette opération n'est pas autorisée.
</h2>

@endsection
