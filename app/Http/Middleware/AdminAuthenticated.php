<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Veuillez vous connecter pour accéder à l\'administration.');
        }

        return $next($request);
    }
}
