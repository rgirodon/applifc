@extends('layout')

@section('title', 'Coachs')

@section('header')
	
	<h1>{{ $club->name }} - Dirigeants</h1>
		
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
        			<td>{{ $coach->firstname }}</td>
        			<td>
						<a href="{{ route('coach', ['id' => $coach->id]) }}">{{ $coach->lastname }}</a>
					</td>
        		</tr>

    		@endforeach
    	
    	</tbody>
    </table>
</div>

@endsection
