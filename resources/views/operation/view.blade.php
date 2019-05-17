@extends('layout')

@section('title', 'Opérations')

@section('header')
	
	<h1>
		{{ $club->name }} - Opération    	
	</h1>
		
@endsection

@section('content')

@if (session('action_message_ok'))
    <div class="alert alert-success">
    	{{ session('action_message_ok') }}            
    </div>
@endif

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
            			<th colspan="2">Actions</th>
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
                			<td><a class="buttonLink" href="{{ route('action.edit', $action->id) }}" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                			<td>
                				<a class="buttonLink" href="javascript:void(0);" role="button" onclick="$('#deleteActionForm_{{ $action->id }}').submit();">
                					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                				</a>
                				<form id="deleteActionForm_{{ $action->id }}" action="{{ route('action.delete', $action->id) }}" method="post">
                                    
                                    <input type="hidden" name="_method" value="DELETE">
                                    
                                    {{ csrf_field() }}
                                    
                                </form>
                			</td>
                		</tr>
            			
            		@endforeach
            	
            	</tbody>
            </table>
        </div>
    </div>
</main>

@endsection
