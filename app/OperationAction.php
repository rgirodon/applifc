<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperationAction extends Model
{
    protected $table = 'operation_actions';
    
    public function operation() {
        
        return $this->belongsTo('App\Operation');
    }
    
    public function player() {
        
        return $this->belongsTo('App\Player');
    }
}
