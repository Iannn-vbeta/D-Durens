<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Kelayakan;
use App\Models\Inventaris;
use App\Models\Ketersediaan;
use Illuminate\Http\Request;
use App\Models\KategoriBarang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class InventarisController extends Controller
{
   public function index()
{
    $inventaris = Inventaris::with(['user','kategoriBarang', 'ketersediaan', 'kelayakan'])->get();
    $users = User::all();
    $kategoriBarang = KategoriBarang::all();
    $ketersediaan = Ketersediaan::all();
    $kelayakan = Kelayakan::all();

    return view('admin.inventaris', compact('users','inventaris', 'kategoriBarang', 'ketersediaan', 'kelayakan'));
}

    public function store(Request $request)
    {

        $request->validate([
            'item_name' => 'required',
            'amount' => 'required|integer',
            'category_id' => 'required|exists:kategori_barang,category_id',
            'ketersediaan_id' => 'required|exists:ketersediaan,ketersediaan_id',
            'kelayakan_id' => 'required|exists:kelayakan,kelayakan_id',
            'deskripsi' => 'nullable',
        ]);

        $inventaris = Inventaris::create([
            'item_name' => $request->item_name,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'ketersediaan_id' => $request->ketersediaan_id,
            'kelayakan_id' => $request->kelayakan_id,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        // Cari data inventaris berdasarkan ID
        $inventaris = Inventaris::findOrFail($id);

        // Validasi inputan
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'amount' => 'required|integer',
            'category_id' => 'required|exists:kategori_barang,category_id',
            'ketersediaan_id' => 'required|exists:ketersediaan,ketersediaan_id',
            'kelayakan_id' => 'required|exists:kelayakan,kelayakan_id',
            'deskripsi' => 'nullable|string',
        ]);

        // Tambahkan ID user yang melakukan update
        $validated['user_id'] = Auth::id();

        // Lakukan update data
        $inventaris->update($validated);

        // Redirect kembali ke halaman inventaris dengan pesan sukses
        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Inventaris::destroy($id);

        return redirect()
            ->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil dihapus.');
    }
}
