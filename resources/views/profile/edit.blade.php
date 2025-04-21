<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Profile</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <header>
            <nav class="bg-white shadow-md px-6">
                <div class="container mx-auto py-4 flex justify-between items-center">
                    <!-- Logo -->
                    <div class="flex items-center ml-16"> <!-- Tambahkan margin kiri lebih besar -->
                        <a href="#" class="text-xl font-bold text-gray-800">Logo</a>
                    </div>

                    <!-- Hamburger Menu -->
                    <div class="md:hidden">
                        <button id="hamburger" class="text-gray-800 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Navigation Links -->
                    <div id="nav-links" class="hidden md:flex space-x-8 items-center mr-12">
                        <!-- Tambahkan margin kanan lebih besar -->
                        <a href="{{ route('dashboard') }}" class="text-gray-800 hover:text-blue-500">Home</a>
                        <a href="{{ route('dashboard', ['#aboutus']) }}" class="text-gray-800 hover:text-blue-500">About
                            Us</a>
                        <a href="{{ route('dashboard', ['#artikel']) }}"
                            class="text-gray-800 hover:text-blue-500">Artikel</a>
                        <a href="#" class="text-gray-800 hover:text-blue-500">Pricing</a>

                        <!-- Dropdown for Screening -->
                        <div class="relative group">
                            <button class="text-gray-800 hover:text-blue-500 focus:outline-none">Screening</button>
                            <div class="absolute hidden group-hover:block bg-white shadow-md mt-2 rounded-md">
                                <a href="{{ route('screening') }}"
                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Screening
                                    Penyakit</a>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Screening
                                    Jenis
                                    Buah</a>
                            </div>
                        </div>

                        <!-- Dropdown for Username -->
                        <div class="relative group ml-12"> <!-- Tambahkan margin kiri lebih besar untuk gap -->
                            <button class="text-gray-800 hover:text-blue-500 focus:outline-none">
                                {{ Auth::user()->username ?? 'Guest' }}
                            </button>
                            <div class="absolute hidden group-hover:block bg-white shadow-md mt-2 rounded-md">
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>

</html>

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
