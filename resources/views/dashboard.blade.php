<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            html {
                scroll-behavior: smooth;
            }
        </style>
    </head>

    <body class="bg-gray-100">
        <header>
            <nav class="bg-white shadow-md px-6">
                <div class="container mx-auto py-4 flex justify-between items-center">
                    <!-- Logo -->
                    <div class="col-auto">
                        <img src="{{ asset('img/logo2.png') }}" alt="" class="w-24 md:w-32">
                    </div>

                    <!-- Hamburger Menu -->
                    <div class="md:hidden">
                        <button id="hamburger" class="text-gray-800 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Navlinks -->
                    <div id="nav-links" class="hidden md:flex space-x-8 items-center mr-12">
                        <a href="#home" class="text-gray-800 hover:text-blue-500">Home</a>
                        <a href="#aboutus" class="text-gray-800 hover:text-blue-500">About Us</a>
                        <a href="#artikel" class="text-gray-800 hover:text-blue-500">Artikel</a>
                        <a href="#" class="text-gray-800 hover:text-blue-500">Pricing</a>

                        <!-- Dropdown Screening -->
                        <div class="relative group z-[2]">
                            <button class="text-gray-800 hover:text-blue-500 focus:outline-none">Screening</button>
                            <div class="absolute hidden group-hover:block bg-white shadow-md mt-2 rounded-md">
                                <a href="{{ route('screening') }}"
                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Screening
                                    Penyakit</a>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Screening
                                    Jenis
                                    Buah</a>
                            </div>
                        </div>

                        <!-- Dropdown for Username -->
                        <div class="relative group ml-12"> <!-- Tambahkan margin kiri lebih besar untuk gap -->
                            <button class="text-gray-800 hover:text-blue-500 focus:outline-none">
                                {{ Auth::user()->username ?? 'Guest' }}
                            </button>
                            <div class="absolute hidden group-hover:block bg-white shadow-md mt-2 rounded-md">
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
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

        <script>
            // Hamburger menu toggle
            const hamburger = document.getElementById('hamburger');
            const navLinks = document.getElementById('nav-links');

            hamburger.addEventListener('click', () => {
                navLinks.classList.toggle('hidden');
            });

            // Dropdown toggle logic
            document.addEventListener('click', (event) => {
                const dropdowns = document.querySelectorAll('.relative.group');
                dropdowns.forEach(dropdown => {
                    const button = dropdown.querySelector('button');
                    const menu = dropdown.querySelector('div');

                    if (button.contains(event.target)) {
                        // Toggle the dropdown menu
                        menu.classList.toggle('hidden');
                    } else if (!menu.contains(event.target)) {
                        // Close the dropdown menu if clicked outside
                        menu.classList.add('hidden');
                    }
                });
            });
        </script>
        <script src="https://unpkg.com/scrollreveal"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                ScrollReveal().reveal('.flex-col, .rounded-lg, .text-center, .font-bold, .p-4', {
                    distance: '40px',
                    duration: 900,
                    easing: 'ease-in-out',
                    origin: 'bottom',
                    interval: 120,
                    reset: false
                });
            });
        </script>

    </body>

</html>
