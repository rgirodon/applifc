@extends('layout')

@section('title', 'Entrainements')

@section('header')

	<h1>
		{{ $club->name }} - Création d'un Entrainement
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
		<div class="panel-heading">Entrainement</div>

        <div class="panel-body">
            <form action="{{ route('entrainement.store') }}" method="post">

            	{{ csrf_field() }}

                <input name="coach" type="hidden" value="{{ $coach->id }}">

            	<div class="form-group">
                	<label for="categoryIds[]">Catégorie</label>
                	<select class="form-control" id="categoryIds[]" name="categoryIds[]" multiple>

                		@foreach ($categories as $category)

                			<option value="{{ $category->id }}" {{ old('categoryIds') ? (in_array($category->id, old('categoryIds')) ? 'selected' : '') : '' }}>{{ $category->label }}</option>

                		@endforeach

                    </select>
              	</div>
              	<div class="form-group">
                	<label for="date_entrainement">Date</label>
                	<input type="date" class="form-control" id="date_entrainement" name="date_entrainement" value="{{ old('date_entrainement') }}">
              	</div>

				<div class="form-group">
					<label for="heure_lieu">Heure / Lieu</label>
					<input type="text" class="form-control" id="heure_lieu" name="heure_lieu" value="{{ old('heure_lieu') }}">
				</div>
              	<div class="form-group">
                	<label for="comments">Commentaires</label>
                	<textarea class="form-control" rows="3" name="comments" id="comments">{{ old('comments') }}</textarea>
              	</div>
              	<a class="btn btn-default" href="{{ route('entrainements') }}" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a>
              	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
            </form>
        </div>
    </div>
</main>

@endsection
