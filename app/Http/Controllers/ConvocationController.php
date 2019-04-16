<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Convocation;
use App\Coach;

class ConvocationController extends Controller
{
    public function index() {
        
        $dateDebut = Carbon::now()->subDay(1);
        
        $dateFin = Carbon::now()->addWeek(2);
        
        $convocations = Convocation::retrieveConvocationsForDefaultClub($dateDebut, $dateFin);
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        return view('convocations')->with(compact('convocations', 'coachs'));
    }
    
    public function show($id) {
        
        $convocation = Convocation::find($id);
        
        return view('convocation')
        ->with(compact('convocation'));
    }
    
    public function findByCoach($coachId) {
        
        $dateDebut = Carbon::now()->subDay(1);
        
        $dateFin = Carbon::now()->addWeek(2);
        
        $convocations = Convocation::retrieveConvocationsForDefaultClub($dateDebut, $dateFin, $coachId);
        
        $selectedCoach = Coach::find($coachId);
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        return view('convocations')->with(compact('convocations', 'coachs', 'selectedCoach'));
    }
}
