<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Coach;
use App\Club;

class CoachController extends Controller
{
    public function index()
    {

        $coachs = Coach::retrieveCoachsForDefaultClub();

        return view('coach.list')->with('coachs', $coachs);
    }

    public function show($id) {
        $coach = Coach::find($id);

        return view('coach.view')
            ->with(compact('coach'));
    }


    public function edit($id)
    {
        $coach = Coach::find($id);

        return view('coach.edit')->with('coach', $coach);
    }


    public function create()
    {
        return view('coach.create');
    }

    public function destroy(Request $request, $id)
    {

        try {
            $coach = Coach::find($id);

            $coach->delete();

            $request->session()->flash('delete_message_ok', 'Coach supprimé');
        } catch (\Exception $exception) {

            $request->session()->flash('delete_message_ko', 'Impossible de supprimer ce coach');
        }

        return redirect()->route('coachs');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'firstname' => 'bail|required|max:255',
            'lastname' => 'bail|required|max:255',
            'email' => 'bail|required|email',
        ]);

        $coach = Coach::find($id);

        $coach->firstname = $request->input('firstname');

        $coach->lastname = $request->input('lastname');

        $coach->email = $request->input('email');

        $coach->save();

        return redirect()->route('coachs');
    }


    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'bail|required|max:255',
            'lastname' => 'bail|required|max:255',
            'email' => 'bail|required|email',
        ]);

        $club = Club::findDefaultClub();

        $coach = new Coach();

        $coach->club()->associate($club);

        $coach->firstname = $request->input('firstname');

        $coach->lastname = $request->input('lastname');

        $coach->email = $request->input('email');

        $coach->password = env("DEFAULT_PASSWORD");

        $coach->save();

        return redirect()->route('coachs');
    }
    
    public function displayChangePassword() {
        
        return view('coach.password');
    }
}
