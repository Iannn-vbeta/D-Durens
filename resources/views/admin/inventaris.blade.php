@extends('layouts.adminEnvironment')
@section('title', 'Inventaris')
@section('content')


    <div class="max-w-7xl mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Daftar Inventaris</h2>
            <button onclick="openModal('addInventarisModal')"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Tambah Data
            </button>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2">Item</th>
                        <th class="px-4 py-2">Jumlah</th>
                        <th class="px-4 py-2">Kategori</th>
                        <th class="px-4 py-2">Ketersediaan</th>
                        <th class="px-4 py-2">Kelayakan</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($inventaris as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item->item_name }}</td>
                            <td class="px-4 py-2">{{ $item->amount }}</td>
                            <td class="px-4 py-2">{{ $item->kategoriBarang->category_name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item->ketersediaan->status ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item->kelayakan->status ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item->deskripsi }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <button onclick="openEditModal({{ $item->inventory_id }}"
                                    class="text-yellow-600 hover:underline">Edit</button>
                                <form action="{{ route('inventaris.destroy', $item->inventory_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-red-600 hover:underline deleteBtn">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah Inventaris --}}
    <div id="addInventarisModal" class="fixed inset-0 bg-black bg-opacity-30 items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h3 class="text-lg font-bold mb-4">Tambah Inventaris</h3>
            <form action="{{ route('inventaris.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="item_name" required placeholder="Nama Item" class="w-full border p-2 rounded">
                <input type="number" name="amount" required placeholder="Jumlah" class="w-full border p-2 rounded">
                <select name="category_id" required class="w-full border p-2 rounded">
                    <option value="1">Elektronik</option>
                    <option value="2">Perlengkapan</option>
                </select>
                <select name="ketersediaan_id" required class="w-full border p-2 rounded">
                    <option value="1">Tersedia</option>
                    <option value="2">Tidak Tersedia</option>
                </select>
                <select name="kelayakan_id" required class="w-full border p-2 rounded">
                    <option value="KL001">Layak</option>
                    <option value="KL002">Tidak Layak</option>
                </select>
                <textarea name="deskripsi" placeholder="Deskripsi (opsional)" class="w-full border p-2 rounded"></textarea>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal('addInventarisModal'), " class="text-gray-500">Batal</button>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit Inventaris --}}
    <div id="editInventarisModal" class="fixed inset-0 bg-black bg-opacity-30 items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h3 class="text-lg font-bold mb-4">Edit Inventaris</h3>
            <form id="editInventarisForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="text" name="item_name" id="editItemName" required class="w-full border p-2 rounded">
                <input type="number" name="amount" id="editAmount" required class="w-full border p-2 rounded">
                <select name="category_id" id="editCategoryId" required class="w-full border p-2 rounded">
                    @foreach ($kategoriBarang as $k)
                        <option value="{{ $k->category_id }}">{{ $k->category_name }}</option>
                    @endforeach
                </select>
                <select name="ketersediaan_id" id="editKetersediaanId" required class="w-full border p-2 rounded">
                    @foreach ($ketersediaan as $ks)
                        <option value="{{ $ks->ketersediaan_id }}">{{ $ks->status }}</option>
                    @endforeach
                </select>
                <select name="kelayakan_id" id="editKelayakanId" required class="w-full border p-2 rounded">
                    @foreach ($kelayakan as $kl)
                        <option value="{{ $kl->kelayakan_id }}">{{ $kl->status }}</option>
                    @endforeach
                </select>
                <textarea name="deskripsi" id="editDeskripsi" class="w-full border p-2 rounded"></textarea>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal('editInventarisModal')" class="text-gray-500">Batal</button>
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div id="confirmDeleteModal" class="fixed inset-0 bg-black bg-opacity-40 hidden justify-center items-center z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h3>
            <p class="text-sm text-gray-600 mb-6">Yakin ingin menghapus data ini?</p>
            <div class="flex justify-end gap-3">
                <button id="cancelDeleteBtn" class="px-4 py-2 rounded text-gray-600 hover:text-gray-800">Batal</button>
                <button id="confirmDeleteBtn"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
            </div>
        </div>
    </div>


    {{-- Script Modal --}}
    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function openEditModal(id, data) {
            openModal('editInventarisModal');
            const form = document.getElementById('editInventarisForm');
            form.action = `/inventaris/${id}`;
            document.getElementById('editItemName').value = data.item_name;
            document.getElementById('editAmount').value = data.amount;
            document.getElementById('editCategoryId').value = data.category_id;
            document.getElementById('editKetersediaanId').value = data.ketersediaan_id;
            document.getElementById('editKelayakanId').value = data.kelayakan_id;
            document.getElementById('editDeskripsi').value = data.deskripsi;
        }

        let currentForm = null;

        document.querySelectorAll('.deleteBtn').forEach(button => {
            button.addEventListener('click', function(e) {
                currentForm = this.closest('form');
                document.getElementById('confirmDeleteModal').classList.remove('hidden');
                document.getElementById('confirmDeleteModal').classList.add('flex');
            });
        });

        document.getElementById('cancelDeleteBtn').addEventListener('click', function() {
            document.getElementById('confirmDeleteModal').classList.add('hidden');
            document.getElementById('confirmDeleteModal').classList.remove('flex');
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (currentForm) {
                currentForm.submit();
            }
        });
    </script>
@endsection
