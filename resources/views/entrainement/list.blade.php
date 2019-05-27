@extends('layout')

@section('title', 'Entrainements')

@section('header')

    <h1>
        {{ $club->name }} - Entrainements à venir

        <span class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            	{{ isset($selectedCategory) ? $selectedCategory->label : 'Filter par Categorie' }} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">

            	<li><a href="{{ route('entrainements') }}">Toutes les catégories</a></li>

            	@foreach ($categories as $category)

                    <li><a href="{{ route('entrainementsByCategory', ['categoryId' => $category->id]) }}">{{ $category->label }}</a></li>

                @endforeach
            </ul>
        </span>

        <span class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            	{{ isset($selectedCoach) ? $selectedCoach->getFullName() : 'Filter par Coach' }} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">

            	<li><a href="{{ route('entrainements') }}">Tous les coachs</a></li>

            	@foreach ($coachs as $coach)

                    <li><a href="{{ route('entrainementsByCoach', ['coachId' => $coach->id]) }}">{{ $coach->getFullName() }}</a></li>

                @endforeach
            </ul>
        </span>
        @auth
            <a class="btn btn-default" href="{{ route('entrainement.create') }}" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter un entrainement</a>
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
            </tr>
            </thead>
            <tbody>

            @foreach ($entrainements as $entrainement)

                <tr>
                    <th><a href="{{ route('entrainement', ['id' => $entrainement->id]) }}">{{ $entrainement->date_entrainement }}</a></th>
                    <td>{{ $entrainement->getJoinedCategories() }}</td>
                    <td>{{ $entrainement->coach->getFullName() }}</td>

                    @auth
                        <td><a class="buttonLink" href="{{ route('entrainement.edit', $entrainement->id) }}" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                        <td>
                            <a class="buttonLink" href="javascript:void(0);" role="button" onclick="$('#deleteEntrainementForm_{{ $entrainement->id }}').submit();">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>
                            <form id="deleteEntrainementForm_{{ $entrainement->id }}" action="{{ route('entrainement.delete', $entrainement->id) }}" method="post">

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

@endsection
