<?php

namespace App\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->id_role == 2 && $request->is('admin/dashboard')) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}