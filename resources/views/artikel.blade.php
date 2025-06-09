@extends('layouts.userEnvironment')
@section('content')
<div class="max-w-2xl mx-auto p-4">
    <h1 class="text-3xl font-bold mb-2">{{ $artikel->title }}</h1>
    <p class="text-gray-600 text-sm mb-4">
        Diposting pada: {{ \Carbon\Carbon::parse($artikel->created_at)->translatedFormat('d F Y') }}
    </p>

    <img src="{{ asset('storage/' . $artikel->image) }}" alt="Gambar artikel" class="w-full rounded-lg shadow my-4">

    <div class="text-justify text-gray-800 leading-relaxed space-y-4">
        @foreach(explode("\n", $artikel->description) as $paragraf)
            <p class="indent-8">{{ $paragraf }}</p>
        @endforeach
    </div>
</div>
@endsection
