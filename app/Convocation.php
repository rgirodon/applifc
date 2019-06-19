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
        
        return $this->belongsToMany('App\Player', 'convocations_players')->orderBy('lastname')->orderBy('firstname');
    }
    
    public function categories() {
        
        return $this->belongsToMany('App\Category', 'convocations_categories');
    }
    
    public static function boot() {
        
        parent::boot();
        
        Convocation::deleting(function($convocation) {
            
            $convocation->players()->detach();
            
            $convocation->categories()->detach();
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
    
    public static function retrieveConvocationsForDefaultClub($dateDebut, $dateFin, $coachId = false, $categoryId = false) {
        
        $convocations = Convocation::whereHas('club',
            
            function ($query) {
                
                $query->where('id', '=', Club::findDefaultClubId());
            }
        );
        
        if ($coachId) {
            
            $convocations = $convocations
                                ->whereHas('coach', 
                                    function ($query) use($coachId) {
                                        
                                        $query->where('id', '=', $coachId);
                                    });
        }
        
        if ($categoryId) {
            
            $convocations = $convocations
                                ->whereHas('categories',
                                    function ($query) use($categoryId) {
                                        
                                        $query->where('categories.id', '=', $categoryId);
                                    });
        }
        
        $convocations = $convocations
                            ->where([
                                ['date_convocation', '>=', $dateDebut],
                                ['date_convocation', '<=', $dateFin]
                            ])
                            ->orderBy('date_convocation', 'asc')
                            ->get();
        
        return $convocations;
    }
}
