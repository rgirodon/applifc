<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    
    public function club() {
        
        return $this->belongsTo('App\Club');
    }
    
    public static function retrieveCategoriesForDefaultClub() {
        
        $categories = Category::whereHas('club',
            
            function ($query) {
                
                $query->where('id', '=', Club::findDefaultClubId());
            }
        )
        ->orderBy('starts_at', 'desc')
        ->get();
        
        return $categories;
    }
}
