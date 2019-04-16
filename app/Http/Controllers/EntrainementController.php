<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entrainement;
use Carbon\Carbon;
use App\Coach;

class EntrainementController extends Controller
{
    public function index() {
        
        $dateDebut = Carbon::now()->subWeek(2);
        
        $dateFin = Carbon::now()->addWeek(2);
        
        $entrainements = Entrainement::retrieveEntrainementsForDefaultClub($dateDebut, $dateFin);
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        return view('entrainements')->with(compact('entrainements', 'coachs'));
    }
    
    public function show($id) {
        
        $entrainement = Entrainement::find($id);
            
        return view('entrainement')
                ->with(compact('entrainement'));
    }
    
    public function findByCoach($coachId) {
        
        $dateDebut = Carbon::now()->subWeek(2);
        
        $dateFin = Carbon::now()->addWeek(2);
        
        $entrainements = Entrainement::retrieveEntrainementsForDefaultClub($dateDebut, $dateFin, $coachId);
        
        $selectedCoach = Coach::find($coachId);
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        return view('entrainements')->with(compact('entrainements', 'coachs', 'selectedCoach'));
    }
}
