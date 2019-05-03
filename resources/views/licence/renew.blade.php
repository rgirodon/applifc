@extends('layout')

@section('title', 'Licences')

@section('header')
	
	<h1>
		{{ $club->name }} - Renouvellement de licences	    	
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

<main>
	<div class="panel panel-default">
		<div class="panel-heading">Licence</div>
		
        <div class="panel-body"> 
            <form action="{{ route('licences.storeAll') }}" method="post">
            
            	{{ csrf_field() }}
                        
            	<div class="form-group">
                	<label for="category">Catégorie</label>
                	<select class="form-control" id="category" name="category">
                	
                		<option value="-">-</option>
                	
                		@foreach ($categories as $category)
                		
                			<option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->label }}</option>
                		
                		@endforeach

                    </select>
              	</div>
              	<div class="form-group">
                	<label for="starts_at">Licence du</label>
                	<input type="date" class="form-control" id="starts_at" name="starts_at" value="{{ old('starts_at') }}">
              	</div>
              	<div class="form-group">
                	<label for="ends_at">Au</label>
                	<input type="date" class="form-control" id="ends_at" name="ends_at" value="{{ old('ends_at') }}">
              	</div>
              	<a class="btn btn-default" href="{{ route('licences') }}" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a>
              	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
            </form>
        </div>
    </div>
</main>

@endsection
