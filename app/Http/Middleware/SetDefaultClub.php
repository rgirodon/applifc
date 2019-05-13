<?php

namespace App\Http\Middleware;

use Closure;
use App\Club;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SetDefaultClub
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $httpHost = $request->getHttpHost();
        
        $splittedHttpHost = explode(".", $httpHost, 2);
        
        $server = $splittedHttpHost[0];
        
        $defaultClub = Club::where('server', $server)->first();
        
        if ($defaultClub) {
            
            session(['DEFAULT_CLUB_ID' => $defaultClub->id]);
            
            $club = Club::findDefaultClub();
            
            View::share('club', $club);
        
            if (!Auth::check()) {
                
                return $next($request);
            }
            else {
                $user = Auth::user();
                
                if ($user->club->id == $defaultClub->id) {
                    
                    return $next($request);
                }
                else {
                    $request->session()->invalidate();
                    
                    return redirect('unauthorized');
                }
            }
        }
        else {
            abort(404);
        }
    }
}
