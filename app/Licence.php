<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    public function club() {
        
        return $this->belongsTo('App\Club');
    }
    
    public function category() {
        
        return $this->belongsTo('App\Category');
    }
    
    public function player() {
        
        return $this->belongsTo('App\Player');
    }
}
