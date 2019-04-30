@extends('layout')

@section('title', 'Joueur')

@section('header')
	
	<h1>
		{{ $club->name }} - Catégorie - {{ $category->label }}	    	
	</h1>
		
@endsection

@section('content')

<main>
	<div class="panel panel-default">
		<div class="panel-heading">Catégorie</div>
		
		@if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
		
        <div class="panel-body"> 
            <form action="{{ route('category.update', $category->id) }}" method="post">
            
            	{{ csrf_field() }}
            
            	<input name="_method" type="hidden" value="PUT">
            
            	<div class="form-group">
                	<label for="label">Label</label>
                	<input type="text" class="form-control" id="label" name="label" value="{{ old('label') ? old('label') : $category->label }}">
              	</div>
              	<div class="form-group">
                	<label for="starts_at">Né du</label>
                	<input type="date" class="form-control" id="starts_at" name="starts_at" value="{{ old('starts_at') ? old('starts_at') : $category->starts_at }}">
              	</div>
              	<div class="form-group">
                	<label for="ends_at">Au</label>
                	<input type="date" class="form-control" id="ends_at" name="ends_at" value="{{ old('ends_at') ? old('ends_at') : $category->ends_at }}">
              	</div>
              	<div class="form-group">
                	<label for="sex">Sexe</label>
                	<select class="form-control" id="sex" name="sex">
                      <option {{ $category->sex == 'h' ? 'selected' : '' }}>h</option>
                      <option {{ $category->sex == 'f' ? 'selected' : '' }}>f</option>
                    </select>
              	</div>
              	<a class="btn btn-default" href="{{ route('categories') }}" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a>
              	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
            </form>
        </div>
    </div>
</main>

@endsection
