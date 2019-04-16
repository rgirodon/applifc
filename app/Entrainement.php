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
    
    public static function retrieveEntrainementsForDefaultClub($dateDebut, $dateFin, $coachId = false) {
        
        $entrainements = Entrainement::whereHas('club',
            
            function ($query) {
                
                $query->where('id', '=', env('DEFAULT_CLUB_ID'));
            }
        );
        
        if ($coachId) {
            
            $entrainements = $entrainements
                                ->whereHas('coach', 
                                    function ($query) use($coachId) {
                                        
                                        $query->where('id', '=', $coachId);
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
