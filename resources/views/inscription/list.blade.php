@extends('layout')

@section('title', 'Inscriptions')

@section('header')
	
	<h1>
		{{ $club->name }} - Inscriptions à venir

		<a class="btn btn-default" href="{{ route('inscription.create') }}" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter une inscription</a>


		<span class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            	{{ isset($selectedCategory) ? $selectedCategory->label : 'Filter par Categorie' }} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            	
            	<li><a href="{{ route('inscriptions') }}">Toutes les catégories</a></li>
            	
            	@foreach ($categories as $category)
            	
                <li><a href="{{ route('inscriptionsByCategory', ['categoryId' => $category->id]) }}">{{ $category->label }}</a></li>
                
                @endforeach
            </ul>
        </span>
	</h1>
		
@endsection

@section('content')

	@if (session('action_message_ok'))
	<div class="alert alert-success">
		{{ session('action_message_ok') }}
	</div>
	@endif

	@if (session('action_message_ko'))
		<div class="alert alert-danger">
			{{ session('action_message_ko') }}
		</div>
	@endif

<div>
    <table class="table table-striped table-hover">
    	<thead>
    		<tr>
    			<th>Catégories</th>
    			<th>Date compétition</th>    			
    			<th>Libellé</th>
    		</tr>
    	</thead>
    	<tbody>
    	
    		@foreach ($inscriptions as $inscription)
    			
    			<tr>
    				<td>{{ $inscription->getJoinedCategories() }}</td>
        			<th><a href="{{ route('inscription', ['id' => $inscription->id]) }}">{{ $inscription->date_competition }}</a></th>
					<td>{{ $inscription->libelle }}</td>
					<td><a class="buttonLink" href="{{ route('inscription.edit', $inscription->id) }}" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
					<td>
						<a class="buttonLink" href="javascript:void(0);" role="button" onclick="$('#deleteInscriptionForm_{{ $inscription->id }}').submit();">
							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</a>
						<form id="deleteInscriptionForm_{{ $inscription->id }}" action="{{ route('inscription.delete', $inscription->id) }}" method="post">

							<input type="hidden" name="_method" value="DELETE">

							{{ csrf_field() }}

						</form>
					</td>
				</tr>

    		@endforeach
    	
    	</tbody>
    </table>
</div>

@endsection
