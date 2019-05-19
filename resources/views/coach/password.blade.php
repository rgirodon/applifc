@extends('layout')

@section('title', 'Coach')

@section('header')
	
	<h1>

		{{ $club->name }} - Changer mon mot de passe

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
		<div class="panel-heading">Coach</div>
		
        <div class="panel-body"> 
            <form action="{{ route('password.change.store') }}" method="post">
            
            	{{ csrf_field() }}
            
            	<input name="_method" type="hidden" value="PUT">

				<div class="form-group">
					<label for="currentPassword">Mot de passe actuel</label>
					<input type="password" class="form-control" id="currentPassword" name="currentPassword">
				</div>

				<div class="form-group">
					<label for="newPassword">Nouveau mot de passe</label>
					<input type="password" class="form-control" id="newPassword" name="newPassword">
				</div>

				<div class="form-group">
					<label for="newPassword_confirmation">Confirmer le mot de passe</label>
					<input type="password" class="form-control" id="newPassword_confirmation" name="newPassword_confirmation">
				</div>

				<a class="btn btn-default" href="{{ route('home') }}" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a>

				<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
            </form>
        </div>
    </div>
</main>

@endsection
