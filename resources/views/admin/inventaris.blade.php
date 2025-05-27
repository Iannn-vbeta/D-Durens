{{-- @extends('layouts.original')
@section('main')
    <div class="max-w-7xl mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Daftar Inventaris</h2>
            <button onclick="openModal('addModal')"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Tambah Inventaris</button>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Item</th>
                        <th class="px-4 py-2">Jumlah</th>
                        <th class="px-4 py-2">User</th>
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
                            <td class="px-4 py-2">{{ $item->user->username ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item->kategoriBarang->category_name }}</td>
                            <td class="px-4 py-2">{{ $item->ketersediaan->status }}</td>
                            <td class="px-4 py-2">{{ $item->kelayakan->status }}</td>
                            <td class="px-4 py-2">{{ $item->deskripsi }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <button onclick="openEditModal({{ $item->inventory_id }}, @json($item))"
                                    class="text-yellow-600 hover:underline">Edit</button>
                                <form action="{{ route('inventaris.destroy', $item->inventory_id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus data ini?')">
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

    {{-- Modal Tambah --}}
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-30 items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
        <h3 class="text-lg font-bold mb-4">Tambah Inventaris</h3>
        <form action="{{ route('inventaris.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="text" name="item_name" placeholder="Nama Item" class="w-full border p-2 rounded" required>
            <input type="number" name="amount" placeholder="Jumlah" class="w-full border p-2 rounded" required>
            <select name="user_id" class="w-full border p-2 rounded" required>
                <option value="">Pilih User</option>
                @foreach ($users as $u)
                    <option value="{{ $u->id }}">{{ $u->username }}</option>
                @endforeach
            </select>
            <select name="category_id" class="w-full border p-2 rounded" required>
                <option value="">Pilih Kategori</option>
                @foreach ($kategori as $k)
                    <option value="{{ $k->category_id }}">{{ $k->category_name }}</option>
                @endforeach
            </select>
            <select name="ketersediaan_id" class="w-full border p-2 rounded" required>
                <option value="">Status Ketersediaan</option>
                @foreach ($ketersediaan as $ks)
                    <option value="{{ $ks->ketersediaan_id }}">{{ $ks->status }}</option>
                @endforeach
            </select>
            <select name="kelayakan_id" class="w-full border p-2 rounded" required>
                <option value="">Status Kelayakan</option>
                @foreach ($kelayakan as $kl)
                    <option value="{{ $kl->kelayakan_id }}">{{ $kl->status }}</option>
                @endforeach
            </select>
            <textarea name="deskripsi" placeholder="Deskripsi (opsional)" class="w-full border p-2 rounded"></textarea>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('addModal')" class="text-gray-500">Batal</button>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit --}}
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-30 items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
        <h3 class="text-lg font-bold mb-4">Edit Inventaris</h3>
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="text" name="item_name" id="editItemName" class="w-full border p-2 rounded" required>
            <input type="number" name="amount" id="editAmount" class="w-full border p-2 rounded" required>
            <select name="user_id" id="editUserId" class="w-full border p-2 rounded" required>
                @foreach ($users as $u)
                    <option value="{{ $u->id }}">{{ $u->username }}</option>
                @endforeach
            </select>
            <select name="category_id" id="editCategoryId" class="w-full border p-2 rounded" required>
                @foreach ($kategori as $k)
                    <option value="{{ $k->category_id }}">{{ $k->category_name }}</option>
                @endforeach
            </select>
            <select name="ketersediaan_id" id="editKetersediaanId" class="w-full border p-2 rounded" required>
                @foreach ($ketersediaan as $ks)
                    <option value="{{ $ks->ketersediaan_id }}">{{ $ks->status }}</option>
                @endforeach
            </select>
            <select name="kelayakan_id" id="editKelayakanId" class="w-full border p-2 rounded" required>
                @foreach ($kelayakan as $kl)
                    <option value="{{ $kl->kelayakan_id }}">{{ $kl->status }}</option>
                @endforeach
            </select>
            <textarea name="deskripsi" id="editDeskripsi" class="w-full border p-2 rounded"></textarea>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editModal')" class="text-gray-500">Batal</button>
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Script --}}
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.getElementById(id).classList.add('flex');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.getElementById(id).classList.remove('flex');
    }

    function openEditModal(id, data) {
        openModal('editModal');
        const form = document.getElementById('editForm');
        form.action = `/inventaris/${id}`;
        document.getElementById('editItemName').value = data.item_name;
        document.getElementById('editAmount').value = data.amount;
        document.getElementById('editUserId').value = data.user_id;
        document.getElementById('editCategoryId').value = data.category_id;
        document.getElementById('editKetersediaanId').value = data.ketersediaan_id;
        document.getElementById('editKelayakanId').value = data.kelayakan_id;
        document.getElementById('editDeskripsi').value = data.deskripsi;
    }
</script>
@endsection --}}
