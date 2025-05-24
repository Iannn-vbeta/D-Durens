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
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
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
            <div class="max-w-6xl mx-auto mt-10">
                <h1 class="text-3xl font-bold text-center text-indigo-600 mb-8">Daftar Tiket</h1>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($tickets as $ticket)
                        <div
                            class="ticket-card bg-white p-6 rounded-lg shadow-md cursor-pointer hover:shadow-lg transition-shadow duration-200"
                            data-id="{{ $ticket->ticket_id }}"
                            data-name="{{ $ticket->ticket_name }}"
                            data-desc="{{ $ticket->deskripsi }}"
                            data-price="{{ $ticket->price }}"
                        >
                            <h2 class="text-xl font-bold text-indigo-600 mb-2">{{ $ticket->ticket_name }}</h2>
                            <p class="text-gray-700 mb-4">{{ $ticket->deskripsi }}</p>
                            <p class="text-lg font-semibold text-green-600">Rp{{ number_format($ticket->price, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Modal -->
                <div id="modal"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                    style="display: none;"
                >
                    <div class="bg-white rounded-lg p-8 max-w-md w-full">
                        <h2 id="modal-ticket-name" class="text-2xl font-bold mb-4 text-indigo-600"></h2>

                        <!-- Tampilkan ticket id, user id, dan ordering date -->
                        <p><strong>Username:</strong> <span id="modal-user-id-display">{{ Auth::user()->username ?? '-' }}</span></p>
                        <p><strong>Ordering Date:</strong> <span id="modal-ordering-date-display">{{ now()->toDateString() }}</span></p>
                        <p><strong>Deskripsi:</strong>
                        <p id="modal-ticket-desc" class="mb-2"></p>
                        <p class="font-semibold text-green-600 mb-4">Harga: Rp<span id="modal-ticket-price"></span></p>

                        <form method="POST" action="{{ route('pemesanan.store') }}">
                            @csrf
                            <input type="hidden" name="ticket_id" id="modal-ticket-id" value="">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <input type="hidden" name="ordering_date" value="{{ now()->toDateString() }}">
                            <input type="hidden" name="status_pemesanan_id" value="3">

                            <label for="total_ticket" class="block text-sm font-medium text-gray-700">Jumlah Tiket</label>
                            <input type="number" name="total_ticket" id="total_ticket" min="1" value="1"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 mb-4" required>

                            <div class="flex justify-end">
                                <button type="button" id="modal-close" class="mr-2 bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Pesan Tiket</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Ambil semua tiket
                    const ticketCards = document.querySelectorAll('.ticket-card');
                    const modal = document.getElementById('modal');
                    const modalTicketName = document.getElementById('modal-ticket-name');
                    const modalTicketDesc = document.getElementById('modal-ticket-desc');
                    const modalTicketPrice = document.getElementById('modal-ticket-price');
                    const modalTicketIdInput = document.getElementById('modal-ticket-id');
                    const modalCloseBtn = document.getElementById('modal-close');

                    // Fungsi untuk buka modal dan isi data
                    function openModal(ticket) {
                        modalTicketName.textContent = ticket.name;
                        modalTicketDesc.textContent = ticket.desc;
                        modalTicketPrice.textContent = Number(ticket.price).toLocaleString('id-ID');
                        modalTicketIdInput.value = ticket.id;

                        modal.style.display = 'flex';
                    }

                    // Pasang event klik di tiap tiket
                    ticketCards.forEach(card => {
                        card.addEventListener('click', function () {
                            const ticket = {
                                id: this.dataset.id,
                                name: this.dataset.name,
                                desc: this.dataset.desc,
                                price: this.dataset.price,
                            };
                            openModal(ticket);
                        });
                    });

                    // Event close modal
                    modalCloseBtn.addEventListener('click', function () {
                        modal.style.display = 'none';
                    });

                    // Tutup modal jika klik di luar konten modal
                    modal.addEventListener('click', function (e) {
                        if (e.target === modal) {
                            modal.style.display = 'none';
                        }
                    });
                });
            </script>

    </body>

</html>
