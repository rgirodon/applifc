<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Convocation;
use App\Coach;
use App\Category;

class ConvocationController extends Controller
{
    public function index() {
        
        $dateDebut = Carbon::now()->subDay(1);
        
        $dateFin = Carbon::now()->addWeek(2);
        
        $convocations = Convocation::retrieveConvocationsForDefaultClub($dateDebut, $dateFin);
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        return view('convocations')->with(compact('convocations', 'coachs', 'categories'));
    }
    
    public function show($id) {
        
        $convocation = Convocation::find($id);
        
        return view('convocation')
        ->with(compact('convocation'));
    }
    
    public function findByCoach($coachId) {
        
        $dateDebut = Carbon::now()->subDay(1);
        
        $dateFin = Carbon::now()->addWeek(2);
        
        $convocations = Convocation::retrieveConvocationsForDefaultClub($dateDebut, $dateFin, $coachId, false);
        
        $selectedCoach = Coach::find($coachId);
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        return view('convocations')->with(compact('convocations', 'coachs', 'selectedCoach', 'categories'));
    }
    
    public function findByCategory($categoryId) {
        
        $dateDebut = Carbon::now()->subDay(1);
        
        $dateFin = Carbon::now()->addWeek(2);
        
        $convocations = Convocation::retrieveConvocationsForDefaultClub($dateDebut, $dateFin, false, $categoryId);
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $selectedCategory = Category::find($categoryId);
        
        return view('convocations')->with(compact('convocations', 'coachs', 'categories', 'selectedCategory'));
    }
}
