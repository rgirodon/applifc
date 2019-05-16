<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    public function club() {
        
        return $this->belongsTo('App\Club');
    }
    
    public function invitation() {
        
        return $this->belongsTo('App\Invitation');
    }
    
    public function categories() {
        
        return $this->belongsToMany('App\Category', 'inscriptions_categories');
    }
    
    public function getJoinedCategories() {
        
        return $this->categories()
                    ->select('label')
                    ->get()
                    ->implode('label', ' ');
    }
}
