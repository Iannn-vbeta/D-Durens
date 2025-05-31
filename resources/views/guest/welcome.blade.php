@extends('layouts.dashboardAwal')

@section('content')
    <!-- Background abu-abu full width -->
    <div class="bg-gray-200 py-[20px] sm:py-[70px]">
        <!-- Konten dibatasi dan di tengah -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-4 md:px-12 max-w-7xl mx-auto">
            <div class="flex flex-col justify-center md:px-0">
                <h1 class="text-3xl md:text-4xl font-bold">
                    <span class="text-green-600">Rasakan Nuansa Alam Berlibur</span><br>
                    di Wisata Alam Kampung Durian
                </h1>
                <button class="bg-green-600 text-sm md:text-lg text-white mt-4 sm:mt-12 px-6 py-[10px] rounded-md w-fit">
                    Jelajahi sekarang
                </button>
            </div>
            <div class="flex justify-center items-center">
                <img src="{{ asset('img/Atas.png') }}" alt="Kampung Wisata"
                    class="rounded-lg shadow-lg max-w-full h-auto w-3/4 sm:w-2/3">
            </div>
        </div>
    </div>

    <!-- Background putih full width -->
    <div class="bg-white py-[70px]">
        <!-- Konten dibatasi dan di tengah -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-4 md:px-12 max-w-7xl mx-auto">
            <div class="flex justify-center items-center">
                <img src="{{ asset('img/suasana1.png') }}" alt="Kampung Wisata"
                    class="rounded-lg shadow-lg max-w-full h-auto">
            </div>
            <div class="flex flex-col pt-12">
                <h1 class="text-3xl md:text-4xl font-bold"><span class="text-green-600">Suasana Seru di Kebun <br>
                        Durian Kami</span></h1>
                <p class="mt-4 text-sm md:text-base">Nikmati pengalaman tak terlupakan bersama keluarga dan teman di
                    tengah rindangnya kebun durian!
                    Mulai dari memetik durian langsung dari pohonnya, mencicipi berbagai jenis durian lokal yang
                    legit, hingga menikmati udara segar pedesaan Jember yang asri.Setiap kunjungan adalah momen
                    penuh tawa, kehangatan, dan kenikmatan rasa durian yang autentik.</p>
                <a href="{{ route('login') }}" class="bg-green-600 text-white mt-12 px-6 py-2 rounded-md w-fit">Masuk
                    Sekarang</a>
            </div>
        </div>
    </div>

    <div class="bg-green-600 py-12 px-4 md:px-12">
        <h1 class="text-center text-white text-3xl md:text-4xl font-bold mb-8">Tentang Kami</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <img src="{{ asset('img/logotk1.png') }}" alt="Logo 1" class="mx-auto mb-4 w-16 h-16">
                <h2 class="text-xl font-semibold mb-2">Wisata Durian</h2>
                <p class="text-gray-600 text-sm md:text-base">Nikmati pengalaman menjelajahi kebun durian dan
                    mencicipi durian segar
                    langsung dari pohonnya</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <img src="{{ asset('img/logotk2.png') }}" alt="Logo 2" class="mx-auto mb-4 w-16 h-16">
                <h2 class="text-xl font-semibold mb-2">E-Ticketing</h2>
                <p class="text-gray-600 text-sm md:text-base">Gunakan teknologi kami untuk memeriksa kesehatan
                    durian dan memastikan
                    kualitasnya.</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <img src="{{ asset('img/logotk3.png') }}" alt="Logo 3" class="mx-auto mb-4 w-16 h-16">
                <h2 class="text-xl font-semibold mb-2">Screening Penyakit Daun dan Jenis Durian</h2>
                <p class="text-gray-600 text-sm md:text-base">Deteksi jenis durian hanya dengan melihat ciri
                    fisiknya dan temukan
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
    <div class="py-20 flex flex-col items-center text-center px-4">
        <div>
            <h2 class="font-bold text-lg md:text-xl">Temukan</h2>
            <h1 class="text-3xl md:text-4xl font-bold"><span class="text-green-600">Artikel</span> Terkini</h1>
            <h3 class="text-sm md:text-base">Seputar <span class="text-green-600">Kampung Wisata Durian</span>
            </h3>
        </div>
        <div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($artikels as $artikel)
                    <div class="bg-white shadow p-4 rounded">
                        <img src="{{ asset('storage/' . $artikel->image) }}" alt=""
                            class="w-full h-40 object-cover">
                        <h2 class="text-xl font-bold mt-2">{{ $artikel->title }}</h2>
                        <p class="text-gray-600 mt-1">{{ Str::limit($artikel->description, 10) }}</p>
                        <a href="{{ route('artikel.showArtikel', $artikel->article_id) }}"
                            class="text-blue-500 mt-2 inline-block">Baca
                            Selengkapnya</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
