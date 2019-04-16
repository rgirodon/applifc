<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convocation extends Model
{
    public function club() {
        
        return $this->belongsTo('App\Club');
    }
    
    public function coach() {
        
        return $this->belongsTo('App\Coach');
    }
    
    public function players() {
        
        return $this->belongsToMany('App\Player', 'convocations_players');
    }
    
    public static function retrieveConvocationsForDefaultClub($dateDebut, $dateFin, $coachId = false) {
        
        $convocations = Convocation::whereHas('club',
            
            function ($query) {
                
                $query->where('id', '=', env('DEFAULT_CLUB_ID'));
            }
        );
        
        if ($coachId) {
            
            $convocations = $convocations
                                ->whereHas('coach', 
                                    function ($query) use($coachId) {
                                        
                                        $query->where('id', '=', $coachId);
                                    });
        }
        
        $convocations = $convocations
                            ->where([
                                ['date_convocation', '>=', $dateDebut],
                                ['date_convocation', '<=', $dateFin]
                            ])
                            ->get();
        
        return $convocations;
    }
}
