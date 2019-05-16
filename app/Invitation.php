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
    
    public static function boot() {
        
        parent::boot();
        
        Invitation::deleting(function($invitation) {
            
            $invitation->categories()->detach();
        });
    }
    
    public function isForCategory($categoryId) {
        
        $result = false;
        
        $categories = $this->categories()->get();
        
        foreach($categories as $category) {
            
            if ($category->id == $categoryId) {
                
                $result = true;
                break;
            }
        }
        
        return $result;
    }
    
    public function getJoinedCategories() {
        
        return $this->categories()
                            ->select('label')
                            ->get()
                            ->implode('label', ' ');
    }
}
