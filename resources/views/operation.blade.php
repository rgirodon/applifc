@extends('layout')

@section('title', 'Opérations')

@section('header')
	
	<h1>
		{{ $club->name }} - Opération    	
	</h1>
		
@endsection

@section('content')

<main>
	<div class="panel panel-default">
		<div class="panel-heading">Opération</div>
        <div class="panel-body"> 
            <p>Opération : {{ $operation->label }}</p>   
        </div>
    </div>
    <div class="panel panel-default">
    	<div class="panel-heading">Actions Joueurs</div>
        <div class="panel-body">
            <table class="table table-striped">
            	<thead>
            		<tr>
            			<th>Prénom</th>
            			<th>Nom</th>
            			<th>Catégorie</th>
            			<th>Montant (&euro;)</th>
            			<th>Commentaires</th>
            		</tr>
            	</thead>
            	<tbody>
            	
            		@foreach ($operation->actions as $action)
            			
            			<tr>
                			<td>{{ $action->player->firstname }}</<td>
                			<td>{{ $action->player->lastname }}</<td>
                			<td>{{ $action->player->getCurrentLicence()->category->label }}</<td>
                			<td>{{ $action->amount }}</<td>
                			<td>{!! nl2br($action->comments) !!}</<td>
                		</tr>
            			
            		@endforeach
            	
            	</tbody>
            </table>
        </div>
    </div>
</main>

@endsection
