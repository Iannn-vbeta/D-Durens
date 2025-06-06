@extends('layouts.adminEnvironment')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Kuota Tiket</h2>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full text-sm text-left border border-gray-200">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-2 border">Nama Tiket</th>
                    <th class="px-4 py-2 border">Kuota</th>
                    <th class="px-4 py-2 border">Harga</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach ($namaTiket as $i => $t)
                <tr class="hover:bg-gray-50">
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

<script>
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
