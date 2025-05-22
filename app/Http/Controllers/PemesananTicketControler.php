<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananTiket;
use App\Models\StatusPemesanan;
use App\Models\User;
use App\Models\ETicketing;

class PemesananTicketControler extends Controller
{
    public function index()
    {
        $pemesanan = PemesananTiket::with(['user', 'tiket', 'status'])->get();
        $namaTiket = ETicketing::all();
        $statusTiket = StatusPemesanan::all();

        return view('admin.pemesananTiket', compact('pemesanan', 'namaTiket', 'statusTiket'));
    }

}
