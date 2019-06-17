<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Licence;
use Carbon\Carbon;
use App\Category;
use App\Club;
use App\Player;
use Illuminate\Support\MessageBag;
class LicenceController extends Controller
{
    public function index() {

        $categories = Category::retrieveCategoriesForDefaultClub();

        $licences =  Licence::where([
            ['starts_at', '<=', Carbon::now()],
            ['ends_at', '>', Carbon::now()],
            ['club_id', '=', Club::findDefaultClubId()],
        ])->get();

        return view('licence.list')
            ->with(compact('licences', 'categories'));
    }
    public function findByCategory($categoryId) {

        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $selectedCategory = null;
        
        $licences = [];
        
        if ($categoryId != -1) {
            
            $selectedCategory = Category::find($categoryId);
    
            $licences =  Licence::where([
                ['category_id', '=', $categoryId],
                ['starts_at', '<=', Carbon::now()],
                ['ends_at', '>', Carbon::now()],
            ])->get();
        }
        else {            
            $selectedCategory = new Category();
            
            $selectedCategory->id = -1;
            
            $selectedCategory->label = 'Joueurs sans licence active';
            
            $players = Player::whereDoesntHave('licences',
                function ($query) {
                    $query->where([
                        ['starts_at', '<=', Carbon::now()],
                        ['ends_at', '>', Carbon::now()],
                        ['club_id', '=', Club::findDefaultClubId()],
                    ]);
                }
            )
            ->whereHas('licences',
                function ($query) {
                    $query->where([
                        ['club_id', '=', Club::findDefaultClubId()],
                    ]);
                }
            )
            ->get();
            
            foreach ($players as $player) {
                
                $licence = new Licence();
                
                $category = new Category();
                
                $category->id = -1;
                
                $category->label = 'Joueurs sans licence active';
                
                $licence->category = $category;
                
                $licence->player = $player;
                
                $licences[] = $licence;
            }
        }

        return view('licence.list')
            ->with(compact('licences', 'categories', 'selectedCategory'));
    }

    public function renew(Request $request) {

        $request->validate([
            'playerIds' => 'bail|required|array|min:1',
        ]);

        $playerIds = $request->input('playerIds');

        session(['playerIds' => $playerIds]);

        $categories = Category::retrieveCategoriesForDefaultClub();

        return view('licence.renew')
            ->with(compact('categories'));
    }

    public function renewDisplay() {

        $categories = Category::retrieveCategoriesForDefaultClub();

        return view('licence.renew')
            ->with(compact('categories'));
    }

    public function storeAll(Request $request) {

        $request->validate([
            'category' => 'bail|required|integer',
            'starts_at' => 'bail|required|date',
            'ends_at' => 'bail|required|date',
        ]);

        $club = Club::findDefaultClub();

        $categoryId = $request->input('category');

        $category = Category::find($categoryId);

        $playerIds = session('playerIds');

        foreach ($playerIds as $playerId) {

            $alreadyExistingLicences = Licence::where([
                ['category_id', '=', $categoryId],
                ['club_id', '=', $club->id],
                ['player_id', '=', $playerId],
            ])->get();

            if ($alreadyExistingLicences->isEmpty()) {

                $licence = new Licence();

                $player = Player::find($playerId);

                $licence->club()->associate($club);

                $licence->category()->associate($category);

                $licence->player()->associate($player);

                $licence->starts_at = $request->input('starts_at');

                $licence->ends_at = $request->input('ends_at');

                $licence->paid = false;

                $licence->save();
            }
        }

        $request->session()->flash('renew_message_ok', 'Licences renouvelées');

        return redirect()->route('licences');
    }

    public function destroy(Request $request, $id) {

        $licence = Licence::find($id);
        
        $player = $licence->player;
        
        if (count($player->licences) == 1) {
            
            $request->session()->flash('delete_message_ko', 'Impossible de supprimer cette licence, ce joueur se retrouverait sans licence');
        }
        else {
            $licence->delete();
    
            $request->session()->flash('delete_message_ok', 'Licence supprimée');
        }

        return redirect()->route('player', $licence->player->id);
    }

    public function edit($id) {

        $licence = Licence::find($id);

        $categories = Category::retrieveCategoriesForDefaultClub();

        return view('licence.edit')
            ->with(compact('licence', 'categories'));
    }

    public function update(Request $request, $id) {

        $request->validate([
            'category' => 'bail|required|integer',
            'starts_at' => 'bail|required|date',
            'ends_at' => 'bail|required|date',
            'paid' => 'bail|required',
        ]);

        $licence = Licence::find($id);

        $alreadyExistingLicences = Licence::where([
            ['category_id', '=', $request->input('category')],
            ['club_id', '=', $licence->club->id],
            ['player_id', '=', $licence->player->id],
            ['id', '!=', $id],
        ])->get();

        if ($alreadyExistingLicences->isEmpty()) {

            $category = Category::find($request->input('category'));

            $licence->category()->associate($category);

            $licence->starts_at = $request->input('starts_at');

            $licence->ends_at = $request->input('ends_at');

            $licence->paid = $request->input('paid');

            $licence->comments = $request->input('comments');

            $licence->save();
        }
        else {
            $errors = new MessageBag();

            $errors->add('already_existing_licence', 'Une licence existe déjà pour ce joueur dans cette catégorie');

            return redirect()->route('licence.edit', $id)
                ->withErrors($errors)
                ->withInput();
        }

        return redirect()->route('player', $licence->player->id);
    }

    public function create($playerId) {

        $player = Player::find($playerId);

        $categories = Category::retrieveCategoriesForDefaultClub();

        return view('licence.create')
            ->with(compact('categories', 'player'));
    }

    public function store(Request $request) {

        $request->validate([
            'category' => 'bail|required|integer',
            'player' => 'bail|required|integer',
            'starts_at' => 'bail|required|date',
            'ends_at' => 'bail|required|date',
        ]);

        $club = Club::findDefaultClub();

        $player = Player::find($request->input('player'));

        $alreadyExistingLicences = Licence::where([
            ['category_id', '=', $request->input('category')],
            ['club_id', '=', $club->id],
            ['player_id', '=', $player->id],
        ])->get();

        if ($alreadyExistingLicences->isEmpty()) {

            $licence = new Licence();

            $licence->club()->associate($club);

            $licence->player()->associate($player);

            $category = Category::find($request->input('category'));

            $licence->category()->associate($category);

            $licence->starts_at = $request->input('starts_at');

            $licence->ends_at = $request->input('ends_at');

            $licence->paid = false;

            $licence->save();
        }
        else {
            $errors = new MessageBag();

            $errors->add('already_existing_licence', 'Une licence existe déjà pour ce joueur dans cette catégorie');

            return redirect()->route('licence.create', $player->id)
                ->withErrors($errors)
                ->withInput();
        }

        return redirect()->route('player', $player->id);
    }
}