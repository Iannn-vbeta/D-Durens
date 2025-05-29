@extends('layouts.userEnvironment')

@section('content')
<div class="max-w-7xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-center text-indigo-600 mb-8">Daftar Tiket</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Grid Ticket Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12">
        @foreach ($tickets as $ticket)
            <div
                class="ticket-card bg-white p-6 rounded-lg shadow-md cursor-pointer hover:shadow-lg transition-shadow duration-200"
                data-id="{{ $ticket->ticket_id }}"
                data-name="{{ $ticket->ticket_name }}"
                data-desc="{{ $ticket->deskripsi }}"
                data-price="{{ $ticket->price }}"
                data-kuota="{{ $ticket->kuota }}"
            >
                <h2 class="text-xl font-bold text-indigo-600 mb-2">{{ $ticket->ticket_name }}</h2>
                <p class="text-gray-700 mb-4">{{ $ticket->deskripsi }}</p>
                <p class="text-lg font-semibold text-green-600">Rp{{ number_format($ticket->price, 0, ',', '.') }}</p>
                <p class="text-sm text-red-600 mt-2">Sisa kuota: {{ $ticket->kuota }}</p>
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div id="modal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
        style="display: none;"
    >
        <div class="bg-white rounded-lg p-6 sm:p-8 w-full max-w-md sm:max-w-lg">
            <h2 id="modal-ticket-name" class="text-2xl font-bold mb-4 text-indigo-600"></h2>
            <input type="hidden" id="modal-ticket-kuota" value="">
            <p><strong>Username:</strong> <span id="modal-user-id-display">{{ Auth::user()->username ?? '-' }}</span></p>
            <p><strong>Ordering Date:</strong> <span id="modal-ordering-date-display">{{ now()->toDateString() }}</span></p>
            <p class="text-sm text-red-600 mb-2">Sisa kuota: <span id="modal-kuota-display"></span></p>
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
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 mb-4" required>

                <div class="flex justify-end">
                    <button type="button" id="modal-close" class="mr-2 bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Pesan Tiket</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ticketCards = document.querySelectorAll('.ticket-card');
        const modal = document.getElementById('modal');
        const modalTicketName = document.getElementById('modal-ticket-name');
        const modalTicketDesc = document.getElementById('modal-ticket-desc');
        const modalTicketPrice = document.getElementById('modal-ticket-price');
        const modalTicketIdInput = document.getElementById('modal-ticket-id');
        const modalTicketKuotaInput = document.getElementById('modal-ticket-kuota');
        const modalKuotaDisplay = document.getElementById('modal-kuota-display');
        const totalTicketInput = document.getElementById('total_ticket');
        const modalCloseBtn = document.getElementById('modal-close');

        function openModal(ticket) {
            modalTicketName.textContent = ticket.name;
            modalTicketDesc.textContent = ticket.desc;
            modalTicketPrice.textContent = Number(ticket.price).toLocaleString('id-ID');
            modalTicketIdInput.value = ticket.id;
            modalTicketKuotaInput.value = ticket.kuota;
            modalKuotaDisplay.textContent = ticket.kuota;
            totalTicketInput.value = 1;
            modal.style.display = 'flex';
        }

        ticketCards.forEach(card => {
            card.addEventListener('click', function () {
                const ticket = {
                    id: this.dataset.id,
                    name: this.dataset.name,
                    desc: this.dataset.desc,
                    price: this.dataset.price,
                    kuota: this.dataset.kuota
                };
                openModal(ticket);
            });
        });

        modalCloseBtn.addEventListener('click', function () {
            modal.style.display = 'none';
        });

        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Tambahkan validasi jumlah tiket saat user mengubah input
        totalTicketInput.addEventListener('input', function () {
            const kuota = parseInt(modalTicketKuotaInput.value);
            const jumlah = parseInt(totalTicketInput.value);
            if (jumlah > kuota) {
                alert('Jumlah tiket yang diminta melebihi kuota tersedia (' + kuota + ').');
                totalTicketInput.value = kuota; // atur nilai ke maksimum kuota
            } else if (jumlah < 1) {
                alert('Jumlah tiket minimal 1.');
                totalTicketInput.value = 1; // minimal 1 tiket
            }
        });

        // Validasi jumlah tiket sebelum submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const kuota = parseInt(modalTicketKuotaInput.value);
            const jumlah = parseInt(totalTicketInput.value);
            if (jumlah > kuota) {
                e.preventDefault();
                alert('Jumlah tiket yang diminta melebihi kuota tersedia (' + kuota + ').');
            }
        });
    });
    </script>

@endsection
