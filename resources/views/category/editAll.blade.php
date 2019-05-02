@extends('layout')

@section('title', 'Categories')

@section('header')
	
	<h1>
		{{ $club->name }} - Edit Catégories	
	</h1>
		
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('category.updateAll') }}" method="post">
            
	{{ csrf_field() }}
	
	<input name="_method" type="hidden" value="PUT">
	
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
            			<td>
            				<input type="text" class="form-control" id="label_{{ $category->id }}" name="label_{{ $category->id }}" value="{{ old('label_'.$category->id) ? old('label_'.$category->id) : $category->label }}">
            			</td>
            			
            			<td>
            				<select class="form-control" id="sex" name="sex">
                            	<option {{ $category->sex == 'h' ? 'selected' : '' }}>h</option>
                              	<option {{ $category->sex == 'f' ? 'selected' : '' }}>f</option>
                            </select>
            			</td>
            			<td>
            				<input type="date" class="form-control" id="starts_at_{{ $category->id }}" name="starts_at_{{ $category->id }}" value="{{ old('starts_at_'.$category->id) ? old('starts_at_'.$category->id) : $category->starts_at }}">
            			</td>
            			<td>
            				<input type="date" class="form-control" id="ends_at_{{ $category->id }}" name="ends_at_{{ $category->id }}" value="{{ old('ends_at_'.$category->id) ? old('ends_at_'.$category->id) : $category->ends_at }}">
            			</td>
            		</tr>
        			
        		@endforeach
        	
        	</tbody>
        </table>
    </div>
    
    <div>
        <a class="btn btn-default" href="{{ route('categories') }}" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
    </div>

</form>

@endsection
