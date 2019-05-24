@extends('layout')

@section('title', 'Inscriptions')

@section('header')
	
	<h1>
		{{ $club->name }} - Edition d'une inscription
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
		<div class="panel-heading">Inscription</div>
		
        <div class="panel-body"> 
            <form action="{{ route('inscription.update', $inscription->id) }}" method="post">
            
            	{{ csrf_field() }}
            	
            	<input name="_method" type="hidden" value="PUT">
                        
            	<div class="form-group">
                	<label for="categoryIds[]">Catégorie</label>
                	<select class="form-control" id="categoryIds[]" name="categoryIds[]" multiple>
                	
                		@foreach ($categories as $category)
                		
                			<option value="{{ $category->id }}" {{ old('categoryIds') ? 
                													(in_array($category->id, old('categoryIds')) ? 'selected' : '') :
                													($inscription->isForCategory($category->id) ? 'selected' : '') }}>{{ $category->label }}</option>
                		
                		@endforeach

                    </select>
              	</div>
              	<div class="form-group">
                	<label for="libelle">Libellé</label>
                	<input type="text" class="form-control" id="libelle" name="libelle" value="{{ old('libelle') ? old('libelle') : $inscription->libelle }}">
              	</div>
              	<div class="form-group">
                	<label for="date_competition">Date de la compétition</label>
                	<input type="date" class="form-control" id="date_competition" name="date_competition" value="{{ old('date_competition') ? old('date_competition') : $inscription->date_competition }}">
              	</div>

              	<div class="form-group">
                	<label for="comments">Commentaires</label>
                	<textarea class="form-control" rows="3" name="comments" id="comments">{{ old('comments') ? old('comments') : $inscription->comments }}</textarea>
              	</div>
              	<a class="btn btn-default" href="{{ route('inscriptions') }}" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a>
              	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
            </form>
        </div>
    </div>
</main>

@endsection
