<?php

namespace App\Http\Controllers;
use App\Club;
use App\Note;
use Carbon\Carbon;
use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller

{

    public function edit($id)
    {
        $note = Note::find($id);

        return view('note.edit')->with('note', $note);
    }


    public function create($playerId)
    {
        $player = Player::find($playerId);

        return view('note.create')
                ->with(compact('player'));;
    }

    public function destroy(Request $request, $id)
    {
        $note = Note::find($id);

        $note->delete();

        $request->session()->flash('delete_message_ok', 'Note supprimée');

        return redirect()->route('player', $note->player->id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'bail|required|max:255',
            'content' => 'bail|required|',
        ]);

        $note = Note::find($id);

        $note->title = $request->input('title');

        $note->content = $request->input('content');

        $note->save();

        return redirect()->route('player', $note->player->id);
    }


    public function store(Request $request)
    {
        $request->validate([
            'player' => 'bail|required|integer',
            'title' => 'bail|required|max:255',
            'content' => 'bail|required|',
        ]);

        $coach = Auth::user();

        $player = Player::find($request->input('player'));

        $note = new Note();

        $note->coach()->associate($coach);

        $note->player()->associate($player);

        $note->title = $request->input('title');

        $note->content = $request->input('content');

        $note->save();

        return redirect()->route('player', $note->player->id);
    }
}
