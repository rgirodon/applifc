@extends('layout')

@section('title', 'Licences')

@section('header')
	
	<h1>
		{{ $club->name }} - Edition d'une licence	    	
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
		<div class="panel-heading">Identité</div>
        <div class="panel-body"> 
            <p>Catégorie : {{ $licence->player->getCurrentLicence()->category->label }}</p>   
           	<p>Nom : {{ $licence->player->lastname }}</p>
            <p>Prénom : {{ $licence->player->firstname }}</p>
            <p>Date de naissance : {{ $licence->player->birth }}</p>
        </div>
    </div>
	<div class="panel panel-default">
		<div class="panel-heading">Licence</div>
		
        <div class="panel-body"> 
            <form action="{{ route('licence.update', $licence->id) }}" method="post">
            
            	{{ csrf_field() }}
            	
            	<input name="_method" type="hidden" value="PUT">
                        
            	<div class="form-group">
                	<label for="category">Catégorie</label>
                	<select class="form-control" id="category" name="category">
                	
                		@foreach ($categories as $category)
                		
                			<option value="{{ $category->id }}" {{ old('category') 
                													? (old('category') == $category->id ? 'selected' : '')
                													: ($licence->category->id == $category->id ? 'selected' : '') }}>{{ $category->label }}</option>
                		
                		@endforeach

                    </select>
              	</div>
              	<div class="form-group">
                	<label for="starts_at">Licence du</label>
                	<input type="date" class="form-control" id="starts_at" name="starts_at" value="{{ old('starts_at') ? old('starts_at') : $licence->starts_at }}">
              	</div>
              	<div class="form-group">
                	<label for="ends_at">Au</label>
                	<input type="date" class="form-control" id="ends_at" name="ends_at" value="{{ old('ends_at') ? old('ends_at') : $licence->ends_at }}">
              	</div>
              	<div class="form-group">
                	<label for="ends_at">Payée</label>
                	<select class="form-control" id="paid" name="paid">
                		<option value="0" {{ old('paid') 
    											? (old('paid') == '0' ? 'selected' : '')
    											: ($licence->paid == '0' ? 'selected' : '') }}>Non</option>
                		<option value="1" {{ old('paid') 
    											? (old('paid') == '1' ? 'selected' : '')
    											: ($licence->paid == '1' ? 'selected' : '') }}>Oui</option>
                	</select>
              	</div>
              	<div class="form-group">
                	<label for="comments">Commentaires</label>
                	<textarea class="form-control" rows="3" name="comments" id="comments">{{ old('comments') ? old('comments') : $licence->comments }}</textarea>
              	</div>
              	<a class="btn btn-default" href="{{ route('player', $licence->player->id) }}" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a>
              	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
            </form>
        </div>
    </div>
</main>

@endsection
