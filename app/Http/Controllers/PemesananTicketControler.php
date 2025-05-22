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

    public function tambahKuota(Request $request, $id)
    {
    $request->validate(['jumlah_kuota' => 'required|integer|min:1']);
    $tiket = ETicketing::findOrFail($id);
    $tiket->kuota += $request->jumlah_kuota;
    $tiket->save();

    return back()->with('success', 'Kuota berhasil ditambah.');
    }

    public function kurangiKuota(Request $request, $id)
    {
        $request->validate(['jumlah_kuota' => 'required|integer|min:1']);
        $tiket = ETicketing::findOrFail($id);
        $tiket->kuota = max(0, $tiket->kuota - $request->jumlah_kuota);
        $tiket->save();

        return back()->with('success', 'Kuota berhasil dikurangi.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|in:1,2,3'
        ]);

        $pemesanan = PemesananTiket::findOrFail($id);
        $pemesanan->status_pemesanan_id = $request->status_id;
        $pemesanan->save();

        return back()->with('success', 'Status pemesanan berhasil diperbarui.');
    }

}
