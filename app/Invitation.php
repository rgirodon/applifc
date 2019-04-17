<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    public function club() {
        
        return $this->belongsTo('App\Club');
    }
    
    public function categories() {
        
        return $this->belongsToMany('App\Category', 'invitations_categories');
    }
    
    public function getJoinedCategories() {
        
        return $this->categories()
                            ->select('label')
                            ->get()
                            ->implode('label', ' ');
    }
}
