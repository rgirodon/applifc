@extends('layout')

@section('title', 'Catégorie')

@section('header')
	
	<h1>
		{{ $club->name }} - Démo d'un upload	    	
	</h1>
		
@endsection

@section('content')

@if (session('upload_message_ok'))
    <div class="alert alert-success">
    	Voir le fichier uploadé ici <a href="/{{ $uploadedFile }}" target="_blank">ici</a>           
    </div>
@endif

<main>
	<div class="panel panel-default">
		<div class="panel-heading">Upload Demo</div>
		
        <div class="panel-body"> 
            <form action="{{ route('upload.store') }}" method="post" enctype="multipart/form-data">
            
            	{{ csrf_field() }}
                        
            	<div class="form-group">
                	<label for="file">File</label>
                	<input type="file" class="form-control" id="file" name="file">
              	</div>
              	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
            </form>
        </div>
    </div>
</main>

@endsection
