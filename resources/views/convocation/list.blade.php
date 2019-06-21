@extends('layout')

@section('title', 'Convocations')

@section('header')
	
	<h1>
		{{ $club->name }} - Convocations à venir
	
		<span class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            	{{ isset($selectedCategory) ? $selectedCategory->label : 'Filter par Categorie' }} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            	
            	<li><a href="{{ route('convocations') }}">Toutes les catégories</a></li>
            	
            	@foreach ($categories as $category)
            	
                <li><a href="{{ route('convocationsByCategory', ['categoryId' => $category->id]) }}">{{ $category->label }}</a></li>
                
                @endforeach
            </ul>
        </span>
        
    	<span class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            	{{ isset($selectedCoach) ? $selectedCoach->getFullName() : 'Filter par Coach' }} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            	
            	<li><a href="{{ route('convocations') }}">Tous les coachs</a></li>
            	
            	@foreach ($coachs as $coach)
            	
                <li><a href="{{ route('convocationsByCoach', ['coachId' => $coach->id]) }}">{{ $coach->getFullName() }}</a></li>
                
                @endforeach
            </ul>
        </span>
        
        @auth
        	<a class="btn btn-default" href="{{ route('convocation.create') }}" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter une convocation</a>
        @endauth
	</h1>
		
@endsection

@section('content')

@if (session('delete_message_ok'))
    <div class="alert alert-success">
    	{{ session('delete_message_ok') }}            
    </div>
@endif

@if (session('delete_message_ko'))
    <div class="alert alert-danger">
    	{{ session('delete_message_ko') }}            
    </div>
@endif

<div>
    <table class="table table-striped table-hover">
    	<thead>
    		<tr>
    			<th>Date</th>
    			<th>Catégories</th>
    			<th>Coach</th>
    			<th>Heure / Lieu</th>
    			<th>Description</th>
    			<th>Commentaires</th>
    			
    			@guest
    				<th>Actions</th>
    			@endguest
    			
    			@auth
    				<th colspan="3">Actions</th>
    			@endauth    			
    		</tr>
    	</thead>
    	<tbody>
    	
    		@foreach ($convocations as $convocation)
    			
    			<tr>
        			<th><a href="{{ route('convocation', ['id' => $convocation->id]) }}">{{ $convocation->date_convocation }}</a></th>
        			<td>{{ $convocation->getJoinedCategories() }}</td>
        			<td>{{ $convocation->coach->getFullName() }}</<td>
        			<td>{{ $convocation->heure_lieu }}</<td>
        			<td>{{ $convocation->description }}</<td>        			
        			<td>{!! nl2br($convocation->comments) !!}</<td>
        			
        			@guest
        				<td><a class="buttonLink" href="javascript:void(0);" role="button"><span class="glyphicon glyphicon-user" aria-hidden="true" data-toggle="modal" data-target="#convocationPlayersModal" data-id="{{ $convocation->id }}"></span></a></td>
        			@endguest
        			
        			@auth
        				<td><a class="buttonLink" href="javascript:void(0);" role="button"><span class="glyphicon glyphicon-user" aria-hidden="true" data-toggle="modal" data-target="#convocationPlayersModal"></span></a></td>
            			<td><a class="buttonLink" href="{{ route('convocation.edit', $convocation->id) }}" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
            			<td>
            				<a class="buttonLink" href="javascript:void(0);" role="button" onclick="$('#deleteConvocationForm_{{ $convocation->id }}').submit();">
            					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            				</a>
            				<form id="deleteConvocationForm_{{ $convocation->id }}" action="{{ route('convocation.delete', $convocation->id) }}" method="post">
                                
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

<div class="modal fade" id="convocationPlayersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Joueurs convoqués</h4>
      </div>
      <div class="modal-body">
        <ul id="convocationPlayersList">
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$('#convocationPlayersModal').on('show.bs.modal', function(e) {

	console.log('Show convocation players modal : ' +  e.relatedTarget.getAttribute('data-id'));

	$.get( '/api/convocations/' + e.relatedTarget.getAttribute('data-id'), function( data ) {

		$( "#convocationPlayersList" ).html("");
		
		data.players.forEach(
			function (item) {
				$( "#convocationPlayersList" ).append('<li>' + item.firstname + ' ' + item.lastname + '</li>' );
			}
		);
	});
})
</script>

@endsection
