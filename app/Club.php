<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    public static function findDefaultClub() {
        
        return Club::find(env('DEFAULT_CLUB_ID'));
    }
}
