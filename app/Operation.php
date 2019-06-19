<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    public function club() {
        
        return $this->belongsTo('App\Club');
    }
    
    public function actions() {
        
        return $this->hasMany('App\OperationAction')->join('players','operation_actions.player_id', '=', 'players.id')->orderBy('players.lastname')->orderBy('players.firstname');
    }
    
    public static function boot() {
        
        parent::boot();
        
        Operation::deleting(function($operation) {
            
            $actions = $operation->actions()->get();
            
            foreach($actions as $action) {
                
                $action->delete();
            }
        });
    }
    
    public static function retrieveoperationsForDefaultClub() {
        
        $operations = Operation::whereHas('club',
            
            function ($query) {
                
                $query->where('id', '=', Club::findDefaultClubId());
            }
        )
        ->orderBy('label')
        ->get();
        
        return $operations;
    }
}
