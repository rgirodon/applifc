@extends('layout')

@section('title', 'Licenses')

@section('header')
	
	<h1>{{ $club->name }} - Licences</h1>
		
@endsection

@section('content')

<div>
    <table class="table table-striped table-hover">
    	<thead>
    		<tr>
    			<th>Catégorie</th>
    			<th>Nom</th>
    			<th>Prénom</th>
    		</tr>
    	</thead>
    	<tbody>
    	
    		@foreach ($licences as $licence)
    			
    			<tr>
        			<th>{{ $licence->category->label }}</<th>
        			<td>{{ $licence->player->lastname }}</<td>
        			<td>{{ $licence->player->firstname }}</<td>
        		</tr>
    			
    		@endforeach
    	
    	</tbody>
    </table>
</div>

@endsection
