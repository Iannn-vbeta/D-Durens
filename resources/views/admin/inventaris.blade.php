@extends('layouts.original')
@section('main')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Daftar Inventaris</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tombol Tambah Inventaris -->
        <button onclick="openModal('createModal')"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-6 inline-block">
            Tambah Inventaris
        </button>

        <!-- Tabel Inventaris -->
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Jumlah</th>
                        <th class="px-4 py-2">Kategori</th>
                        <th class="px-4 py-2">Ketersediaan</th>
                        <th class="px-4 py-2">Kelayakan</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($inventaris as $index => $item)
                        <tr>
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $item->item_name }}</td>
                            <td class="px-4 py-2">{{ $item->amount }}</td>
                            <td class="px-4 py-2">{{ $item->kategoriBarang->category_name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item->ketersediaan->status ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item->kelayakan->status ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item->deskripsi ?? '-' }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <!-- Tombol Edit -->
                                <button
                                    onclick="openEditModal({{ $item->id }}, '{{ addslashes($item->item_name) }}', {{ $item->amount }}, {{ $item->kategoriBarang->id ?? 'null' }}, {{ $item->ketersediaan->id ?? 'null' }}, {{ $item->kelayakan->id ?? 'null' }})"
                                    class="text-yellow-600 hover:underline">Edit</button>
                                <!-- Tombol Hapus -->
                                <form action="#" method="POST"
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
    </div>

    <!-- Modal Tambah Inventaris -->
    <div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded shadow w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Tambah Inventaris</h2>
            <form action="#" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="block mb-1">Nama Barang</label>
                    <input type="text" name="item_name" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block mb-1">Jumlah</label>
                    <input type="number" name="amount" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block mb-1">Kategori</label>
                    <select name="kategori_barang_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}">{{ $kat->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block mb-1">Ketersediaan</label>
                    <select name="ketersediaan_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">Pilih Status</option>
                        @foreach ($ketersediaan as $stat)
                            <option value="{{ $stat->id }}">{{ $stat->status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block mb-1">Kelayakan</label>
                    <select name="kelayakan_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">Pilih Status</option>
                        @foreach ($kelayakan as $kel)
                            <option value="{{ $kel->id }}">{{ $kel->status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block mb-1">Deskripsi</label>
                    <textarea name="deskripsi" class="w-full border rounded px-3 py-2" rows="4"></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal('createModal')"
                        class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Inventaris -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded shadow w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Edit Inventaris</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="block mb-1">Nama Barang</label>
                    <input type="text" name="item_name" id="edit_item_name" class="w-full border rounded px-3 py-2"
                        required>
                </div>
                <div class="mb-3">
                    <label class="block mb-1">Jumlah</label>
                    <input type="number" name="amount" id="edit_amount" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block mb-1">Kategori</label>
                    <select name="kategori_barang_id" id="edit_kategori_barang_id" class="w-full border rounded px-3 py-2"
                        required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}">{{ $kat->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block mb-1">Ketersediaan</label>
                    <select name="ketersediaan_id" id="edit_ketersediaan_id" class="w-full border rounded px-3 py-2"
                        required>
                        <option value="">Pilih Status</option>
                        @foreach ($ketersediaan as $stat)
                            <option value="{{ $stat->id }}">{{ $stat->status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block mb-1">Kelayakan</label>
                    <select name="kelayakan_id" id="edit_kelayakan_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">Pilih Status</option>
                        @foreach ($kelayakan as $kel)
                            <option value="{{ $kel->id }}">{{ $kel->status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal('editModal')"
                        class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function openEditModal(id, name, amount, kategori, ketersediaan, kelayakan) {
            openModal('editModal');
            document.getElementById('edit_item_name').value = name;
            document.getElementById('edit_amount').value = amount;
            document.getElementById('edit_kategori_barang_id').value = kategori;
            document.getElementById('edit_ketersediaan_id').value = ketersediaan;
            document.getElementById('edit_kelayakan_id').value = kelayakan;
            document.getElementById('editForm').action = '/inventaris/' + id;
        }
    </script>
@endsection
