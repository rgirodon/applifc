@extends('layout')

@section('title', 'Entrainement')

@section('header')

    <h1>
        {{ $club->name }} - Entrainement
    </h1>

@endsection

@section('content')

    <main>
        <div class="panel panel-default">
            <div class="panel-heading">Entrainement</div>
            <div class="panel-body">
                <p>Catégories : {{ $entrainement->getJoinedCategories() }}</p>
                <p>Séance planifiée par : {{ $entrainement->coach->getFullName() }}</p>
                <p>Date : {{ $entrainement->date_entrainement }}</p>
                <p>Commentaires : {!! nl2br($entrainement->comments) !!}</p>
                <p>Heure / Lieu : {{ $entrainement->heure_lieu }}</p>
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
                <form id='addPlayerForm' class="form-inline" action="{{ route('entrainement.addPlayer', $entrainement->id) }}" method="post">

                    {{ csrf_field() }}

                    <input type="text" class="form-control" id="addPlayer" placeholder="Ajouter un joueur">

                    <input type="hidden" name="playerId" id="playerId">

                    <a class="btn btn-default" id="" href="javascript:void(0)" onclick="$('#addPlayerForm').submit();" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>

                </form>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($entrainement->players as $player)

                        <tr>
                            <td>{{ $player->firstname }}</td>
                            <td>{{ $player->lastname }}</td>
                            <td>
                                <a class="buttonLink" href="javascript:void(0);" role="button" onclick="$('#deleteEntrainementPlayerForm_{{ $player->id }}').submit();">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </a>
                                <form id="deleteEntrainementPlayerForm_{{ $player->id }}" action="{{ route('entrainement.deletePlayer', ['id' => $entrainement->id, 'playerId' => $player->id]) }}" method="post">

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