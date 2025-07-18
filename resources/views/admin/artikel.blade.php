@extends('layouts.adminEnvironment')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Manajemen Artikel</h1>

        @if (session('success'))
            <div class="bg-green-200 text-green-700 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <button onclick="openModal('addModal')" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">
            Tambah Artikel
        </button>

        <table class="w-full border border-gray-300 table-fixed">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2 w-1/6">Judul</th>
                    <th class="border p-2 w-24">Gambar</th>
                    <th class="border p-2 w-2/5">Deskripsi</th>
                    <th class="border p-2 w-1/5">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($artikels as $artikel)
                    <tr>
                        <td class="border p-2 truncate">{{ $artikel->title }}</td>
                        <td class="border p-2">
                            @if ($artikel->image)
                                <img src="{{ asset('storage/' . $artikel->image) }}" class="w-16 h-16 object-cover mx-auto">
                            @endif
                        </td>
                        <td class="border p-2 truncate">{{ $artikel->description }}</td>
                        <td class="border p-2">
                            <!-- Button Edit -->
                            <button
                                onclick="openEditModal({{ $artikel->article_id }}, '{{ $artikel->title }}', `{{ $artikel->description }}`)"
                                class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>

                            <!-- Hapus -->
                        <button
                            onclick="confirmDelete({{ $artikel->article_id }})"
                            class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div id="addModal" class="fixed inset-0 hidden bg-black bg-opacity-50 z-50">
        <div class="bg-white w-1/2 mx-auto mt-20 p-6 rounded">
            <h2 class="text-xl font-bold mb-4">Tambah Artikel</h2>
            <form method="POST" action="{{ route('artikel.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="text" name="title" placeholder="Judul" class="w-full border p-2 mb-2" required>
                <textarea name="description" rows="4" placeholder="Deskripsi" class="w-full border p-2 mb-2" required></textarea>
                <input type="file" name="image" class="w-full border p-2 mb-4">
                <button class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                <button type="button" onclick="closeModal('addModal')" class="ml-2 text-gray-700">Batal</button>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 hidden bg-black bg-opacity-50 z-50">
        <div class="bg-white w-1/2 mx-auto mt-20 p-6 rounded">
            <h2 class="text-xl font-bold mb-4">Edit Artikel</h2>
            <form method="POST" action="" id="editForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="text" name="title" id="editTitle" class="w-full border p-2 mb-2" required>
                <textarea name="description" id="editDeskripsi" rows="4" class="w-full border p-2 mb-2" required></textarea>
                <input type="file" name="image" class="w-full border p-2 mb-4">
                <button class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
                <button type="button" onclick="closeModal('editModal')" class="ml-2 text-gray-700">Batal</button>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="confirmDeleteModal" class="fixed inset-0 bg-black bg-opacity-40 hidden justify-center items-center z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h3>
            <p class="text-sm text-gray-600 mb-6">Yakin ingin menghapus data ini?</p>
            <div class="flex justify-end gap-3">
                <button id="cancelDeleteBtn" class="px-4 py-2 rounded text-gray-600 hover:text-gray-800">Batal</button>
                <form method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>



    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function openEditModal(id, title, description)
        {
            document.getElementById('editTitle').value = title;
            document.getElementById('editDeskripsi').value = description;

            // Gunakan route helper Laravel untuk URL update dengan mengganti :id
            const url = "{{ route('artikel.update', ':id') }}".replace(':id', id);
            document.getElementById('editForm').action = url;

            openModal('editModal');
        }


        function confirmDelete(id)
        {
            const url = "{{ route('artikel.destroy', ':id') }}".replace(':id', id);
            document.getElementById('deleteForm').action = url;
            document.getElementById('confirmDeleteModal').classList.remove('hidden');
            document.getElementById('confirmDeleteModal').classList.add('flex');
        }

        document.getElementById('cancelDeleteBtn').addEventListener('click', function () {
            document.getElementById('confirmDeleteModal').classList.remove('flex');
            document.getElementById('confirmDeleteModal').classList.add('hidden');
        });

    </script>
@endsection
