@extends('layouts.userEnvironment')

@section('content')
    <div id="home" class="bg-gray-400 py-16 px-4 md:px-12">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Gambar dulu untuk mobile, tapi di md urutannya jadi kedua -->
            <div class="order-1 md:order-2 flex justify-center">
                <!-- Carousel -->
                <div id="carouselExample" class="relative w-full max-w-md touch-pan-x select-none" data-carousel="static">
                    <!-- Carousel wrapper -->
                    <div class="relative h-64 overflow-hidden rounded-lg">
                        @php
                            $carouselImages = ['img/Atas.png', 'img/suasana1.png'];
                        @endphp
                        @foreach ($carouselImages as $index => $img)
                            <div class="absolute inset-0 transition-opacity duration-700 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }} carousel-item"
                                data-carousel-item="{{ $index }}">
                                <img src="{{ asset($img) }}" class="block w-full h-full object-cover"
                                    alt="Slide {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>
                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-1/2 left-0 z-30 flex items-center justify-center h-10 w-10 -translate-y-1/2 bg-white/70 rounded-full shadow hover:bg-white"
                        data-carousel-prev>
                        <span class="sr-only">Previous</span>
                        <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button type="button"
                        class="absolute top-1/2 right-0 z-30 flex items-center justify-center h-10 w-10 -translate-y-1/2 bg-white/70 rounded-full shadow hover:bg-white"
                        data-carousel-next>
                        <span class="sr-only">Next</span>
                        <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
                <!-- Carousel Script -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const items = document.querySelectorAll('[data-carousel-item]');
                        let current = 0;

                        function showItem(idx) {
                            items.forEach((el, i) => {
                                el.classList.toggle('opacity-100', i === idx);
                                el.classList.toggle('opacity-0', i !== idx);
                            });
                        }

                        document.querySelector('[data-carousel-prev]').addEventListener('click', function() {
                            current = (current - 1 + items.length) % items.length;
                            showItem(current);
                        });

                        document.querySelector('[data-carousel-next]').addEventListener('click', function() {
                            current = (current + 1) % items.length;
                            showItem(current);
                        });

                        // Optional: auto-slide
                        let autoSlide = setInterval(() => {
                            current = (current + 1) % items.length;
                            showItem(current);
                        }, 4000);

                        // Touch/drag support
                        let startX = null;
                        let dragging = false;
                        const carousel = document.getElementById('carouselExample');

                        carousel.addEventListener('touchstart', function(e) {
                            if (e.touches.length === 1) {
                                startX = e.touches[0].clientX;
                                dragging = true;
                                clearInterval(autoSlide);
                            }
                        });

                        carousel.addEventListener('touchmove', function(e) {
                            // Prevent scrolling while swiping
                            if (dragging) e.preventDefault();
                        }, {
                            passive: false
                        });

                        carousel.addEventListener('touchend', function(e) {
                            if (!dragging || startX === null) return;
                            let endX = e.changedTouches[0].clientX;
                            let diff = endX - startX;
                            if (Math.abs(diff) > 40) {
                                if (diff < 0) {
                                    // Geser ke kanan (next)
                                    current = (current + 1) % items.length;
                                } else {
                                    // Geser ke kiri (prev)
                                    current = (current - 1 + items.length) % items.length;
                                }
                                showItem(current);
                            }
                            dragging = false;
                            startX = null;
                            autoSlide = setInterval(() => {
                                current = (current + 1) % items.length;
                                showItem(current);
                            }, 4000);
                        });
                    });
                </script>
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
                <div class="text-lg font-bold text-green-600">10.000++</div>
                <div class="text-sm font-semibold text-gray-700">Jumlah Pengunjung</div>
            </div>

            <!-- Jumlah Review Positif -->
            <div class="bg-white rounded-2xl shadow-md p-4 flex flex-col items-center">
                <img src="{{ asset('img/iconbintang.png') }}" alt="Jumlah Review Positif" class="w-16 h-16 mb-2">
                <div class="text-lg font-bold text-green-600">4.5</div>
                <div class="text-sm font-semibold text-gray-700">Jumlah Review Positif</div>
            </div>

            <!-- Jumlah Tiket Terjual -->
            <div class="bg-white rounded-2xl shadow-md p-4 flex flex-col items-center">
                <img src="{{ asset('img/icontiket.png') }}" alt="Jumlah Tiket Terjual" class="w-16 h-16 mb-2">
                <div class="text-lg font-bold text-green-600">1.200++</div>
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
            <div class="flex flex-col items-center space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-16 mb-6">
                    @foreach ($artikels->take(3) as $artikel)
                        <div class="bg-white shadow p-4 rounded flex flex-col items-center">
                            <img src="{{ asset('storage/' . $artikel->image) }}" alt=""
                                class="w-full h-40 object-cover">
                            <h2 class="text-xl font-bold mt-2 text-center">{{ $artikel->title }}</h2>
                            <p class="text-gray-600 mt-1 text-center">{{ Str::limit($artikel->description, 10) }}</p>
                            <a href="{{ route('artikel.showArtikel', $artikel->article_id) }}"
                                class="text-blue-500 mt-2 inline-block">Baca Selengkapnya</a>
                        </div>
                    @endforeach
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                    @foreach ($artikels->skip(3)->take(2) as $artikel)
                        <div class="bg-white shadow p-4 rounded flex flex-col items-center">
                            <img src="{{ asset('storage/' . $artikel->image) }}" alt=""
                                class="w-full h-40 object-cover">
                            <h2 class="text-xl font-bold mt-2 text-center">{{ $artikel->title }}</h2>
                            <p class="text-gray-600 mt-1 text-center">{{ Str::limit($artikel->description, 10) }}</p>
                            <a href="{{ route('artikel.showArtikel', $artikel->article_id) }}"
                                class="text-blue-500 mt-2 inline-block">Baca Selengkapnya</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="w-full mt-20 flex flex-col items-center mb-20"> <!-- Ditambahkan margin bawah -->
        <h2 class="text-3xl font-bold text-center mb-10">
            Mulai <span class="text-green-600">sekarang</span> dan buat pengalaman berharga
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full max-w-6xl px-4">
            <!-- Kartu Tiket Menginap -->
            <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center">
                <img src="{{ asset('img/iconTiketWisata.png') }}" alt="Tiket Menginap" class="w-24 h-24 mb-4">
                <h3 class="text-lg font-semibold">Tiket Menginap</h3>
                <p class="text-gray-600 mt-2 text-sm">Rp. 40.000</p>
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
                <p class="text-gray-600 mt-2 text-sm">Rp. 15.000</p>
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
