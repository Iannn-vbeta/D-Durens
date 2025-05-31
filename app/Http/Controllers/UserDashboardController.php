<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\ArtikelWisata;


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
        $artikels = ArtikelWisata::latest()->take(5)->get();
         return view('dashboard', compact('artikels'));
    }

    public function guestIndex()
    {
        $artikels = ArtikelWisata::latest()->take(5)->get();
        return view('guest.welcome', compact('artikels'));
    }


}