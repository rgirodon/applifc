<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    public function club() {
        
        return $this->belongsTo('App\Club');
    }
    
    public function actions() {
        
        return $this->hasMany('App\OperationAction');
    }
    
    public static function retrieveoperationsForDefaultClub() {
        
        $operations = Operation::whereHas('club',
            
            function ($query) {
                
                $query->where('id', '=', env('DEFAULT_CLUB_ID'));
            }
        )->get();
        
        return $operations;
    }
}
