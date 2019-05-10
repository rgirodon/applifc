@extends('layout')

@section('title', 'Coach')

@section('header')
	
	<h1>

		{{ $club->name }} - Edition d'un Coach

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
            <form action="{{ route('coach.update', $coach->id) }}" method="post">
            
            	{{ csrf_field() }}
            
            	<input name="_method" type="hidden" value="PUT">

				<div class="form-group">
					<label for="label">Prénom</label>
					<input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') ? old('firstname') : $coach->firstname }}">
				</div>

				<div class="form-group">
					<label for="lastname">Nom</label>
					<input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') ? old('lastname') : $coach->lastname }}">
				</div>

				<div class="form-group">
					<label for="email">E-Mail</label>
					<input type="mail" class="form-control" id="email" name="email" value="{{ old('email') ? old('email') : $coach->email }}">
				</div>

				<a class="btn btn-default" href="{{ route('coachs') }}" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a>

				<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
            </form>
        </div>
    </div>
</main>

@endsection
