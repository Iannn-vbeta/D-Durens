@extends('layouts.userEnvironment')

@section('content')
    <div id="home" class="bg-gray-400 py-16 px-4 md:px-12">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Gambar dulu untuk mobile, tapi di md urutannya jadi kedua -->
            <div class="order-1 md:order-2 flex justify-center">
                <img src="{{ asset('img/Atas.png') }}" alt="Kampung Wisata" class="rounded-lg shadow-lg max-w-full h-auto" />
            </div>

            <!-- Teks & tombol -->
            <div class="order-2 md:order-1 flex flex-col space-y-8">
                <h1 class="text-3xl sm:text-4xl font-bold">
                    <span class="text-green-600">Rasakan Nuansa Alam Berlibur</span><br>
                    di Wisata Alam Kampung Durian
                </h1>
                <button class="bg-green-600 text-white px-8 py-3 rounded-md w-max hover:bg-green-700 transition">
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
    <div id="aboutUs" class="bg-green-600 py-12">
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
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 py-20 px-4 max-w-7xl mx-auto">
        <!-- Kiri: Judul -->
        <div class="md:col-span-4 flex justify-center items-center text-center md:text-left">
            <h2 class="text-2xl md:text-3xl font-bold">
                Bantu wisata lokal <br>
                <span class="text-green-600">untuk terus berkembang</span>
            </h2>
        </div>

        <!-- Kanan: Statistik -->
        <div class="md:col-span-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
            <!-- Jumlah Pengunjung -->
            <div class="bg-white rounded-2xl shadow-md p-4 flex flex-col items-center">
                <img src="{{ asset('img/iconorang.png') }}" alt="Jumlah Pengunjung" class="w-16 h-16 mb-2">
                <div class="text-lg font-bold text-green-600">1,234</div>
                <div class="text-sm font-semibold text-gray-700">Jumlah Pengunjung</div>
            </div>

            <!-- Jumlah Review Positif -->
            <div class="bg-white rounded-2xl shadow-md p-4 flex flex-col items-center">
                <img src="{{ asset('img/iconbintang.png') }}" alt="Jumlah Review Positif" class="w-16 h-16 mb-2">
                <div class="text-lg font-bold text-green-600">4,5</div>
                <div class="text-sm font-semibold text-gray-700">Jumlah Review Positif</div>
            </div>

            <!-- Jumlah Tiket Terjual -->
            <div class="bg-white rounded-2xl shadow-md p-4 flex flex-col items-center">
                <img src="{{ asset('img/icontiket.png') }}" alt="Jumlah Tiket Terjual" class="w-16 h-16 mb-2">
                <div class="text-lg font-bold text-green-600">1,200++</div>
                <div class="text-sm font-semibold text-gray-700">Jumlah Tiket Terjual</div>
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
    {{-- <div class="grid grid-cols-3 gap-4 mt-10">
        <div class="p-4 bg-white shadow-lg rounded-xl">
            <img src="{{ asset('img/artikel1.jpg') }}" alt="Artikel 1" class="rounded-lg w-full h-40 object-cover">
            <h3 class="text-lg font-bold mt-2">Judul Artikel 1</h3>
            <p class="text-sm text-gray-600">Deskripsi singkat artikel 1 seputar Kampung Wisata Durian...</p>
            <a href="#" class="inline-block mt-4 px-4 py-2 bg-green-600 text-white rounded-full">Baca Selengkapnya</a>
        </div>
        <div class="p-4 bg-white shadow-lg rounded-xl">
            <img src="{{ asset('img/artikel2.jpg') }}" alt="Artikel 2" class="rounded-lg w-full h-40 object-cover">
            <h3 class="text-lg font-bold mt-2">Judul Artikel 2</h3>
            <p class="text-sm text-gray-600">Deskripsi singkat artikel 2 seputar Kampung Wisata Durian...</p>
            <a href="#" class="inline-block mt-4 px-4 py-2 bg-green-600 text-white rounded-full">Baca Selengkapnya</a>
        </div>
        <div class="p-4 bg-white shadow-lg rounded-xl">
            <img src="{{ asset('img/artikel3.jpg') }}" alt="Artikel 3" class="rounded-lg w-full h-40 object-cover">
            <h3 class="text-lg font-bold mt-2">Judul Artikel 3</h3>
            <p class="text-sm text-gray-600">Deskripsi singkat artikel 3 seputar Kampung Wisata Durian...</p>
            <a href="#" class="inline-block mt-4 px-4 py-2 bg-green-600 text-white rounded-full">Baca Selengkapnya</a>
        </div>
    </div> --}}
<div class="w-full mt-20 flex flex-col items-center mb-20"> <!-- Ditambahkan margin bawah -->
    <h2 class="text-3xl font-bold text-center mb-10">
        Mulai <span class="text-green-600">sekarang</span> dan buat pengalaman berharga
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full max-w-6xl px-4">
        <!-- Kartu Tiket Menginap -->
        <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center">
            <img src="{{ asset('img/iconTiketWisata.png') }}" alt="Tiket Menginap" class="w-24 h-24 mb-4">
            <h3 class="text-lg font-semibold">Tiket Menginap</h3>
            <p class="text-gray-600 mt-2 text-sm">Rp. 30.000</p>
            <a href="{{ route('pemesanan.create') }}" class="mt-4 w-full">
                <button class="w-full py-2 rounded-full bg-black text-white hover:bg-green-600 transition">
                    Pesan Sekarang
                </button>
            </a>
        </div>
        <!-- Kartu Tiket Masuk -->
        <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center">
            <img src="{{ asset('img/iconTiketWisata.png') }}" alt="Tiket Masuk" class="w-24 h-24 mb-4">
            <h3 class="text-lg font-semibold">Tiket Masuk</h3>
            <p class="text-gray-600 mt-2 text-sm">Rp. 5.000</p>
            <a href="{{ route('pemesanan.create') }}" class="mt-4 w-full">
                <button class="w-full py-2 rounded-full bg-black text-white hover:bg-green-600 transition">
                    Pesan Sekarang
                </button>
            </a>
        </div>
        <!-- Kartu Sewa Rumah Segitiga -->
        <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center">
            <img src="{{ asset('img/iconTiketWisata.png') }}" alt="Sewa Rumah Segitiga" class="w-24 h-24 mb-4">
            <h3 class="text-lg font-semibold">Sewa Rumah Segitiga</h3>
            <p class="text-gray-600 mt-2 text-sm">Rp. 125.000</p>
            <button class="mt-4 w-full py-2 rounded-full bg-gray-400 text-white cursor-not-allowed" disabled>
                Coming Soon
            </button>
        </div>
    </div>
</div>


@endsection
