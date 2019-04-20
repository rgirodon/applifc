<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Inscription;
use Carbon\Carbon;

class InscriptionController extends Controller
{
    public function index() {
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $inscriptions =  Inscription::where([
            ['date_competition', '>=', Carbon::now()->subDay(1)],
            ['club_id', '=', env('DEFAULT_CLUB_ID')],
        ])
        ->orderBy('date_competition')
        ->get();
        
        return view('inscriptions')
        ->with(compact('inscriptions', 'categories'));
    }
    
    public function findByCategory($categoryId) {
        
        $selectedCategory = Category::find($categoryId);
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $inscriptions =  Inscription::where([
            ['date_competition', '>=', Carbon::now()->subDay(1)]
        ])
        ->whereHas('categories',
            
            function ($query) use ($categoryId) {
                
                $query->where('categories.id', '=', $categoryId);
            }
        )
        ->orderBy('date_competition')
        ->get();
        
        return view('inscriptions')
                ->with(compact('inscriptions', 'categories', 'selectedCategory'));
    }
    
    public function show($id) {
        
        $inscription = Inscription::find($id);
        
        return view('inscription')
                ->with(compact('inscription'));
    }
}
