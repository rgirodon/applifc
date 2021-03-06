@extends('layout')

@section('title', 'Catégorie')

@section('header')
	
	<h1>
		{{ $club->name }} - Création d'une Catégorie	    	
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
		<div class="panel-heading">Catégorie</div>
		
        <div class="panel-body"> 
            <form action="{{ route('category.store') }}" method="post">
            
            	{{ csrf_field() }}
                        
            	<div class="form-group">
                	<label for="label">Label</label>
                	<input type="text" class="form-control" id="label" name="label" value="{{ old('label') }}">
              	</div>
              	<div class="form-group">
                	<label for="starts_at">Né du</label>
                	<input type="date" class="form-control" id="starts_at" name="starts_at" value="{{ old('starts_at') }}">
              	</div>
              	<div class="form-group">
                	<label for="ends_at">Au</label>
                	<input type="date" class="form-control" id="ends_at" name="ends_at" value="{{ old('ends_at') }}">
              	</div>
              	<div class="form-group">
                	<label for="sex">Sexe</label>
                	<select class="form-control" id="sex" name="sex">
                      <option {{ old('sex') == 'h' ? 'selected' : '' }}>h</option>
                      <option {{ old('sex') == 'f' ? 'selected' : '' }}>f</option>
                    </select>
              	</div>
              	<a class="btn btn-default" href="{{ route('categories') }}" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a>
              	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
            </form>
        </div>
    </div>
</main>

@endsection
