<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->id_role == 2) {
                return redirect()->route('dashboard');
            }
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.dashboard');
    }
}