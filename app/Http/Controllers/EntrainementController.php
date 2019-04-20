<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entrainement;
use Carbon\Carbon;
use App\Coach;
use App\Category;

class EntrainementController extends Controller
{
    public function index() {
        
        $dateDebut = Carbon::now()->subWeek(2);
        
        $dateFin = Carbon::now()->addWeek(2);
        
        $entrainements = Entrainement::retrieveEntrainementsForDefaultClub($dateDebut, $dateFin);
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        return view('entrainements')->with(compact('entrainements', 'coachs', 'categories'));
    }
    
    public function show($id) {
        
        $entrainement = Entrainement::find($id);
            
        return view('entrainement')
                ->with(compact('entrainement'));
    }
    
    public function findByCoach($coachId) {
        
        $dateDebut = Carbon::now()->subWeek(2);
        
        $dateFin = Carbon::now()->addWeek(2);
        
        $entrainements = Entrainement::retrieveEntrainementsForDefaultClub($dateDebut, $dateFin, $coachId, false);
        
        $selectedCoach = Coach::find($coachId);
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        return view('entrainements')->with(compact('entrainements', 'coachs', 'selectedCoach', 'categories'));
    }
    
    public function findByCategory($categoryId) {
        
        $dateDebut = Carbon::now()->subWeek(2);
        
        $dateFin = Carbon::now()->addWeek(2);
        
        $entrainements = Entrainement::retrieveEntrainementsForDefaultClub($dateDebut, $dateFin, false, $categoryId);
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $selectedCategory = Category::find($categoryId);
        
        return view('entrainements')->with(compact('entrainements', 'coachs', 'categories', 'selectedCategory'));
    }
}
