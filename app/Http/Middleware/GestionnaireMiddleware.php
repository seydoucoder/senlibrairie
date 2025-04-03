<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GestionnaireMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'gestionnaire') {
            return redirect('/');
        }

        return $next($request);
    }
}