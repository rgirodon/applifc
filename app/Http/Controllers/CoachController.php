<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Coach;

class CoachController extends Controller
{
    public function index() {
        
        $coachs = Coach::retrieveCoachsForDefaultClub();
        
        return view('coachs')->with('coachs', $coachs);
    }


public function show($id) {

    $coach = Coach::find($id);

    return view('coach')
            ->with(compact('coach'));
}
}