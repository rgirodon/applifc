@extends('layout')

@section('title', 'Categories')

@section('header')
	
	<h1>
		{{ $club->name }} - Catégories
		
		<a class="btn btn-default" href="{{ route('category.create') }}" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter une catégorie</a>
	
		<a class="btn btn-default" href="#" role="button"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Editer toutes les catégories</a>
	
	</h1>
		
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
    			<th colspan="2">Actions</th>
    		</tr>
    	</thead>
    	<tbody>
    	
    		@foreach ($categories as $category)
    			
    			<tr>
        			<th>{{ $category->label }}</<th>
        			<td>{{ $category->sex }}</<td>
        			<td>{{ $category->starts_at }}</<td>
        			<td>{{ $category->ends_at }}</<td>
        			<td><a class="buttonLink" href="{{ route('category.edit', $category->id) }}" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
        			<td><a class="buttonLink" href="#" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
        		</tr>
    			
    		@endforeach
    	
    	</tbody>
    </table>
</div>

@endsection
