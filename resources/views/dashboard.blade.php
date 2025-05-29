@extends('layouts.userEnvironment')

@section('content')
<div id="home" class="bg-gray-400 py-16 px-4 md:px-12">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <!-- Gambar dulu untuk mobile, tapi di md urutannya jadi kedua -->
        <div class="order-1 md:order-2 flex justify-center">
            <img src="{{ asset('img/Atas.png') }}" alt="Kampung Wisata"
                class="rounded-lg shadow-lg max-w-full h-auto" />
        </div>

        <!-- Teks & tombol -->
        <div class="order-2 md:order-1 flex flex-col space-y-8">
            <h1 class="text-3xl sm:text-4xl font-bold">
                <span class="text-green-600">Rasakan Nuansa Alam Berlibur</span><br>
                di Wisata Alam Kampung Durian
            </h1>
            <button
                class="bg-green-600 text-white px-8 py-3 rounded-md w-max hover:bg-green-700 transition">
                Jelajahi sekarang
            </button>
        </div>
    </div>
</div>

<div id="aboutus" class="bg-white py-16 px-4 md:px-12">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <!-- Left Column (Image) -->
        <div class="flex justify-center">
            <img src="{{ asset('img/suasana1.png') }}" alt="Kampung Wisata"
                class="rounded-lg shadow-lg max-w-full h-auto" />
        </div>

        <!-- Right Column (Text) -->
        <div class="flex flex-col space-y-6">
            <h1 class="text-3xl sm:text-4xl font-bold">
                <span class="text-green-600">Suasana Seru di Kebun <br> Durian Kami</span>
            </h1>
            <p class="text-gray-700 leading-relaxed">
                Nikmati pengalaman tak terlupakan bersama keluarga dan teman di tengah rindangnya kebun
                durian!
                Mulai dari memetik durian langsung dari pohonnya, mencicipi berbagai jenis durian lokal yang
                legit,
                hingga menikmati udara segar pedesaan Jember yang asri.<br>
                Setiap kunjungan adalah momen penuh tawa, kehangatan, dan kenikmatan rasa durian yang
                autentik.
            </p>
            <a href="{{ route('login') }}"
                class="bg-green-600 text-white px-8 py-3 rounded-md w-max hover:bg-green-700 transition inline-block">
                Masuk Sekarang
            </a>
        </div>
    </div>
</div>

{{-- Tentang Kami --}}
<div class="bg-green-600 py-12">
    <h1 class="text-center text-white text-4xl font-bold mb-8">Tentang Kami</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 px-4 sm:px-8 md:px-12">
        <!-- Card 1 -->
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
            <img src="{{ asset('img/logotk1.png') }}" alt="Logo 1" class="mx-auto mb-4 w-16 h-16">
            <h2 class="text-xl font-semibold mb-2">Wisata Durian</h2>
            <p class="text-gray-600">Nikmati pengalaman menjelajahi kebun durian dan mencicipi durian segar
                langsung dari pohonnya</p>
        </div>
        <!-- Card 2 -->
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
            <img src="{{ asset('img/logotk2.png') }}" alt="Logo 2" class="mx-auto mb-4 w-16 h-16">
            <h2 class="text-xl font-semibold mb-2">E-Ticketing</h2>
            <p class="text-gray-600">Gunakan teknologi kami untuk memeriksa kesehatan durian dan memastikan
                kualitasnya.</p>
        </div>
        <!-- Card 3 -->
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
            <img src="{{ asset('img/logotk3.png') }}" alt="Logo 3" class="mx-auto mb-4 w-16 h-16">
            <h2 class="text-xl font-semibold mb-2">Screening Penyakit Daun dan Jenis Durian</h2>
            <p class="text-gray-600">Deteksi jenis durian hanya dengan melihat ciri fisiknya dan temukan
                informasi lengkapnya.</p>
        </div>
    </div>
</div>
{{-- Statistik --}}
<div class="grid grid-cols-12 gap-4 py-20">
    <div class="col-span-4 flex justify-center items-center">
        <h2>Bantu wisata lokal <br>
            <span class="text-green-600">untuk terus berkembang</span>
        </h2>
    </div>
    <div class="col-span-8 grid grid-cols-3 gap-4">
        <div class="p-4 text-center">
            <div class="flex flex-row gap-4">
                <!-- Row 1: Logo -->
                <div class="flex items-center justify-center">
                    <img src="{{ asset('img/iconorang.png') }}" alt="Kampung Wisata"
                        class="rounded-lg shadow-lg max-w-full h-auto">
                </div>
                <!-- Row 2: Text and Number -->
                <div class="grid grid-rows-2">
                    <div class="text-lg font-bold text-green-600">1,234</div>
                    <div class="text-sm font-semibold text-gray-700">Jumlah Pengunjung</div>
                </div>
            </div>
        </div>
        <div class="p-4 text-center">
            <div class="flex flex-row gap-4">
                <!-- Row 1: Logo -->
                <div class="flex items-center justify-center">
                    <img src="{{ asset('img/iconbintang.png') }}" alt="Kampung Wisata"
                        class="rounded-lg shadow-lg max-w-full h-auto">
                </div>
                <!-- Row 2: Text and Number -->
                <div class="grid grid-rows-2">
                    <div class="text-lg font-bold text-green-600">4,5</div>
                    <div class="text-sm font-semibold text-gray-700">Jumlah Review Positif</div>
                </div>
            </div>
        </div>
        <div class="p-4 text-center">
            <div class="flex flex-row gap-4">
                <!-- Row 1: Logo -->
                <div class="flex items-center justify-center">
                    <img src="{{ asset('img/icontiket.png') }}" alt="Kampung Wisata"
                        class="rounded-lg shadow-lg max-w-full h-auto">
                </div>
                <!-- Row 2: Text and Number -->
                <div class="grid grid-rows-2">
                    <div class="text-lg font-bold text-green-600">1,200++</div>
                    <div class="text-sm font-semibold text-gray-700">Jumlah Tiket Terjual</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="artikel" class="py-20 flex flex-col items-center text-center">
    <div>
        <h2 class="font-bold">Temukan</h2>
        <h1 class="text-4xl font-bold"><span class="text-green-600">Artikel</span> Terkini</h1>
        <h3>Seputar <span class="text-green-600">Kampung Wisata Durian</span></h3>
    </div>
    <div>
        <h1>Comings soon</h1>
    </div>
</div>

@endsection
