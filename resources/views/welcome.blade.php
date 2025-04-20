<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        @vite('resources/css/app.css')
    </head>

    <body style="font-family: 'Poppins', sans-serif;">
        <header class="shadow bg-white">
            @if (Route::has('login'))
                <nav class="grid grid-cols-2 items-center justify-between ">
                    <div class="col-auto ml-10">
                        <img src="{{ asset('img/logo2.png') }}" alt="">
                    </div>
                    <div class="container mx-auto flex justify-end p-4 space-x-4 col-auto">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="rounded-md px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 
                                   hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] 
                                   dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 
                                   dark:focus:ring-white">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="rounded-md px-4 py-2 text-sm font-medium bg-green-600 text-white hover:bg-green-700">
                                Masuk Sekarang
                            </a>

                            {{-- @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="rounded-md px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 
                                       hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] 
                                       dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 
                                       dark:focus:ring-white"
                            >
                                Register
                            </a>
                        @endif --}}
                        @endauth
                    </div>
                </nav>
            @endif
        </header>
        <main>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-[70px] bg-gray-200 ">
                <!-- Left Column (Text) -->
                <div class="flex flex-col pt-12 pl-12">
                    <h1 class="text-4xl font-bold"><span class="text-green-600">Rasakan Nuansa Alam Berlibur</span><br>
                        di Wisata Alam Kampung Durian</h1>
                    <button class="bg-green-600 text-white mt-12 px-6 py-2 rounded-md w-fit">Jelajahi sekarang</button>
                </div>
                <!-- Right Column (Image) -->
                <div class="flex justify-center items-center">
                    <img src="{{ asset('img/Atas.png') }}" alt="Kampung Wisata"
                        class="rounded-lg shadow-lg max-w-full h-auto">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-[70px] bg-white">
                <!-- Left Column (Text) -->
                <div class="flex justify-center items-center">
                    <img src="{{ asset('img/suasana1.png') }}" alt="Kampung Wisata"
                        class="rounded-lg shadow-lg max-w-full h-auto">
                </div>
                <!-- Right Column (Image) -->
                <div class="flex flex-col pt-12 pl-12">
                    <h1 class="text-4xl font-bold"><span class="text-green-600">Suasana Seru di Kebun <br> Durian Kami
                    </h1>
                    <p>Nikmati pengalaman tak terlupakan bersama keluarga dan teman di tengah rindangnya kebun durian!
                        Mulai dari memetik durian langsung dari pohonnya, mencicipi berbagai jenis durian lokal yang
                        legit, hingga menikmati udara segar pedesaan Jember yang asri. Setiap kunjungan adalah momen
                        penuh tawa, kehangatan, dan kenikmatan rasa durian yang autentik.</p>
                    <a href="{{ route('login') }}"
                        class="bg-green-600 text-white mt-12 px-6 py-2 rounded-md w-fit">Masuk Sekarang</a>
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
            <div class="py-20 flex flex-col items-center text-center">
                <div>
                    <h2 class="font-bold">Temukan</h2>
                    <h1 class="text-4xl font-bold"><span class="text-green-600">Artikel</span> Terkini</h1>
                    <h3>Seputar <span class="text-green-600">Kampung Wisata Durian</span></h3>
                </div>
                <div>
                    <h1>Comings soon</h1>
                </div>
            </div>
        </main>
        <footer class="bg-gray-800 text-white py-8">
            <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="text-center md:text-left">
                    <p>&copy; 2025 Kampung Wisata Durian. All rights reserved</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h3 class="font-bold mb-2">Layanan Lainnya</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:underline">Tentang Kami</a></li>
                            <li><a href="#" class="hover:underline">Kontak</a></li>
                            <li><a href="#" class="hover:underline">Syarat dan Ketentuan</a></li>
                            <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold mb-2">Kampung Wisata Durian</h3>
                        <p>Area Hutan, Pakis, Kec. Panti, Kabupaten Jember, Jawa Timur 68153</p>
                    </div>
                </div>
            </div>
        </footer>
    </body>

</html>
