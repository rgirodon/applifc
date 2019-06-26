<?php

namespace App\Http\Controllers;

use App\Category;
use App\Club;
use App\Licence;
use Illuminate\Http\Request;
use App\Player;
use App\Note;
use Illuminate\Support\Facades\Storage;
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



    public function edit($id)
    {
        $player = Player::find($id);

        return view('player.edit')
            ->with(compact('player'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'firstname' => 'bail|required|max:255',
            'lastname' => 'bail|required|max:255',
             'birth' =>'bail|required|date',
        ]);

        $player = Player::find($id);
        $file = $request->file('file');

        if($file) {

            $photoFileName = $file->hashName();

            Storage::disk('public_uploads')->delete('images/players/'.$player->photo);

            $file->storeAs('images/players', $photoFileName, 'public_uploads');

            $player->photo = $photoFileName;
        }


        $player->firstname = $request->input('firstname');

        $player->lastname = $request->input('lastname');

        $player->birth = $request->input('birth');

        $player->save();

        return redirect()->route('licences');
    }


    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'bail|required|max:255',
            'lastname' => 'bail|required|max:255',
            'birth' =>'bail|required|date',
            'category' => 'bail|required|integer',
            'starts_at' => 'bail|required|date',
            'ends_at' => 'bail|required|date',
        ]);

        $club = Club::findDefaultClub();

        $player = new Player();

        $player->club()->associate($club);

        $player->firstname = $request->input('firstname');

        $player->lastname = $request->input('lastname');

        $player->birth = $request->input('birth');

        $file = $request->file('file');
        if ($file) {
            $photoFileName = $file->hashName();

            $file->storeAs('images/players', $photoFileName, 'public_uploads');

            $player->photo = $photoFileName;
        }
        $player->sex = 'h';

        $player->save();

        $licence = new Licence();

        $licence->club()->associate($club);

        $licence->player()->associate($player);

        $category = Category::find($request->input('category'));

        $licence->category()->associate($category);

        $licence->starts_at = $request->input('starts_at');

        $licence->ends_at = $request->input('ends_at');

        $licence->paid = false;

        $licence->save();

        return redirect()->route('licences');
    }


    public function create()
    {
        $categories = Category::retrieveCategoriesForDefaultClub();

        return view('player.create')
                ->with(compact('categories'));
    }

     public function destroy(Request $request, $id)
    {

        try {
            $player = Player::find($id);

            $player->delete();

            $request->session()->flash('delete_message_ok', 'Joueur supprimé');
        } catch (\Exception $exception) {

            $request->session()->flash('delete_message_ko', 'Impossible de supprimer ce joueur');
        }

        return redirect()->route('licences');
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
