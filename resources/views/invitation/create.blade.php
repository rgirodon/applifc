@extends('layout')

@section('title', 'Invitations')

@section('header')
	
	<h1>
		{{ $club->name }} - Création d'une invitation	    	
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
		<div class="panel-heading">Invitation</div>
		
        <div class="panel-body"> 
            <form action="{{ route('invitation.store') }}" method="post">
            
            	{{ csrf_field() }}
                        
            	<div class="form-group">
                	<label for="categoryIds[]">Catégorie</label>
                	<select class="form-control" id="categoryIds[]" name="categoryIds[]" multiple>
                	
                		@foreach ($categories as $category)
                		
                			<option value="{{ $category->id }}" {{ old('categoryIds') ? (in_array($category->id, old('categoryIds')) ? 'selected' : '') : '' }}>{{ $category->label }}</option>
                		
                		@endforeach

                    </select>
              	</div>
              	<div class="form-group">
                	<label for="libelle">Libellé</label>
                	<input type="text" class="form-control" id="libelle" name="libelle" value="{{ old('libelle') }}">
              	</div>
              	<div class="form-group">
                	<label for="date_competition">Date de la compétition</label>
                	<input type="date" class="form-control" id="date_competition" name="date_competition" value="{{ old('date_competition') }}">
              	</div>
              	<div class="form-group">
                	<label for="date_limite_reponse">Date limite de réponse</label>
                	<input type="date" class="form-control" id="date_limite_reponse" name="date_limite_reponse" value="{{ old('date_limite_reponse') }}">
              	</div>
              	<div class="form-group">
                	<label for="comments">Commentaires</label>
                	<textarea class="form-control" rows="3" name="comments" id="comments">{{ old('comments') }}</textarea>
              	</div>
              	<a class="btn btn-default" href="{{ route('invitations') }}" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a>
              	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
            </form>
        </div>
    </div>
</main>

@endsection
