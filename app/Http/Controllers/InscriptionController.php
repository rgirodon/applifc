<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Inscription;
use Carbon\Carbon;
use App\Club;



class InscriptionController extends Controller
{
    public function index() {
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $inscriptions = $this->retrieveInscriptions();
        
        return view('inscription.list')
                ->with(compact('inscriptions', 'categories'));
    }
    
    public function api_index() {

        $inscriptionsForJson = [];
        
        $inscriptions = $this->retrieveInscriptions();
        
        foreach ($inscriptions as $inscription) {
            
            $inscriptionsForJson[] = [
                'date_competition' => $inscription->date_competition,
                'categories' => $inscription->getJoinedCategories(),
                'libelle' => $inscription->libelle
            ];
        }
        
        return response()->json($inscriptionsForJson);
    }
    
    public function retrieveInscriptions() {
        
        $inscriptions =  Inscription::where([
            ['date_competition', '>=', Carbon::now()->subDay(1)],
            ['club_id', '=', Club::findDefaultClubId()],
        ])
        ->orderBy('date_competition')
        ->get();
        
        return $inscriptions;
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
        
        return view('inscription.list')
                ->with(compact('inscriptions', 'categories', 'selectedCategory'));
    }
    
    public function show($id) {
        
        $inscription = Inscription::find($id);
        
        return view('inscription.view')
                ->with(compact('inscription'));
    }

    public function destroy(Request $request, $id) {

        try {
            $inscription = Inscription::find($id);

            $inscription->delete();

            $request->session()->flash('action_message_ok', 'Inscription supprimée');
        }
        catch(\Exception $exception) {

            $request->session()->flash('action_message_ko', 'Impossible de supprimer cette inscription');
        }

        return redirect()->route('inscriptions');
    }

    public function create() {

        $categories = Category::retrieveCategoriesForDefaultClub();

        return view('inscription.create')
            ->with(compact('categories'));
    }

    public function store(Request $request) {

        $request->validate([
            'categoryIds' => 'bail|required|array|min:1',
            'date_competition' => 'bail|required|date',
            'libelle' => 'bail|required',
        ]);

        $club = Club::findDefaultClub();

        $inscription = new Inscription();

        $inscription->club()->associate($club);

        $inscription->date_competition = $request->input('date_competition');

        $inscription->libelle = $request->input('libelle');

        $inscription->comments = $request->input('comments');

        $inscription->save();

        $categoryIds = $request->input('categoryIds');

        foreach ($categoryIds as $categoryId) {

            $inscription->categories()->attach($categoryId);
        }

        return redirect()->route('inscription', $inscription->id);
    }

    public function edit($id) {

        $inscription = Inscription::find($id);

        $categories = Category::retrieveCategoriesForDefaultClub();

        return view('inscription.edit')
            ->with(compact('inscription', 'categories'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'categoryIds' => 'bail|required|array|min:1',
            'date_competition' => 'bail|required|date',
            'libelle' => 'bail|required',
        ]);

        $inscription = Inscription::find($id);

        $inscription->date_competition = $request->input('date_competition');

        $inscription->libelle = $request->input('libelle');

        $inscription->comments = $request->input('comments');

        $inscription->save();

        $categories = $inscription->categories()->get();

        foreach ($categories as $category) {

            $inscription->categories()->detach($category);
        }

        $categoryIds = $request->input('categoryIds');

        foreach ($categoryIds as $categoryId) {

            $inscription->categories()->attach($categoryId);
        }

        return redirect()->route('inscription', $inscription->id);
    }
}
