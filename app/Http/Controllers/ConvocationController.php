<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Convocation;
use App\Coach;
use App\Category;
use Illuminate\Support\Facades\Auth;
use App\Club;
use App\Player;

class ConvocationController extends Controller
{
    public function index() {
        
        $convocations = $this->retrieveConvocations(false, false);
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        return view('convocation.list')->with(compact('convocations', 'coachs', 'categories'));
    }
    
    public function api_index() {
                
        $convocationsForJson = [];
        
        $convocations = $this->retrieveConvocations(false, false);
        
        foreach ($convocations as $convocation) {
            
            $convocationsForJson[] = [
                'id' => $convocation->id,
                'date' => $convocation->date_convocation,
                'categories' => $convocation->getJoinedCategories(),
                'coach' => $convocation->coach->getFullName(),
                'heure_/_lieu' => $convocation->heure_lieu,
                'description' => $convocation->description,
                'commentaires' => $convocation->comments                
            ];
        }
        
        return response()->json($convocationsForJson);
    }
    
    public function retrieveConvocations($coachId, $categoryId) {
        
        $dateDebut = Carbon::now()->subDay(1);
        
        $dateFin = Carbon::now()->addWeek(2);
        
        $convocations = Convocation::retrieveConvocationsForDefaultClub($dateDebut, $dateFin, $coachId, $categoryId);
        
        return $convocations;
    }
    
    public function show($id) {
        
        $convocation = Convocation::find($id);
        
        return view('convocation.view')
                ->with(compact('convocation'));
    }
    
    public function api_show($convocationId) {
        
        $convocation = Convocation::find($convocationId);
        
        return $convocation;
    }
    
    public function findByCoach($coachId) {
        
        $convocations = $this->retrieveConvocations($coachId, false);
        
        $selectedCoach = Coach::find($coachId);
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        return view('convocation.list')->with(compact('convocations', 'coachs', 'selectedCoach', 'categories'));
    }
    
    public function api_findByCoach($coachId) {
        
        $convocationsForJson = [];
        
        $convocations = $this->retrieveConvocations($coachId, false);
        
        foreach ($convocations as $convocation) {
            
            $convocationsForJson[] = [
                'date' => $convocation->date_convocation,
                'categories' => $convocation->getJoinedCategories(),
                'coach' => $convocation->coach->getFullName(),
                'heure_/_lieu' => $convocation->heure_lieu,
                'description' => $convocation->description,
                'commentaires' => $convocation->comments
            ];
        }
        
        return response()->json($convocationsForJson);
    }
    
    public function findByCategory($categoryId) {
        
        $convocations = $this->retrieveConvocations(false, $categoryId);
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $selectedCategory = Category::find($categoryId);
        
        return view('convocation.list')->with(compact('convocations', 'coachs', 'categories', 'selectedCategory'));
    }
    
    public function api_findByCategory($categoryId) {
        
        $convocationsForJson = [];
        
        $convocations = $this->retrieveConvocations(false, $categoryId);
        
        foreach ($convocations as $convocation) {
            
            $convocationsForJson[] = [
                'date' => $convocation->date_convocation,
                'categories' => $convocation->getJoinedCategories(),
                'coach' => $convocation->coach->getFullName(),
                'heure_/_lieu' => $convocation->heure_lieu,
                'description' => $convocation->description,
                'commentaires' => $convocation->comments
            ];
        }
        
        return response()->json($convocationsForJson);
    }
    
    public function destroy(Request $request, $id) {
                
        try {
            $convocation = Convocation::find($id);
            
            $convocation->delete();
            
            $request->session()->flash('delete_message_ok', 'Convocation supprimée');
        }
        catch(\Exception $exception) {
            
            $request->session()->flash('delete_message_ko', 'Impossible de supprimer cette convocation');
        }
        
        return redirect()->route('convocations');
    }
    
    public function create() {
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $coach = Auth::user();
        
        return view('convocation.create')
                ->with(compact('categories', 'coach'));
    }
    
    public function edit($id) {
        
        $convocation = Convocation::find($id);
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $coach = Auth::user();
        
        return view('convocation.edit')
                ->with(compact('convocation', 'categories', 'coach'));
    }
    
    public function update(Request $request, $id) {
        
        $request->validate([
            'categoryIds' => 'bail|required|array|min:1',
            'coach' => 'bail|required|integer',
            'date_convocation' => 'bail|required|date',
            'description' => 'bail|required',
            'heure_lieu' => 'bail|required',
        ]);
        
        $coach = Coach::find($request->input('coach'));
        
        $convocation = Convocation::find($id);
        
        $convocation->coach()->associate($coach);
        
        $convocation->date_convocation = $request->input('date_convocation');
        
        $convocation->description = $request->input('description');
        
        $convocation->heure_lieu = $request->input('heure_lieu');

        $convocation->comments = $request->input('comments');
        
        $convocation->save();
                
        $categories = $convocation->categories()->get();
         
        foreach($categories as $category) {
        
            $convocation->categories()->detach($category);
        }
        
        $categoryIds = $request->input('categoryIds');
        
        foreach ($categoryIds as $categoryId) {
            
            $convocation->categories()->attach($categoryId);
        }
        
        return redirect()->route('convocation', $convocation->id);
    }
    
    public function store(Request $request) {
        
        $request->validate([
            'categoryIds' => 'bail|required|array|min:1',
            'coach' => 'bail|required|integer',
            'date_convocation' => 'bail|required|date',
            'description' => 'bail|required',
            'heure_lieu' => 'bail|required',
        ]);
        
        $club = Club::findDefaultClub();
        
        $coach = Coach::find($request->input('coach'));        

        $convocation = new Convocation();
        
        $convocation->club()->associate($club);
        
        $convocation->coach()->associate($coach);
         
        $convocation->date_convocation = $request->input('date_convocation');
        
        $convocation->description = $request->input('description');

        $convocation->comments = $request->input('comments');
        
        $convocation->heure_lieu = $request->input('heure_lieu');
        
        $convocation->save();
        
        $categoryIds = $request->input('categoryIds');
        
        foreach ($categoryIds as $categoryId) {
            
            $convocation->categories()->attach($categoryId);
        }
        
        return redirect()->route('convocation', $convocation->id);
    }
    
    public function addPlayer(Request $request, $id) {
        
        $request->validate([
            'playerId' => 'bail|required|integer'
        ]);
        
        $playerId = $request->input('playerId');
                
        $alreadyExistingConvocation = Convocation::where('id', '=', $id)
                                                    ->whereHas('players',
                                                        function ($query) use($playerId) {
                                                                    
                                                            $query->where('players.id', '=', $playerId);
                                                                })
                                                    ->get();
        
         if ($alreadyExistingConvocation->isEmpty()) {
        
            $convocation = Convocation::find($id);
        
            $player = Player::find($playerId);
            
            $convocation->players()->attach($player);
        }
        
        return redirect()->route('convocation', $id);
    }
    
    public function deletePlayer(Request $request, $id, $playerId) {
        
        $convocation = Convocation::find($id);
        
        $player = Player::find($playerId);
        
        $convocation->players()->detach($player);
        
        return redirect()->route('convocation', $id);
    }
}
