@extends('layout')

@section('title', 'Players')

@section('header')
	
	<h1>

		{{ $club->name }} - Edition d'un Joueur

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
		<div class="panel-heading">Joueur</div>
		
        <div class="panel-body"> 
            <form action="{{ route('player.update', $player->id) }}" method="post"  enctype="multipart/form-data">
            
            	{{ csrf_field() }}
            
            	<input name="_method" type="hidden" value="PUT">

				<div class="form-group">
					<label for="firstname">Prénom</label>
					<input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') ? old('firstname') : $player->firstname }}">
				</div>

				<div class="form-group">
					<label for="lastname">Nom</label>
					<input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') ? old('lastname') : $player->lastname }}">
				</div>

				<div class="form-group">
					<label for="birth">Date de naissance</label>
					<input type="date" class="form-control" id="birth" name="birth" value="{{ old('birth') ? old('birth') : $player->birth }}">
				</div>

				<div class="form-group">
					<label for="file">Photo</label>
					<input type="file" class="form-control" id="file" name="file">
				</div>
				<a class="btn btn-default" href="{{ route('licences') }}" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a>

				<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
            </form>
        </div>
    </div>
</main>

@endsection
