<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Player extends Model
{
    public function club() {
        
        return $this->belongsTo('App\Club');
    }    
    
    public function licences() {
        
        return $this->hasMany('App\Licence');
    }
    
    
    public function getCurrentLicence() {
        
        $currentLicence = $this->licences()->where([
                                        ['starts_at', '<=', Carbon::now()],
                                        ['ends_at', '>', Carbon::now()],
                                    ])
                                    ->first();
        
        return $currentLicence;
    }


    public function getFullName() {

        return $this->firstname.' '.$this->lastname;
    }
}



