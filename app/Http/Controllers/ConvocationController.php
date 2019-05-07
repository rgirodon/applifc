<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Convocation;
use App\Coach;
use App\Category;
use Illuminate\Support\Facades\Auth;
use App\Club;

class ConvocationController extends Controller
{
    public function index() {
        
        $dateDebut = Carbon::now()->subDay(1);
        
        $dateFin = Carbon::now()->addWeek(2);
        
        $convocations = Convocation::retrieveConvocationsForDefaultClub($dateDebut, $dateFin);
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        return view('convocation.list')->with(compact('convocations', 'coachs', 'categories'));
    }
    
    public function show($id) {
        
        $convocation = Convocation::find($id);
        
        return view('convocation.view')
                ->with(compact('convocation'));
    }
    
    public function findByCoach($coachId) {
        
        $dateDebut = Carbon::now()->subDay(1);
        
        $dateFin = Carbon::now()->addWeek(2);
        
        $convocations = Convocation::retrieveConvocationsForDefaultClub($dateDebut, $dateFin, $coachId, false);
        
        $selectedCoach = Coach::find($coachId);
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        return view('convocation.list')->with(compact('convocations', 'coachs', 'selectedCoach', 'categories'));
    }
    
    public function findByCategory($categoryId) {
        
        $dateDebut = Carbon::now()->subDay(1);
        
        $dateFin = Carbon::now()->addWeek(2);
        
        $convocations = Convocation::retrieveConvocationsForDefaultClub($dateDebut, $dateFin, false, $categoryId);
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $selectedCategory = Category::find($categoryId);
        
        return view('convocation.list')->with(compact('convocations', 'coachs', 'categories', 'selectedCategory'));
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
        
        $convocation->heure_lieu = $request->input('heure_lieu');
        
        $convocation->save();
        
        $categoryIds = $request->input('categoryIds');
        
        foreach ($categoryIds as $categoryId) {
            
            $convocation->categories()->attach($categoryId);
        }
        
        return redirect()->route('convocation', $convocation->id);
    }
}
