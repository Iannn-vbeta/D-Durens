@extends('layouts.original')
@section('main')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Daftar Inventaris</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        <button id="openCreateModalButton" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-6">
            Tambah Inventaris
        </button>

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Nama Barang</th>
                        <th class="px-4 py-2">Kategori</th>
                        <th class="px-4 py-2">Jumlah</th>
                        <th class="px-4 py-2">Lokasi</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($inventaris as $index => $item)
                        <tr>
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $item->nama_barang }}</td>
                            <td class="px-4 py-2">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item->jumlah }}</td>
                            <td class="px-4 py-2">{{ $item->lokasi->nama_lokasi ?? '-' }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <button class="editModalButton text-yellow-600 hover:underline"
                                    data-id="{{ $item->id }}">Edit</button>
                                <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus inventaris ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Modal Section --}}
        <div id="modals">
            {{-- Create Modal --}}
            <div id="createModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
                    <button id="closeCreateModalButton"
                        class="absolute top-2 right-2 text-gray-500 hover:text-black text-xl">&times;</button>
                    <h2 class="text-xl font-semibold mb-4">Tambah Inventaris Baru</h2>
                    <form action="{{ route('inventaris.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block font-medium text-sm mb-1">Nama Barang</label>
                            <input type="text" name="nama_barang" class="w-full border border-gray-300 rounded px-3 py-2"
                                required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-sm mb-1">Kategori</label>
                            <select name="kategori_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-sm mb-1">Jumlah</label>
                            <input type="number" name="jumlah" class="w-full border border-gray-300 rounded px-3 py-2"
                                required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-sm mb-1">Lokasi</label>
                            <select name="lokasi_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="">Pilih Lokasi</option>
                                @foreach ($lokasis as $lokasi)
                                    <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Edit Modals --}}
            @foreach ($inventaris as $item)
                <div id="editModal-{{ $item->id }}"
                    class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
                        <button class="closeEditModalButton absolute top-2 right-2 text-gray-500 hover:text-black text-xl"
                            data-id="{{ $item->id }}">&times;</button>
                        <h2 class="text-xl font-semibold mb-4">Edit Inventaris</h2>
                        <form action="{{ route('inventaris.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block font-medium text-sm mb-1">Nama Barang</label>
                                <input type="text" name="nama_barang"
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    value="{{ $item->nama_barang }}" required>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium text-sm mb-1">Kategori</label>
                                <select name="kategori_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ $item->kategori_id == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium text-sm mb-1">Jumlah</label>
                                <input type="number" name="jumlah" class="w-full border border-gray-300 rounded px-3 py-2"
                                    value="{{ $item->jumlah }}" required>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium text-sm mb-1">Lokasi</label>
                                <select name="lokasi_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                    @foreach ($lokasis as $lokasi)
                                        <option value="{{ $lokasi->id }}"
                                            {{ $item->lokasi_id == $lokasi->id ? 'selected' : '' }}>
                                            {{ $lokasi->nama_lokasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- JavaScript untuk toggle modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const createModal = document.getElementById('createModal');
            const openCreateModalButton = document.getElementById('openCreateModalButton');
            const closeCreateModalButton = document.getElementById('closeCreateModalButton');

            openCreateModalButton.addEventListener('click', () => {
                createModal.classList.remove('hidden');
            });

            closeCreateModalButton.addEventListener('click', () => {
                createModal.classList.add('hidden');
            });

            const editModalButtons = document.querySelectorAll('.editModalButton');
            const closeEditModalButtons = document.querySelectorAll('.closeEditModalButton');

            editModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const modalId = button.getAttribute('data-id');
                    const modal = document.getElementById(`editModal-${modalId}`);
                    modal.classList.remove('hidden');
                });
            });

            closeEditModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const modalId = button.getAttribute('data-id');
                    const modal = document.getElementById(`editModal-${modalId}`);
                    modal.classList.add('hidden');
                });
            });
        });
    </script>
@endsection
