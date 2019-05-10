@extends('layout')

@section('title', 'Coach')

@section('header')
	
	<h1>
		{{ $club->name }} - Dirigeants

		<a class="btn btn-default" href="{{ route('coach.create') }}" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter un coach</a>
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
    			<th>Prénom</th>
    			<th>Nom</th>
    		</tr>
    	</thead>
    	<tbody>

    		@foreach ($coachs as $coach)


					<th>{{ $coach->club_id }}</th>
					<td>{{ $coach->firstname }}</td>
					<td><a href="{{ route('coach', ['id' => $coach->id]) }}">{{ $coach->lastname }}</a></td>
					<td>{{ $coach->email }}</td>
					<td><a class="buttonLink" href="{{ route('coach.edit', $coach->id) }}" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
					<td>
						<a class="buttonLink" href="javascript:void(0);" role="button" onclick="$('#deleteCoachForm_{{ $coach->id }}').submit();">
							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</a>
						<form id="deleteCoachForm_{{ $coach->id }}" action="{{ route('coach.delete', $coach->id) }}" method="post">

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
