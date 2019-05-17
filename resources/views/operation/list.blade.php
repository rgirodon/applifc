@extends('layout')

@section('title', 'Opérations')

@section('header')
	
	<h1>{{ $club->name }} - Opérations</h1>
		
@endsection

@section('content')

<div>
    <table class="table table-striped table-hover">
    	<thead>
    		<tr>
    			<th>Label</th>
    		</tr>
    	</thead>
    	<tbody>
    	
    		@foreach ($operations as $operation)
    			
    			<tr>
        			<th><a href="{{ route('operation', ['id' => $operation->id]) }}">{{ $operation->label }}</a></<th>
        		</tr>
    			
    		@endforeach
    	
    	</tbody>
    </table>
</div>

@endsection
