<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css') <!-- Pastikan Anda sudah mengatur Tailwind CSS -->
</head>
<body class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-100">
    <header class="shadow bg-green-200">
        @if (Route::has('login'))
            <nav class="grid grid-cols-2 items-center justify-between p-">
                <div class="col-auto text-center text-neutral-900">Halo</div>
                <div class="container mx-auto flex justify-end p-4 space-x-4 col-auto">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="rounded-md px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 
                                   hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] 
                                   dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 
                                   dark:focus:ring-white"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="rounded-md px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 
                                   hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] 
                                   dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 
                                   dark:focus:ring-white"
                        >
                            Log in
                        </a>
    
                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="rounded-md px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 
                                       hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] 
                                       dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 
                                       dark:focus:ring-white"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            </nav>
        @endif
    </header>
</body>
</html>