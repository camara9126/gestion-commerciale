<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEntrepriseExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user =$request->user();
        if($user && $user->entreprise_id === null)
        {
            if(! $request->routeIs('entreprise.create', 'entreprise.store')) {
                return redirect()->route('entreprise.create');
            }
        }
        return $next($request);
    }
}
