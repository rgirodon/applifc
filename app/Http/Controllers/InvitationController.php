<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invitation;
use Carbon\Carbon;
use App\Category;
use App\Club;

class InvitationController extends Controller
{
    public function index() {
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $invitations =  Invitation::where([
            ['date_competition', '>=', Carbon::now()->subDay(1)],
            ['club_id', '=', Club::findDefaultClubId()],
        ])
        ->orderBy('date_competition')
        ->get();
        
        return view('invitation.list')
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
        
        return view('invitation.list')
                ->with(compact('invitations', 'categories', 'selectedCategory'));
    }
    
    public function show($id) {
        
        $invitation = Invitation::find($id);
        
        return view('invitation.view')
                ->with(compact('invitation'));
    }
    
    public function destroy(Request $request, $id) {
        
        $invitation = Invitation::find($id);
            
        $invitation->delete();
            
        $request->session()->flash('delete_message_ok', 'Invitation supprimée');
        
        return redirect()->route('invitations');
    }
    
    public function create() {
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        return view('invitation.create')
                    ->with(compact('categories'));
    }
    
    public function store(Request $request) {
        
        $request->validate([
            'categoryIds' => 'bail|required|array|min:1',
            'date_competition' => 'bail|required|date',
            'date_limite_reponse' => 'bail|nullable|date',
            'libelle' => 'bail|required',
        ]);
        
        $club = Club::findDefaultClub();
        
        $invitation = new Invitation();
        
        $invitation->club()->associate($club);
        
        $invitation->date_competition = $request->input('date_competition');
        
        $invitation->date_limite_reponse = $request->input('date_limite_reponse');
        
        $invitation->libelle = $request->input('libelle');
        
        $invitation->comments = $request->input('comments');
        
        $reponse = $request->input('reponse');
        
        if ($reponse != '-') {
            $invitation->reponse = $reponse;
        }
        else {
            $invitation->reponse = null;
        }
        
        $invitation->save();
        
        $categoryIds = $request->input('categoryIds');
        
        foreach ($categoryIds as $categoryId) {
            
            $invitation->categories()->attach($categoryId);
        }
        
        return redirect()->route('invitation', $invitation->id);
    }
}
