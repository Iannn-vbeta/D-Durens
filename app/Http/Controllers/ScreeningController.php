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

    public function upload(Request $request)
    {
        $request->validate([
            'leaf_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $image = $request->file('leaf_image');
        $response = Http::attach(
            'image',
            file_get_contents($image->getRealPath()),
            $image->getClientOriginalName()
        )->post('http://127.0.0.1:5000/predict'); // Ganti dengan IP Flask kamu

        if ($response->successful()) {
            $filename = uniqid() . ".jpg";
            Storage::disk('public')->put("hasil_deteksi/$filename", $response->body());
            return back()->with(['success' => 'Deteksi selesai!', 'filename' => $filename]);
        }

        return back()->with('error', 'Terjadi kesalahan saat mendeteksi gambar.');
    }
}
