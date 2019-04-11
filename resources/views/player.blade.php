@extends('layout')

@section('title', 'Licenses')

@section('header')
	
	<h1>
		{{ $club->name }} - {{ $player->getCurrentLicence()->category->label }} - {{ $player->getFullName() }}	    	
	</h1>
		
@endsection

@section('content')

<div>
    
</div>

@endsection
