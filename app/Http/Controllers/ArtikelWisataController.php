<?php

namespace App\Http\Controllers;

use App\Models\ArtikelWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArtikelWisataController extends Controller
{
    public function index()
    {
        $artikels = ArtikelWisata::get();
        return view('admin.artikel', compact('artikels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('artikel', 'public');
        }

        ArtikelWisata::create($validated);

        return redirect()->route('admin.artikel')->with('success', 'Artikel ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $artikel = ArtikelWisata::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('artikel', 'public');
        }

        $artikel->update($validated);

        return redirect()->route('admin.artikel')->with('success', 'Artikel diperbarui');
    }

    public function destroy($id)
    {
        ArtikelWisata::findOrFail($id)->delete();
        return redirect()->route('admin.artikel')->with('success', 'Artikel dihapus');
    }

    public function showArtikel($id)
    {
        $artikel = ArtikelWisata::findOrFail($id);
        return view('guest.welcome', compact('artikel'));
    }

}