<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Club;

class ClubController extends Controller
{
    public function default() {
        
        $club = Club::findDefaultClub();
        
        return $club;
    }
}
