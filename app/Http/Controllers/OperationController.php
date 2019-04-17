<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operation;

class OperationController extends Controller
{
    public function index() {
        
        $operations = Operation::retrieveOperationsForDefaultClub();
        
        return view('operations')->with('operations', $operations);
    }
    
    public function show($id) {
        
        $operation = Operation::find($id);
        
        return view('operation')
                ->with(compact('operation'));
    }
}
