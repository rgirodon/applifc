<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrainement extends Model
{
    public function club() {
        
        return $this->belongsTo('App\Club');
    }
    
    public function coach() {
        
        return $this->belongsTo('App\Coach');
    }
    
    public function players() {
        
        return $this->belongsToMany('App\Player', 'entrainements_players')->orderBy('lastname')->orderBy('firstname');
    }
    
    public function categories() {
        
        return $this->belongsToMany('App\Category', 'entrainements_categories');
    }

    public static function boot() {

        parent::boot();

        Entrainement::deleting(function($entrainement) {

            $entrainement->players()->detach();

            $entrainement->categories()->detach();
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
    
    public static function retrieveEntrainementsForDefaultClub($dateDebut, $dateFin, $coachId = false, $categoryId = false) {
        
        $entrainements = Entrainement::whereHas('club',
            
            function ($query) {
                
                $query->where('id', '=', Club::findDefaultClubId());
            }
        );
        
        if ($coachId) {
            
            $entrainements = $entrainements
                                ->whereHas('coach', 
                                    function ($query) use($coachId) {
                                        
                                        $query->where('id', '=', $coachId);
                                    });
        }
        
        if ($categoryId) {
            
            $entrainements = $entrainements
                                ->whereHas('categories',
                                    function ($query) use($categoryId) {
                                        
                                        $query->where('categories.id', '=', $categoryId);
                                    });
        }
        
        $entrainements = $entrainements
                            ->where([
                                ['date_entrainement', '>=', $dateDebut],
                                ['date_entrainement', '<=', $dateFin]
                            ])
                            ->orderBy('date_entrainement', 'asc')
                            ->get();
        
        return $entrainements;
    }
}
