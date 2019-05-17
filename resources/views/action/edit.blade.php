@extends('layout')

@section('title', 'Opérations')

@section('header')
	
	<h1>
		{{ $club->name }} - Opération    	
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
		<div class="panel-heading">Opération</div>
        <div class="panel-body"> 
            <p>Opération : {{ $action->operation->label }}</p>   
        </div>
    </div>
    <div class="panel panel-default">
    	<div class="panel-heading">Joueur</div>
        <div class="panel-body">
            <p>Prénom : {{ $action->player->firstname }}</p>
            <p>Nom : {{ $action->player->lastname }}</p>
            <p>Catégorie : {{ $action->player->getCurrentLicence()->category->label }}</p>
        </div>
    </div>
    <div class="panel panel-default">
    	<div class="panel-heading">Action</div>
        <div class="panel-body">
			<form action="{{ route('action.update', $action->id) }}" method="post">
            
            	{{ csrf_field() }}
            	
            	<input name="_method" type="hidden" value="PUT">

				<div class="form-group">
					<label for="amount">Montant (&euro;)</label>
					<input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount') ? old('amount') : $action->amount }}">
				</div>

				<div class="form-group">
					<label for="comments">Commentaires</label>
					<textarea class="form-control" rows="3" name="comments" id="comments">{{ old('comments')  ? old('comments') : $action->comments }}</textarea>
				</div>

              	<a class="btn btn-default" href="{{ route('operation', $action->operation->id) }}" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a>
              	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
            </form>
        </div>
    </div>
</main>

@endsection
