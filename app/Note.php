<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{    
    public function player() {
        
        return $this->belongsTo('App\Player');
    }
    
    public function coach() {
        
        return $this->belongsTo('App\Coach');
    }
}
