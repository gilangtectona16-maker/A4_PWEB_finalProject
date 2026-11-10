<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureLoggedIn
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('logged_in') || !session('user')) {
            return redirect('/login');
        }

        return $next($request);
    }
}
