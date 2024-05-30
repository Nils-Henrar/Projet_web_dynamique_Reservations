<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IsMemberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        Log::info('IsMemberMiddleware: checking if user is member');


        if (!Auth::check()) { //permet de vérifier si l'utilisateur est connecté

            Log::info('IsMemberMiddleware: user is not logged in');

            return redirect()->route('login')->with('error', 'You have to be logged in to access the page');
        }

        if (Auth::user()->roles->contains('role', 'member') === false) { //permet de vérifier si l'utilisateur est un member

            Log::info('IsMemberMiddleware: user is not member');

            return redirect()->route('home')->with('error', 'You do not have permission to access the page');
        }

        Log::info(' MemberMiddleware: user is member');


        return $next($request);
    }
}
