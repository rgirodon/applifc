@extends('layout')

@section('title', 'Opérations')

@section('header')
	
	<h1>

		{{ $club->name }} - Edition d'une Opération

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
            <form action="{{ route('operation.update', $operation->id) }}" method="post">
            
            	{{ csrf_field() }}
            
            	<input name="_method" type="hidden" value="PUT">

				<div class="form-group">
					<label for="label">Label</label>
					<input type="text" class="form-control" id="label" name="label" value="{{ old('label') ? old('label') : $operation->label }}">
				</div>

				<a class="btn btn-default" href="{{ route('operations') }}" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a>

				<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
            </form>
        </div>
    </div>
</main>

@endsection
