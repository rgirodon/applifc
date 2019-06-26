@extends('layout')

@section('title', 'Players')

@section('header')

	<h1>
		{{ $club->name }} - Création d'un joueur
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

		<form action="{{ route('player.store') }}" method="post" enctype="multipart/form-data">>

			{{ csrf_field() }}

			<div class="panel panel-default">
				<div class="panel-heading">Identité</div>
				<div class="panel-body">

					<div class="form-group">
						<label for="lastname">Nom</label>
						<input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}">
					</div>

					<div class="form-group">
						<label for="firstname">Prénom</label>
						<input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}">
					</div>

					<div class="form-group">
						<label for="ends_at">Date de Naissance</label>
						<input type="date" class="form-control" id="birth" name="birth" value="{{ old('birth') }}">
					</div>

				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Licence</div>

        		<div class="panel-body">

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

					<div class="form-group">
						<label for="file">Photo</label>
						<input type="file" class="form-control" id="file" name="file">
					</div>

				</div>

			</div>

			<a class="btn btn-default" href="{{ route('licences') }}" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a>

			<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>

		</form>

	</main>
@endsection
