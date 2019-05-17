<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operation;
use App\Club;
use App\OperationAction;
use App\Player;

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
    
    public function destroyAction(Request $request, $id)
    {

        $action = OperationAction::find($id);
        
        $action->delete();
        
        $request->session()->flash('action_message_ok', 'Action supprimée');
        
        return redirect()->route('operation', $action->operation->id);
    }
    
    public function editAction($id)
    {
        $action = OperationAction::find($id);
        
        return view('action.edit')->with('action', $action);
    }
    
    public function updateAction(Request $request, $id)
    {
        $request->validate([
            'amount' => 'bail|nullable|numeric|min:0'
        ]);
        
        $action = OperationAction::find($id);
        
        $action->amount = $request->input('amount');
        
        $action->comments = $request->input('comments');
        
        $action->save();
        
        return redirect()->route('operation', $action->operation->id);
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
    
    public function addAction(Request $request, $id) {
        
        $request->validate([
            'playerId' => 'bail|required|integer'
        ]);
        
        $playerId = $request->input('playerId');
                
        $alreadyExistingActions = OperationAction::where([
            ['operation_id', '=', $id],
            ['player_id', '=', $playerId]
            ])->get();
            
        if ($alreadyExistingActions->isEmpty()) {
            
            $operation = Operation::find($id);
            
            $player = Player::find($playerId);
            
            $action = new OperationAction();
            
            $action->player()->associate($player);
            
            $action->operation()->associate($operation);
            
            $action->save();
        }
        
        return redirect()->route('operation', $id);
    }
}
