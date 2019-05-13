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
        
        return $this->belongsToMany('App\Player', 'entrainements_players');
    }
    
    public function categories() {
        
        return $this->belongsToMany('App\Category', 'entrainements_categories');
    }
    
    public function getJoinedCategories() {
        
        return $this->categories()
        ->select('label')
        ->get()
        ->implode('label', ' ');
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
                            ->get();
        
        return $entrainements;
    }
}
