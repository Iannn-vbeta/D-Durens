<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ScreeningJenis extends Controller
{
    public function index()
    {
        return view('screenJenis');
    }

    public function indexAdmin()
    {
        return view('admin.screeningJenis');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'durian_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'durian_image.required' => 'Gambar buah harus diunggah.',
                'durian_image.image' => 'File yang diunggah harus berupa gambar.',
                'durian_image.mimes' => 'Format file gambar tidak valid. Hanya mendukung jpeg, jpg, dan png.',
                'durian_image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            ]
        );

        $image = $request->file('durian_image');
        $response = Http::attach(
            'image',
            file_get_contents($image->getRealPath()),
            $image->getClientOriginalName()
        )->post('http://127.0.0.1:5000/predict'); // Endpoint Flask untuk deteksi jenis

        if ($response->successful()) {
            $json = $response->json();
            $filename = $json['filename'];
            $jenis_durian = implode(', ', $json['jenis']);

            // Ambil file gambar dari server Flask
            $image_response = Http::get("http://127.0.0.1:5000/uploads/$filename");

            if ($image_response->successful()) {
                Storage::disk('public')->put("hasil_deteksi/$filename", $image_response->body());
            }

            return back()->with([
                'success' => 'Deteksi selesai!',
                'filename' => $filename,
                'hasil_jenis' => $jenis_durian
            ]);
        }

        return back()->with('error', 'Terjadi kesalahan saat mendeteksi gambar.');
    }
}
