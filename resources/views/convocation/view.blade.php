@extends('layout')

@section('title', 'Convocations')

@section('header')
	
	<h1>
		{{ $club->name }} - Convocation    	
	</h1>
		
@endsection

@section('content')

<main>
	<div class="panel panel-default">
		<div class="panel-heading">Convocation</div>
        <div class="panel-body"> 
        	<p>Catégories : {{ $convocation->getJoinedCategories() }}</p>
            <p>Convocation émise par : {{ $convocation->coach->getFullName() }}</p>   
           	<p>Date de la convocation : {{ $convocation->date_convocation }}</p>
           	<p>Heure / Lieu : {{ $convocation->heure_lieu }}</p>
           	<p>Description : {{ $convocation->description }}</p>
            <p>Commentaires : {!! nl2br($convocation->comments) !!}</p>
        </div>
    </div>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="panel panel-default">
    	<div class="panel-heading panel-btn-bar">
    	
    		Joueurs
 			
 			@auth
     			<form id='addPlayerForm' class="form-inline" action="{{ route('convocation.addPlayer', $convocation->id) }}" method="post">
     			
     				{{ csrf_field() }}
     			
                    <input type="text" class="form-control" id="addPlayer" placeholder="Ajouter un joueur">
                    
                    <input type="hidden" name="playerId" id="playerId">
        
            		<a class="btn btn-default" id="" href="javascript:void(0)" onclick="$('#addPlayerForm').submit();" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
            		
        		</form>
    		@endauth
    		
    	</div>
        <div class="panel-body">
            <table class="table table-striped">
            	<thead>
            		<tr>
            			<th>Prénom</th>
            			<th>Nom</th>
            			@auth
            				<th>Actions</th>
            			@endauth
            		</tr>
            	</thead>
            	<tbody>
            	
            		@foreach ($convocation->players as $player)
            			
            			<tr>
                			<td>{{ $player->firstname }}</<td>
                			<td>{{ $player->lastname }}</<td>
                			@auth
                			<td>
                				<a class="buttonLink" href="javascript:void(0);" role="button" onclick="$('#deleteConvocationPlayerForm_{{ $player->id }}').submit();">
                					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                				</a>
                				<form id="deleteConvocationPlayerForm_{{ $player->id }}" action="{{ route('convocation.deletePlayer', ['id' => $convocation->id, 'playerId' => $player->id]) }}" method="post">
                                    
                                    <input type="hidden" name="_method" value="DELETE">
                                    
                                    {{ csrf_field() }}
                                    
                                </form>
                			</td>
                			@endauth
                		</tr>
            			
            		@endforeach
            	
            	</tbody>
            </table>
        </div>
    </div>
</main>

<script>
$(function() {

    $('#addPlayer').autocomplete({
    
    	source: '{{ route('player.autocomplete.search') }}',

    	minLength: 2,
    	
      	select: function(event, ui) {
          	
        	$('#playerId').val(ui.item.id);
      	}
    });
});
</script>

@endsection
