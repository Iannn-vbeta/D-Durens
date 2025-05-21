<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;
use App\Models\KategoriBarang;
use App\Models\Ketersediaan;
use App\Models\Kelayakan;

class InventarisController extends Controller
{
    public function index()
    {
        $inventaris = Inventaris::with(['kategoriBarang', 'ketersediaan', 'kelayakan'])->get();
         $kategori = KategoriBarang::all(); // Retrieve all categories
    $ketersediaan = Ketersediaan::all(); // Retrieve all availability statuses
    $kelayakan = Kelayakan::all(); // Retrieve all eligibility statuses
        return view('admin.inventaris', compact('inventaris', 'kategori', 'ketersediaan', 'kelayakan'));
    }

    public function create()
    {
        // Ambil data kategori untuk form
        $kategoris = KategoriBarang::all();
        // Tampilkan form tambah inventaris
        return view('admin.inventaris', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'kategori_id' => 'required|exists:kategori_barang,id',
            'ketersediaan_id' => 'required|exists:ketersediaan,id',
            'kelayakan_id' => 'required|exists:kelayakan,id',
            'deskripsi' => 'nullable|string|max:1000',
            // tambahkan validasi lain sesuai kebutuhan
        ]);

        Inventaris::create($validated);
        dd('inventaris')->create($validated);

        return redirect()->route('admin.inventaris')->with('success', 'Inventaris berhasil ditambahkan.');
    }

    public function show($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        return view('admin.inventaris', compact('inventaris'));
    }

    public function edit($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        $kategoris = \App\Models\KategoriBarang::all();
        return view('admin.inventaris', compact('inventaris', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            // tambahkan validasi lain sesuai kebutuhan
        ]);

        $inventaris = Inventaris::findOrFail($id);
        $inventaris->update($validated);

        return redirect()->route('admin.inventaris')->with('success', 'Inventaris berhasil diupdate.');
    }

    public function destroy($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        $inventaris->delete();

        return redirect()->route('admin.inventaris')->with('success', 'Inventaris berhasil dihapus.');
    }
}