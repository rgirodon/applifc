<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;

class PlayerController extends Controller
{
    public function show($id) {
        
        $player = Player::find($id);
        
        return view('player')
                ->with(compact('player'));
    }
}
