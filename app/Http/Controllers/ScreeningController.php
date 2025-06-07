<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ScreeningController extends Controller
{
    public function index()
    {
        return view('screen');
    }

    public function indexAdmin(){
        return view('admin.screeningPenyakit');
    }

public function store(Request $request)
{
    $request->validate([
        'leaf_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ], [
        'leaf_image.mimes' => 'Format file gambar tidak valid. Hanya mendukung jpeg, jpg, dan png.',
        'leaf_image.required' => 'Gambar daun harus diunggah.',
        'leaf_image.image' => 'File yang diunggah harus berupa gambar.',
        'leaf_image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
    ]);

    $image = $request->file('leaf_image');

    $response = Http::attach(
        'image',
        file_get_contents($image->getRealPath()),
        $image->getClientOriginalName()
    )->post('http://127.0.0.1:5000/predict');

    if ($response->successful()) {
        $json = $response->json();
        $filename = $json['filename'];
        $penyakit = implode(', ', $json['penyakit']);
        $perawatan = implode(', ', $json['pengobatan']);

        $image_response = Http::get("http://127.0.0.1:5000/uploads/$filename");

        if ($image_response->successful()) {
            Storage::disk('public')->put("hasil_deteksi/$filename", $image_response->body());
        }

        return back()->with([
            'success' => 'Deteksi selesai!',
            'filename' => $filename,
            'hasil_screening' => $penyakit,
            'perawatan' => $perawatan
        ]);
    }

    return back()->with('error', 'Terjadi kesalahan saat mendeteksi gambar.');
}

}
