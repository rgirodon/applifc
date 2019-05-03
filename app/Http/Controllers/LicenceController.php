<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Licence;
use Carbon\Carbon;
use App\Category;
use App\Club;
use App\Player;

class LicenceController extends Controller
{        
    public function index() {
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $licences =  Licence::where([
            ['starts_at', '<=', Carbon::now()],
            ['ends_at', '>', Carbon::now()],
            ['club_id', '=', env('DEFAULT_CLUB_ID')],
        ])
        ->get();
        
        return view('licence.list')
                ->with(compact('licences', 'categories'));
    }

    public function findByCategory($categoryId) {
        
        $selectedCategory = Category::find($categoryId);
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $licences =  Licence::where([
            ['category_id', '=', $categoryId],
            ['starts_at', '<=', Carbon::now()],
            ['ends_at', '>', Carbon::now()],
        ])->get();
        
        return view('licence.list')
                ->with(compact('licences', 'categories', 'selectedCategory'));
    }
    
    public function renew(Request $request) {
                
        $request->validate([
            'playerIds' => 'bail|required|array|min:1',
        ]);
        
        $playerIds = $request->input('playerIds');
                
        session(['playerIds' => $playerIds]);
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        return view('licence.renew')
                ->with(compact('categories'));
    }
    
    public function renewDisplay() {
                
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        return view('licence.renew')
                ->with(compact('categories'));
    }
    
    public function storeAll(Request $request) {
                
        $request->validate([
            'category' => 'bail|required|integer',
            'starts_at' => 'bail|required|date',
            'ends_at' => 'bail|required|date',
        ]);
        
        $club = Club::findDefaultClub();
        
        $categoryId = $request->input('category');
        
        $category = Category::find($categoryId);
        
        $playerIds = session('playerIds');
        
        foreach ($playerIds as $playerId) {
            
            $alreadyExistingLicences = Licence::where([
                ['category_id', '=', $categoryId],
                ['club_id', '=', $club->id],
                ['player_id', '=', $playerId],
            ])->get();
            
            if ($alreadyExistingLicences->isEmpty()) {      
                
                $licence = new Licence();
                
                $player = Player::find($playerId);
                
                $licence->club()->associate($club);
                
                $licence->category()->associate($category);
                
                $licence->player()->associate($player);
                
                $licence->starts_at = $request->input('starts_at');
                
                $licence->ends_at = $request->input('ends_at');
                
                $licence->paid = false;
                
                $licence->save();
            }
        }
        
        $request->session()->flash('renew_message_ok', 'Licences renouvelées');
        
        return redirect()->route('licences');
    }
}