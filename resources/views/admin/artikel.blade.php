@extends('layouts.adminEnvironment')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Daftar Artikel Wisata</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        <button id="openCreateModalButton" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-6">
            Tambah Artikel
        </button>

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Judul</th>
                        <th class="px-4 py-2">Gambar</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($artikels as $index => $artikel)
                        <tr>
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $artikel->title }}</td>
                            <td class="px-4 py-2">
                                <img src="{{ asset("storage/{$artikel->image}") }}" class="w-16 h-auto rounded">
                            </td>
                            <td class="px-4 py-2">{{ $artikel->description }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <button class="editModalButton text-yellow-600 hover:underline"
                                    data-id="{{ $artikel->article_id }}">Edit</button>
                                <form action="{{ route('artikel.destroy', $artikel->article_id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
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
                    <h2 class="text-xl font-semibold mb-4">Tambah Artikel Baru</h2>
                    <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="block font-medium text-sm mb-1">Judul</label>
                            <input type="text" name="title" class="w-full border border-gray-300 rounded px-3 py-2"
                                required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-sm mb-1">Deskripsi</label>
                            <textarea name="description" class="w-full border border-gray-300 rounded px-3 py-2" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-sm mb-1">Gambar</label>
                            <input type="file" name="image" class="w-full border border-gray-300 rounded px-3 py-2"
                                required>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Edit Modals --}}
            @foreach ($artikels as $artikel)
                <div id="editModal-{{ $artikel->article_id }}"
                    class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
                        <button class="closeEditModalButton absolute top-2 right-2 text-gray-500 hover:text-black text-xl"
                            data-id="{{ $artikel->article_id }}">&times;</button>
                        <h2 class="text-xl font-semibold mb-4">Edit Artikel</h2>
                        <form action="{{ route('artikel.update', $artikel->article_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block font-medium text-sm mb-1">Judul</label>
                                <input type="text" name="title" class="w-full border border-gray-300 rounded px-3 py-2"
                                    value="{{ $artikel->title }}" required>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium text-sm mb-1">Deskripsi</label>
                                <textarea name="description" class="w-full border border-gray-300 rounded px-3 py-2" required>{{ $artikel->description }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium text-sm mb-1">Ganti Gambar (Opsional)</label>
                                <input type="file" name="image"
                                    class="w-full border border-gray-300 rounded px-3 py-2">
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
