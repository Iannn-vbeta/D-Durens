<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserDashboardController extends \Illuminate\Routing\Controller
{
    public function __construct()
{
    $this->middleware(function ($request, $next) {
        if (Auth::check() && Auth::user()->id_role == 1) {
            return redirect()->route(   'admin.dashboard');
        }
        return $next($request);
    });
}
    public function index()
    {
        return view('dashboard');
    }
}