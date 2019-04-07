@extends('layout')

@section('title', 'Categories')

@section('header')
	
	<h1>{{ $club->name }} - Catégories</h1>
		
@endsection

@section('content')

<div>
    <table class="table table-striped table-hover">
    	<thead>
    		<tr>
    			<th>Label</th>
    			<th>Sexe</th>
    			<th>Né(e) du</th>
    			<th>Au</th>
    		</tr>
    	</thead>
    	<tbody>
    	
    		@foreach ($categories as $category)
    			
    			<tr>
        			<th>{{ $category->label }}</<th>
        			<td>{{ $category->sex }}</<td>
        			<td>{{ $category->starts_at }}</<td>
        			<td>{{ $category->ends_at }}</<td>
        		</tr>
    			
    		@endforeach
    	
    	</tbody>
    </table>
</div>

@endsection
