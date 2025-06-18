<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Jika user sudah login dan mencoba akses '/' atau menekan back ke '/', redirect ke dashboard
        if ($user && ($request->is('/') || $request->path() == '')) {
            return redirect('/dashboard');
        }

        // Cegah akses ke route '/' jika sudah login, termasuk saat menggunakan tombol back
        if ($user && $request->route() && $request->route()->uri() == '/') {
            return redirect('/dashboard');
        }

        // Jika user dengan role 2 mencoba akses admin/dashboard, redirect ke dashboard
        if ($user && $user->id_role == 2 && $request->is('admin/dashboard')) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}