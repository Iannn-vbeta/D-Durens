@extends('layouts.original')
@section('main')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Inventaris</h1>
        <div class="mb-4">
            <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Inventaris</a>
        </div>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Nama</th>
                    <th class="py-2 px-4 border-b">Jumlah</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventaris as $item)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $item->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->nama }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->jumlah }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="#" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                            |
                            <form action="#" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $inventaris->links() }}
    </div>
@endsection
