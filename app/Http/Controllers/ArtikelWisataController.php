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
        $artikels = ArtikelWisata::all();
        return view('admin.artikel', compact('artikels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp',
            'description' => 'required|string',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        ArtikelWisata::create([
            'title' => $request->title,
            'image' => $imagePath,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $artikel = ArtikelWisata::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($artikel->image);
            $artikel->image = $request->file('image')->store('images', 'public');
        }

        $artikel->title = $request->title;
        $artikel->description = $request->description;
        $artikel->save();

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $artikel = ArtikelWisata::findOrFail($id);
        Storage::disk('public')->delete($artikel->image);
        $artikel->delete();

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}