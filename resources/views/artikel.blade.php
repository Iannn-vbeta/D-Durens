@extends('layouts.userEnvironment')
@section('content')
    <div class="max-w-2xl mx-auto p-4">
        <h1 class="text-3xl font-bold">{{ $artikel->title }}</h1>
        <p class="text-gray-600 text-sm mb-4">Diposting pada: {{ $artikel->created_at }}</p>
        <img src="{{ asset('storage/' . $artikel->image) }}" alt="" class="w-full my-4">
        <p class="text-gray-800">{{ $artikel->description }}</p>
    </div>
@endsection
