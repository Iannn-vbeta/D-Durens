<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananTiket;
use App\Models\StatusPemesanan;
use App\Models\User;
use App\Models\ETicketing;
use Illuminate\Support\Facades\Validator;

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
        $request->validate([
            'jumlah_kuota' => 'required|integer|min:1'
        ]);

        $tiket = ETicketing::findOrFail($id);

        // Cek apakah jumlah pengurangan melebihi kuota
        if ($request->jumlah_kuota > $tiket->kuota) {
            return back()->withErrors(['jumlah_kuota' => 'Jumlah pengurangan melebihi kuota saat ini.']);
        }

        // Kurangi kuota
        $tiket->kuota = $tiket->kuota - $request->jumlah_kuota;
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

        // Perkondisian perubahan tanggal_transaksi
        if (in_array($request->status_id, [1, 2])) {
            $pemesanan->transaction_date = now(); // set ke tanggal dan waktu saat ini
        } elseif ($request->status_id == 3) {
            $pemesanan->transaction_date = null; // hapus tanggal transaksi
        }

        $pemesanan->save();

        return redirect()->route('admin.pemesanan')->with('success', 'Status pemesanan berhasil diperbarui.');
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
        // Validasi input awal
        $request->validate([
            'ticket_id' => 'required|exists:e_ticketing,ticket_id',
            'user_id' => 'required|exists:users,id',
            'ordering_date' => 'required|date',
            'total_ticket' => 'required|integer|min:1',
            'status_pemesanan_id' => 'required|integer',
        ]);
        // Ambil data tiket dari database
        $ticket = ETicketing::findOrFail($request->ticket_id);

        // Cek apakah jumlah tiket yang dipesan melebihi kuota
        if ($request->total_ticket > $ticket->kuota) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Jumlah tiket yang dipesan melebihi sisa kuota tersedia (' . $ticket->kuota . ').');
        }

        // Simpan data pemesanan
        PemesananTiket::create([
            'ticket_id' => $request->ticket_id,
            'user_id' => $request->user_id,
            'ordering_date' => $request->ordering_date,
            'total_ticket' => $request->total_ticket,
            'status_pemesanan_id' => $request->status_pemesanan_id,
        ]);

        // Update sisa kuota tiket
        $ticket->kuota -= $request->total_ticket;
        $ticket->save();

        return redirect()->back()->with('success', 'Tiket berhasil dipesan.');
    }


    public function success()
    {
        return view('pemesanan.success');
    }

    public function riwayatPembelian($username)
    {
        // Ambil user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        // Ambil semua pemesanan tiket user beserta relasi tiket dan status
        $pemesanan = PemesananTiket::with(['tiket', 'status'])
            ->where('user_id', $user->id)
            ->get();

        return view('riwayatPembelianTiket', compact('pemesanan', 'user'));
    }
}
