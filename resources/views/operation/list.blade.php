@extends('layout')

@section('title', 'Opérations')

@section('header')
	
	<h1>
	{{ $club->name }} - Opérations
	<a class="btn btn-default" href="{{ route('operation.create') }}" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter une opération</a>
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
    			<th>Label</th>
    			<th colspan="2">Actions</th>
    		</tr>
    	</thead>
    	<tbody>
    	
    		@foreach ($operations as $operation)
    			
    			<tr>
        			<th><a href="{{ route('operation', ['id' => $operation->id]) }}">{{ $operation->label }}</a></<th>
        			<td><a class="buttonLink" href="{{ route('operation.edit', $operation->id) }}" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
					<td>
						<a class="buttonLink" href="javascript:void(0);" role="button" onclick="$('#deleteOperationForm_{{ $operation->id }}').submit();">
							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</a>
						<form id="deleteOperationForm_{{ $operation->id }}" action="{{ route('operation.delete', $operation->id) }}" method="post">

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
