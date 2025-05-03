<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Screening Daun Durian</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <header>
            <nav class="bg-white shadow-md px-6">
                <div class="container mx-auto py-4 flex justify-between items-center">
                    <!-- Logo -->
                    <div class="flex items-center ml-16"> <!-- Tambahkan margin kiri lebih besar -->
                        <a href="#" class="text-xl font-bold text-gray-800">Logo</a>
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

                    <!-- Navigation Links -->
                    <div id="nav-links" class="hidden md:flex space-x-8 items-center mr-12">
                        <!-- Tambahkan margin kanan lebih besar -->
                        <a href="{{ route('dashboard', ['#home']) }}" class="text-gray-800 hover:text-blue-500">Home</a>
                        <a href="{{ route('dashboard', ['#aboutus']) }}" class="text-gray-800 hover:text-blue-500">About
                            Us</a>
                        <a href="{{ route('dashboard', ['#artikel']) }}"
                            class="text-gray-800 hover:text-blue-500">Artikel</a>
                        <a href="#" class="text-gray-800 hover:text-blue-500">Pricing</a>

                        <!-- Dropdown for Screening -->
                        <div class="relative group">
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
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
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
            <div class="bg-white flex flex-col items-center justify-center min-h-screen p-4">
                <h2 class="text-lg font-semibold mb-6">Screening Penyakit Daun Durian</h2>

                <form action="/screening" method="POST" enctype="multipart/form-data"
                    class="w-full max-w-md flex flex-col items-center gap-4">
                    @csrf

                    <!-- Upload file -->
                    <div class="flex items-center border-2 border-gray-300 rounded-lg px-4 py-2 w-full">
                        <label for="leaf_image" class="bg-green-700 text-white px-4 py-2 rounded cursor-pointer">
                            Choose File
                        </label>
                        <input id="leaf_image" type="file" name="leaf_image" class="hidden"
                            onchange="updateFileName()" required>
                        <span id="file-name" class="ml-4 text-gray-600 truncate">No file chosen</span>
                    </div>

                    <!-- Tombol Scan -->
                    <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800">
                        Scan
                    </button>

                    <!-- Kotak hasil deteksi -->
                    <div
                        class="border border-black w-full min-h-[160px] rounded p-2 bg-gray-50 flex items-center justify-center">
                        @if (session('success'))
                            <img src="{{ asset('storage/hasil_deteksi/' . session('filename')) }}" alt="Hasil Deteksi"
                                class="object-contain max-w-[640px] max-h-[640px]">
                        @else
                            <span class="text-gray-400">Hasil akan ditampilkan di sini...</span>
                        @endif
                    </div>

                    <!-- Hasil dan Rekomendasi -->
                    <div class="mt-4 text-left w-full">
                        <p class="font-semibold">Hasil :</p>
                        <p class="text-gray-600 font-semibold">
                            {{ session('hasil_screening') ?? 'Belum ada hasil deteksi.' }}
                        </p>
                        <p class="font-semibold mt-2">Rekomendasi pengobatan:</p>
                        <p class="text-gray-400">
                            {{ session('perawatan') ?? 'Deskripsi Perawatan' }}
                        </p>
                    </div>

                    <!-- Tombol Selesai -->
                    <div class="mt-4 w-full flex justify-end">
                        <button type="button" class="bg-green-700 text-white px-4 py-1 rounded hover:bg-green-800">
                            Selesai
                        </button>
                    </div>
                </form>
            </div>
        </main>



        <script>
            function updateFileName() {
                const input = document.getElementById('leaf_image');
                const fileName = input.files.length > 0 ? input.files[0].name : 'No file chosen';
                document.getElementById('file-name').textContent = fileName;
            }
        </script>

    </body>

</html>
