<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\Note;

class PlayerController extends Controller
{
    public function show($id) {
        
        $player = Player::find($id);
        
        $notes =  Note::whereHas('player',
            
            function ($query) use ($id) {
                
                $query->where('id', '=', $id);
            }
        )
        ->orderBy('created_at')
        ->get();
        
        return view('player.view')
                ->with(compact('player', 'notes'));
    }
}
