@extends('layout')

@section('title', 'Coach')

@section('header')
	
	<h1>
		{{ $club->name }} - Création d'un Coach
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
		<div class="panel-heading">Coach</div>
		
        <div class="panel-body"> 
            <form action="{{ route('coach.store') }}" method="post">
            
            	{{ csrf_field() }}

            	<div class="form-group">
                	<label for="firstname">Prénom</label>
                	<input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}">
              	</div>
              	<div class="form-group">
                	<label for="lastname">Nom</label>
                	<input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}">
              	</div>

				<div class="form-group">
					<label for="email">E-Mail</label>
					<input type="mail" class="form-control" id="email" name="email" value="{{ old('email') }}">
				</div>


					<div class="panel panel-default">
						<div class="panel-heading">Photo</div>

						<div class="panel-body">
							<form action="{{ route('upload.store') }}" method="post" action="{{url('/uploadfile')}}" enctype="multipart/form-data">

								{{ csrf_field() }}

								<div class="form-group">
									<label for="file">Choisie ta photo</label>
									<input type="file" class="form-control" id="file" name="file">
									@if(count($errors) > 0)
										<div class="alert alert-danger">
											Upload Validation Error <br><br>
											<ul>
												@foreach($errors->all() as $error)
												<li>{{ $error }}</li>
											</ul>
											@endforeach
										</div>
										@endif
										@if($message = Session::get('success'))
										<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
											<strong>{{ $message }}</strong>
										@endif
										</div>
								<img src="/images/{{ Session::get('path') }}">

						</div>
					</div>


              	<a class="btn btn-default" href="{{ route('coachs') }}" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a>
              	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> OK</button>
            </form>
        </div>
    </div>
</main>

@endsection
