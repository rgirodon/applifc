<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $table = 'coachs';
    
    public function club() {
        
        return $this->belongsTo('App\Club');
    }
    
    public static function retrieveCoachsForDefaultClub() {
        
        $coachs =  Coach::whereHas('club',
            
            function ($query) {
                
                $query->where('id', '=', env('DEFAULT_CLUB_ID'));
            }
            )->get();
            
            return $coachs;
    }
    
    public function getFullName() {
        
        return $this->firstname.' '.$this->lastname;
    }
}
