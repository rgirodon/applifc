@extends('layout')

@section('title', 'Categories')

@section('header')
	
	<h1>{{ $club->name }} - Coachs</h1>
		
@endsection

@section('content')

<div>
    <table class="table table-striped table-hover">
    	<thead>
    		<tr>
    			<th>Prénom</th>
    			<th>Nom</th>
    		</tr>
    	</thead>
    	<tbody>
    	
    		@foreach ($coachs as $coach)
    			
    			<tr>
        			<td>{{ $coach->firstname }}</<td>
        			<td>{{ $coach->lastname }}</<td>
        		</tr>
    			
    		@endforeach
    	
    	</tbody>
    </table>
</div>

@endsection
