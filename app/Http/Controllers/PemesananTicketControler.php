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

    public function create()
    {
        // Ambil semua data tiket dari tabel e_ticketing
        $tickets = ETicketing::all();

        return view('pemesananTiket', compact('tickets'));
    }

    // pemesanan tiket

    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validated = $request->validate([
            'ticket_id' => 'required|exists:e_ticketing,ticket_id',
            'user_id' => 'required|exists:users,id',
            'ordering_date' => 'required|date',
            'total_ticket' => 'required|integer|min:1',
            'status_pemesanan_id' => 'required|integer',
        ]);

        // Mulai transaksi DB supaya data konsisten
        \DB::beginTransaction();

        try {
            // Ambil tiket berdasarkan ticket_id
            $ticket = ETicketing::findOrFail($validated['ticket_id']);

            // Cek apakah kuota cukup
            if ($ticket->kuota < $validated['total_ticket']) {
                return redirect()->back()->withErrors(['total_ticket' => 'Kuota tiket tidak cukup.']);
            }

            // Buat data pemesanan tiket
            $pemesanan = PemesananTiket::create([
                'ticket_id' => $validated['ticket_id'],
                'user_id' => $validated['user_id'],
                'ordering_date' => $validated['ordering_date'],
                'total_ticket' => $validated['total_ticket'],
                'status_pemesanan_id' => $validated['status_pemesanan_id'],
                'transaction_date' => null
            ]);

            // Kurangi kuota tiket
            $ticket->kuota -= $validated['total_ticket'];
            $ticket->save();

            // Commit transaksi
            \DB::commit();

            return redirect()->back()->with('success', 'Pemesanan tiket berhasil!');
        } catch (\Exception $e) {
            // Rollback kalau ada error
            \DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memproses pemesanan.']);
        }
    }



    public function success()
    {
        return view('pemesanan.success');
    }
}