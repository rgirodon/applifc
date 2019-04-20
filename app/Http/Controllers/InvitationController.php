<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invitation;
use Carbon\Carbon;
use App\Category;

class InvitationController extends Controller
{
    public function index() {
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $invitations =  Invitation::where([
            ['date_competition', '>=', Carbon::now()->subDay(1)],
            ['club_id', '=', env('DEFAULT_CLUB_ID')],
        ])
        ->orderBy('date_competition')
        ->get();
        
        return view('invitations')
                ->with(compact('invitations', 'categories'));
    }
    
    public function findByCategory($categoryId) {
        
        $selectedCategory = Category::find($categoryId);
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $invitations =  Invitation::where([
            ['date_competition', '>=', Carbon::now()->subDay(1)]
        ])
        ->whereHas('categories',
            
            function ($query) use ($categoryId) {
                
                $query->where('categories.id', '=', $categoryId);
            }
         )
        ->orderBy('date_competition')
        ->get();
        
        return view('invitations')
                ->with(compact('invitations', 'categories', 'selectedCategory'));
    }
    
    public function show($id) {
        
        $invitation = Invitation::find($id);
        
        return view('invitation')
                ->with(compact('invitation'));
    }
}
