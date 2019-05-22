<?php

namespace App\Http\Controllers;

use App\Entrainement;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Category;
use Illuminate\Support\Facades\Auth;
use App\Club;
use App\Player;
use App\Coach;

class EntrainementController extends Controller
{
    public function index() {

        $dateDebut = Carbon::now()->subDay(1);

        $dateFin = Carbon::now()->addWeek(2);

        $entrainements = Entrainement::retrieveEntrainementsForDefaultClub($dateDebut, $dateFin);

        $coachs = Coach::retrieveCoachsForDefaultClub();

        $categories = Category::retrieveCategoriesForDefaultClub();

        return view('entrainement.list')->with(compact('entrainements', 'coachs', 'categories'));
    }

    public function show($id) {

        $entrainement = Entrainement::find($id);

        return view('entrainement.view')
            ->with(compact('entrainement'));
    }

    public function findByCoach($coachId) {

        $dateDebut = Carbon::now()->subDay(1);

        $dateFin = Carbon::now()->addWeek(2);

        $entrainements = Entrainement::retrieveEntreprisesForDefaultClub($dateDebut, $dateFin, $coachId, false);

        $selectedCoach = Coach::find($coachId);

        $coachs = Coach::retrieveCoachsForDefaultClub();

        $categories = Category::retrieveCategoriesForDefaultClub();

        return view('entrainement.list')->with(compact('entrainements', 'coachs', 'selectedCoach', 'categories'));
    }

    public function findByCategory($categoryId) {

        $dateDebut = Carbon::now()->subDay(1);

        $dateFin = Carbon::now()->addWeek(2);

        $entrainements = Entrainement::retrieveEntrainementsForDefaultClub($dateDebut, false, $categoryId);

        $coachs = Coach::retrieveCoachsForDefaultClub();

        $categories = Category::retrieveCategoriesForDefaultClub();

        $selectedCategory = Category::find($categoryId);

        return view('entrainement.liste')->with(compact('entrainements', 'coachs', 'categories', 'selectedCategory'));
    }

    public function destroy(Request $request, $id) {

        try {
            $entrainement = Entrainement::find($id);

            $entrainement->delete();

            $request->session()->flash('delete_message_ok', 'Entrainement supprimé');
        }
        catch(\Exception $exception) {

            $request->session()->flash('delete_message_ko', 'Impossible de supprimer cet entrainement');
        }

        return redirect()->route('entrainements');
    }

    public function create() {

        $categories = Category::retrieveCategoriesForDefaultClub();

        $coach = Auth::user();

        return view('entrainement.create')
            ->with(compact('categories', 'coach'));
    }

    public function edit($id) {

        $entrainement = Entrainement::find($id);

        $categories = Category::retrieveCategoriesForDefaultClub();

        $coach = Auth::user();

        return view('entrainement.edit')
            ->with(compact('entrainement', 'categories', 'coach'));
    }

    public function update(Request $request, $id) {

        $request->validate([
            'categoryIds' => 'bail|required|array|min:1',
            'coach' => 'bail|required|integer',
            'date_entrainement' => 'bail|required|date',
        ]);

        $coach = Coach::find($request->input('coach'));

        $entrainement = Entrainement::find($id);

        $entrainement->coach()->associate($coach);

        $entrainement->date_entrainement = $request->input('date_entrainement');

        $entrainement->comments= $request->input('comments');

        $entrainement->save();

        $categories = $entrainement->categories()->get();

        foreach($categories as $category) {

            $entrainement->categories()->detach($category);
        }

        $categoryIds = $request->input('categoryIds');

        foreach ($categoryIds as $categoryId) {

            $entrainement->categories()->attach($categoryId);
        }

        return redirect()->route('entrainement', $entrainement->id);
    }

    public function store(Request $request) {

        $request->validate([
            'categoryIds' => 'bail|required|array|min:1',
            'coach' => 'bail|required|integer',
            'date_entrainement' => 'bail|required|date',
        ]);

        $club = Club::findDefaultClub();

        $coach = Coach::find($request->input('coach'));

        $entrainement = new Entrainement();

        $entrainement->club()->associate($club);

        $entrainement->coach()->associate($coach);

        $entrainement->date_entrainement = $request->input('date_entrainement');

        $entrainement->comments= $request->input('comments');

        $entrainement->save();

        $categoryIds = $request->input('categoryIds');

        foreach ($categoryIds as $categoryId) {

            $entrainement->categories()->attach($categoryId);
        }

        return redirect()->route('entrainement', $entrainement->id);
    }

    public function addPlayer(Request $request, $id) {

        $request->validate([
            'playerId' => 'bail|required|integer'
        ]);

        $playerId = $request->input('playerId');

        $alreadyExistingEntrainement = Entrainement::where('id', '=', $id)
            ->whereHas('players',
                function ($query) use($playerId) {

                    $query->where('players.id', '=', $playerId);
                })
            ->get();

        if ($alreadyExistingEntrainement->isEmpty()) {

            $entrainement = Entrainement::find($id);

            $player = Player::find($playerId);

            $entrainement->players()->attach($player);
        }

        return redirect()->route('entrainement', $id);
    }

    public function deletePlayer(Request $request, $id, $playerId) {

        $entrainement = Entrainement::find($id);

        $player = Player::find($playerId);

        $entrainement->players()->detach($player);

        return redirect()->route('entrainement', $id);
    }
}
