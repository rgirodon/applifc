<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    public static function findDefaultClub() {
        
        return Club::find(self::findDefaultClubId());
    }
    
    public static function findDefaultClubId() {
        
        return session('DEFAULT_CLUB_ID');
    }
}
