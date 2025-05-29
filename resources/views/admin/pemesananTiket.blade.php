@extends('layouts.adminEnvironment')
@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Pemesanan Tiket</h2>
        {{-- <a href="" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Kuota Tiket
        </a> --}}
        <button onclick="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Lihat Kuota Tiket
        </button>
    </div>
@if (session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full text-sm text-left border border-gray-200">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Username</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Nama Tiket</th>
                    <th class="px-4 py-2 border">Tanggal Transaksi</th>
                    <th class="px-4 py-2 border">Tanggal Pemesanan</th>
                    <th class="px-4 py-2 border">Total Tiket</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach ($pemesanan as $index => $p)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border">{{ $p->user->username ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $p->user->email ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $p->tiket->ticket_name ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $p->transaction_date }}</td>
                    <td class="px-4 py-2 border">{{ $p->ordering_date }}</td>
                    <td class="px-4 py-2 border">{{ $p->total_ticket }}</td>
                    <td class="px-4 py-2 border">{{ $p->status->status_name ?? '-'}}</td>
                    <td class="px-4 py-2 border space-x-2">
                        <button
                            onclick="openEditStatusModal({
                                transaction_id: '{{ $p->transaction_id }}',
                                total_ticket: '{{ $p->total_ticket }}',
                                ordering_date: '{{ $p->ordering_date }}',
                                status_id: '{{ $p->status_pemesanan_id ?? '-' }}'
                            })"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                            Edit Status
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit Status Pemesanan -->
<div id="editStatusModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white w-full max-w-md rounded shadow-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Edit Status Pemesanan</h3>
            <button onclick="closeEditStatusModal()" class="text-red-600 text-xl">&times;</button>
        </div>
        <form id="editStatusForm" method="POST" action="">
            @csrf
            @method('PUT')
            <input type="hidden" name="transaction_id" id="edit_transaction_id">
            <pre>{{ var_dump($p->status_pemesanan_id) }}</pre>
            <div class="mb-3">
                <label class="block text-sm text-gray-700 font-medium">Total Tiket</label>
                <input type="number" id="edit_total_ticket" disabled class="mt-1 w-full p-2 border rounded bg-gray-100">
            </div>

            <div class="mb-3">
                <label class="block text-sm text-gray-700 font-medium">Tanggal Pemesanan</label>
                <input type="date" id="edit_ordering_date" disabled class="mt-1 w-full p-2 border rounded bg-gray-100">
            </div>

            <div class="mb-4">
                <label class="block text-sm text-gray-700 font-medium">Status Pemesanan</label>
                <select name="status_id" id="edit_status_id" class="mt-1 w-full p-2 border rounded">
                    <option value="1">Telah digunakan</option>
                    <option value="2">Telah dibayar</option>
                    <option value="3">Belum dibayar</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Daftar Kuota Tiket -->
<div id="kuotaModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white w-full max-w-4xl rounded shadow-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Daftar Kuota Tiket</h3>
            <button onclick="closeModal()" class="text-red-600 text-xl">&times;</button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Nama Tiket</th>
                        <th class="px-4 py-2 border">Kuota</th>
                        <th class="px-4 py-2 border">Harga</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @foreach ($namaTiket as $i => $t)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $i + 1 }}</td>
                        <td class="px-4 py-2 border">{{ $t->ticket_name ?? '-'}}</td>
                        <td class="px-4 py-2 border">{{ $t->kuota }}</td>
                        <td class="px-4 py-2 border">Rp{{ number_format($t->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border space-x-2">
                            <button onclick="openAdjustModal({{ $t->ticket_id }}, '{{ $t->ticket_name }}', 'tambah')" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs">Tambah</button>
                            <button onclick="openAdjustModal({{ $t->ticket_id }}, '{{ $t->ticket_name }}', 'kurangi')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">Kurangi</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Form Tambah/Kurangi Kuota -->
<div id="adjustModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white w-full max-w-md rounded shadow-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold" id="adjustModalTitle">Adjust Kuota</h3>
            <button onclick="closeAdjustModal()" class="text-red-600 text-xl">&times;</button>
        </div>
        <form id="adjustForm" method="POST" action="">
            @csrf
            <input type="hidden" name="ticket_id" id="ticket_id">
            <input type="hidden" name="action" id="adjustAction">
            <div class="mb-4">
                <label for="jumlah_kuota" class="block text-sm font-medium text-gray-700">Jumlah</label>
                <input type="number" name="jumlah_kuota" id="jumlah_kuota" min="1" required
                    class="mt-1 p-2 w-full border border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200">
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
</div>

<!-- Modal Script -->
<script>
    function openEditStatusModal(order) {
        document.getElementById('edit_transaction_id').value = order.transaction_id;
        document.getElementById('edit_total_ticket').value = order.total_ticket;
        document.getElementById('edit_ordering_date').value = order.ordering_date;
        document.getElementById('edit_status_id').value = order.status_id;

        const form = document.getElementById('editStatusForm');
        form.action = `/pemesanan/update-status/${order.transaction_id}`;

        document.getElementById('editStatusModal').classList.remove('hidden');
        document.getElementById('editStatusModal').classList.add('flex');
    }

    function closeEditStatusModal() {
        document.getElementById('editStatusModal').classList.remove('flex');
        document.getElementById('editStatusModal').classList.add('hidden');
    }

    function openModal() {
        document.getElementById('kuotaModal').classList.remove('hidden');
        document.getElementById('kuotaModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('kuotaModal').classList.remove('flex');
        document.getElementById('kuotaModal').classList.add('hidden');
    }

    function openAdjustModal(ticketId, ticketName, action) {
        document.getElementById('adjustModal').classList.remove('hidden');
        document.getElementById('adjustModal').classList.add('flex');

        document.getElementById('adjustModalTitle').innerText = (action === 'tambah' ? 'Tambah' : 'Kurangi') + ' Kuota: ' + ticketName;
        document.getElementById('ticket_id').value = ticketId;
        document.getElementById('adjustAction').value = action;

        const form = document.getElementById('adjustForm');
        form.action = `/tiket/kuota/${ticketId}/${action}`;
    }

    function closeAdjustModal() {
        document.getElementById('adjustModal').classList.remove('flex');
        document.getElementById('adjustModal').classList.add('hidden');
    }
</script>
@endsection
