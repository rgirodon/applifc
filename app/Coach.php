<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

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
    
    public function sendPasswordResetNotification($token) {
        
        $this->notify(new CustomPasswordResetEmail($token));
    }
}

class CustomPasswordResetEmail extends ResetPassword {
    
    public function toMail($notifiable)
    {
        return (new MailMessage())
        ->subject(env('APP_NAME').' - Réinitialisation de mot de passe')
        ->line('Nous vous envoyons ce mail car nous avons reçu de votre part une demande de réinitialisation de mot de passe.')
        ->action('Réinitialiser le mot de passe', url(config('app.url') . route('password.reset', $this->token, false)))
        ->line('Si vous n\'avez pas demandé de réinitialisation de mot de passe, aucune action n\'est requise.');
    }
}
