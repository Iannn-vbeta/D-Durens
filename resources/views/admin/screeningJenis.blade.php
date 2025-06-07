@extends('layouts.adminEnvironment')

@section('content')
<div class="bg-white flex flex-col items-center justify-center min-h-screen p-4">
    <h2 class="text-lg font-semibold mb-6">Screening Jenis Durian</h2>

    <form action="/screening-jenis" method="POST" enctype="multipart/form-data"
          class="w-full max-w-md flex flex-col items-center gap-4">
        @csrf
        <div class="flex flex-col w-full">
            <div class="flex items-center border-2 border-gray-300 rounded-lg px-4 py-2 w-full">
                <label for="durian_image" class="bg-green-700 text-white px-4 py-2 rounded cursor-pointer">
                    Choose File
                </label>
                <input id="durian_image" type="file" name="durian_image" class="hidden"
                    onchange="updateFileName()" required>
                <span id="file-name" class="ml-4 text-gray-600 truncate">No file chosen</span>
            </div>
            @error('durian_image')
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
            <span id="upload-error" class="text-red-500 text-sm mt-2 hidden">Silakan pilih file gambar durian terlebih dahulu.</span>
        </div>

        <button type="submit" onclick="return validateForm()" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800">

            Scan
        </button>

        <div class="border border-black rounded p-2 bg-gray-50 inline-flex items-center justify-center max-w-full overflow-auto">
            @if (session('success'))
                <img src="{{ asset('storage/hasil_deteksi/' . session('filename')) }}" alt="Hasil Deteksi"
                     class="object-contain max-w-full max-h-[500px] rounded">
            @else
                <span class="text-gray-400">Hasil akan ditampilkan di sini...</span>
            @endif
        </div>

        <div class="mt-4 text-left w-full">
            <p class="font-semibold">Jenis Durian :</p>
            <p class="text-gray-600 font-semibold">
                {{ session('hasil_jenis') ?? 'Belum ada hasil deteksi.' }}
            </p>
        </div>

        <div class="mt-4 w-full flex justify-end">
            <button type="button" class="bg-green-700 text-white px-4 py-1 rounded hover:bg-green-800">
                Selesai
            </button>
        </div>
    </form>
</div>

<script>
    function updateFileName() {
        const input = document.getElementById('durian_image');
        const fileName = input.files.length > 0 ? input.files[0].name : 'No file chosen';
        document.getElementById('file-name').textContent = fileName;

        // Sembunyikan error jika file dipilih
        if (input.files.length > 0) {
            document.getElementById('upload-error').classList.add('hidden');
        }
    }

    function validateForm() {
        const fileInput = document.getElementById('durian_image');
        const errorText = document.getElementById('upload-error');

        if (fileInput.files.length === 0) {
            errorText.classList.remove('hidden'); // Tampilkan pesan error
            return false; // Cegah pengiriman form
        } else {
            errorText.classList.add('hidden'); // Sembunyikan jika tidak ada error
            return true;
        }
    }
</script>

@endsection
