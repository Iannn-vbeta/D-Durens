@extends('layouts.original')
@section('main')
<div class="max-w-7xl mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Pemesanan Tiket</h2>
        <a href="" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Tambah Data
        </a>
    </div>

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
                        <a href="" class="text-yellow-500 hover:underline">Edit</a>
                        <form action="" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                {{-- @elseif
                <tr>
                    <td colspan="9" class="px-4 py-4 text-center text-gray-500 border">Tidak ada data pemesanan.</td>
                </tr> --}}
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
