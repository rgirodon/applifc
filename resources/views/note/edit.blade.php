@extends('layout')

@section('title', 'Notes')

@section('header')
	
	<h1>
		{{ $club->name }} - Edition d'une note
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
		<div class="panel-heading">Note</div>
        <div class="panel-body">
			<p>Catégorie : {{ $note->player->getCurrentLicence()->category->label }}</p>
			<p>Nom : {{ $note->player->lastname }}</p>
			<p>Prénom : {{ $note->player->firstname }}</p>
			<p>Date de naissance : {{ $note->player->birth }}</p>
        </div>
    </div>
	<div class="panel panel-default">
		<div class="panel-heading">Note</div>
		
        <div class="panel-body"> 
            <form action="{{ route('note.update', $note->id) }}" method="post">
            
            	{{ csrf_field() }}
            	
            	<input name="_method" type="hidden" value="PUT">

				<div class="form-group">
					<label for="title">Titre</label>
					<input type="text" class="form-control" id="title" name="title" value="{{ old('title') ? old('title') : $note->title }}">
				</div>

				<div class="form-group">
					<label for="content">Contenu</label>
					<textarea class="form-control" rows="3" name="content" id="content">{{ old('content')  ? old('content') : $note->content }}</textarea>
				</div>

              	<a class="btn btn-default" href="{{ route('player', $note->player->id) }}" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a>
              	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
            </form>
        </div>
    </div>
</main>

@endsection
