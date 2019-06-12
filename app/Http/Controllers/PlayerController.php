<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\Note;
use Illuminate\Http\Response;

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
    
    public function search(Request $request) {
        
        $term = $request->input('term');
        
        // TODO check player has current licence in default club !
        
        $players = Player::where('firstname', 'like', '%'.$term.'%')
                            ->orWhere('lastname','like', '%'.$term.'%')
                            ->get();
        
        $playersForJson = [];                    
                            
        foreach ($players as $player) {
            
            $playersForJson[] = [
                'id' => $player->id,
                'value' => $player->getCurrentLicence()->category->label.' - '.$player->getFullName(),
                'label' => $player->getCurrentLicence()->category->label.' - '.$player->getFullName()
            ];
        }
                            
        return response()->json($playersForJson);
    }
}
