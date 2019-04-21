<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Coach extends Authenticatable
{
    use Notifiable;
    
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
