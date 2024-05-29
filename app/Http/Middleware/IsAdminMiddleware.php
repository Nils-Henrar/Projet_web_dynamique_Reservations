<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // if ($request->is('admin') || $request->is('admin/*')) { //permet de vérifier si la requête est pour la page admin ou une sous-page admin 

        // Log::info('IsAdminMiddleware: checking if user is admin');


        if (!Auth::check()) { //permet de vérifier si l'utilisateur est connecté

            Log::info('IsAdminMiddleware: user is not logged in');

            return redirect()->route('login')->with('error', 'You have to be logged in to access the page');
        }

        if (Auth::user()->roles->contains('role', 'admin') === false) { //permet de vérifier si l'utilisateur est un admin

            Log::info('IsAdminMiddleware: user is not admin');

            return redirect()->route('home')->with('error', 'You do not have permission to access the page');
        }
        // }

        Log::info('IsAdminMiddleware: user is admin');


        return $next($request);
    }
}
