<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operation;
use App\Club;

class OperationController extends Controller
{
    public function index() {
        
        $operations = Operation::retrieveOperationsForDefaultClub();
        
        return view('operation.list')->with('operations', $operations);
    }
    
    public function show($id) {
        
        $operation = Operation::find($id);
        
        return view('operation.view')
                ->with(compact('operation'));
    }
    
    public function edit($id)
    {
        $operation = Operation::find($id);
        
        return view('operation.edit')->with('operation', $operation);
    }
    
    
    public function create()
    {
        return view('operation.create');
    }
    
    public function destroy(Request $request, $id)
    {
        
        try {
            $operation = Operation::find($id);
            
            $operation->delete();
            
            $request->session()->flash('delete_message_ok', 'Opération supprimée');
        } 
        catch (\Exception $exception) {
            
            $request->session()->flash('delete_message_ko', 'Impossible de supprimer cette opération');
        }
        
        return redirect()->route('operations');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'bail|required|max:255'
        ]);
        
        $club = Club::findDefaultClub();
        
        $operation = new Operation();
        
        $operation->club()->associate($club);
        
        $operation->label = $request->input('label');
        
        $operation->save();
        
        return redirect()->route('operations');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'label' => 'bail|required|max:255'
        ]);
        
        $operation = Operation::find($id);
        
        $operation->label = $request->input('label');
        
        $operation->save();
        
        return redirect()->route('operations');
    }
}
