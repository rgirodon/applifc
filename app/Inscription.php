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



    public static function boot() {

        parent::boot();

        Inscription::deleting(function($inscription) {

            $inscription->categories()->detach();
        });
    }
    

    public function getJoinedCategories() {
        
        return $this->categories()
                    ->select('label')
                    ->get()
                    ->implode('label', ' ');
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
}
