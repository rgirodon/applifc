<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Licence;
use Carbon\Carbon;

class LicenceController extends Controller
{
    public function index() {
        
        $licences =  Licence::where([
            ['starts_at', '<=', Carbon::now()],
            ['ends_at', '>', Carbon::now()],
        ])->get();
        
        return view('licences')->with('licences', $licences);
    }
}
