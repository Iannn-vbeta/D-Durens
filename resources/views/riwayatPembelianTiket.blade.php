@extends('layouts.userEnvironment')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Daftar Tiket yang Dipesan oleh Anda</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($pemesanan as $pesanan)
            @php
                $status = $pesanan->status->status_name ?? 'Belum Ditentukan';
                $statusColor = match($status) {
                    'Telah dibayar' => 'text-green-600',
                    'Telah digunakan' => 'text-yellow-500',
                    'Belum dibayar' => 'text-red-600',
                    default => 'text-gray-600',
                };
            @endphp

            <div
                class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition duration-300 p-6 cursor-pointer"
                onclick="openModal({{ $pesanan->transaction_id }})"
            >
                <h2 class="text-xl font-semibold text-indigo-600 mb-2">{{ $pesanan->tiket->ticket_name }}</h2>
                <p class="text-gray-700">Total Tiket: <span class="font-medium">{{ $pesanan->total_ticket }}</span></p>
                <p class="text-gray-700">Tanggal Pesan: <span class="font-medium">{{ $pesanan->ordering_date }}</span></p>
                <p class="text-gray-700">
                    Status: <span class="font-medium {{ $statusColor }}">{{ $status }}</span>
                </p>
            </div>

            <!-- Modal -->
            <div
                id="modal-{{ $pesanan->transaction_id }}"
                class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            >
                <div class="bg-white rounded-lg p-6 w-full max-w-md relative">
                    <button
                        onclick="closeModal({{ $pesanan->transaction_id }})"
                        class="absolute top-2 right-2 text-gray-600 hover:text-gray-900"
                    >
                        &times;
                    </button>
                    <h2 class="text-2xl font-bold mb-4 text-indigo-700">Detail Pemesanan</h2>
                    <p class="mb-1"><strong>Nama Tiket:</strong> {{ $pesanan->tiket->ticket_name }}</p>
                    <p class="mb-1"><strong>Deskripsi:</strong> {{ $pesanan->tiket->deskripsi }}</p>
                    <p class="mb-1"><strong>Harga:</strong> Rp {{ number_format($pesanan->tiket->price) }}</p>
                    <p class="mb-1"><strong>Total Tiket:</strong> {{ $pesanan->total_ticket }}</p>
                    <p class="mb-1"><strong>Tanggal Transaksi:</strong> {{ $pesanan->transaction_date }}</p>
                    <p class="mb-1"><strong>Tanggal Pemesanan:</strong> {{ $pesanan->ordering_date }}</p>
                    <p class="mb-4">
                        <strong>Status:</strong> <span class="{{ $statusColor }}">{{ $status }}</span>
                    </p>
                    <button
                        onclick="closeModal({{ $pesanan->transaction_id }})"
                        class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition duration-200"
                    >
                        Tutup
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById('modal-' + id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById('modal-' + id).classList.add('hidden');
    }
</script>
@endsection
