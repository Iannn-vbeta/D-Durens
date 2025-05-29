@if (Route::has('login'))
<nav class="flex items-center justify-between px-6 py-4 md:px-8 md:py-4 max-w-7xl mx-auto">
    <div class="flex-shrink-0">
        <img src="{{ asset('img/logo2.png') }}" alt="Logo" class="w-24 md:w-32">
    </div>
    <div>
        @auth
            <a href="{{ url('/dashboard') }}"
                class="rounded-md
                    px-3 py-2 text-sm font-medium
                    md:px-6 md:py-3 md:text-base md:font-semibold
                    bg-gray-100 text-gray-700 hover:bg-gray-200
                    dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600
                    dark:focus:ring-white focus:outline-none focus:ring-2 focus:ring-[#FF2D20]">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}"
                class="rounded-md
                    px-3 py-2 text-sm font-medium
                    md:px-6 md:py-3 md:text-base md:font-semibold
                    bg-green-600 text-white hover:bg-green-700">
                Masuk Sekarang
            </a>
        @endauth
    </div>
</nav>
@endif
