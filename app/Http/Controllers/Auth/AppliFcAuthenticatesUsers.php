<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait AppliFcAuthenticatesUsers {
    
    use AuthenticatesUsers;
    
    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $email = $request->input('email');
        
        $password = $request->input('password');
        
        return Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1], $request->filled('remember'));
    }
}

