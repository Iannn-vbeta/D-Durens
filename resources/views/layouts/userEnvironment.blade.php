<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>D-Durens</title>
        <link
            rel="icon"
            href="{{ asset('img/logoDurian.png') }}"
            type="image/png"
        />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        @vite('resources/css/app.css')
        <style>
            html {
                scroll-behavior: smooth;
            }
        </style>
            <style>

    </style>
    </head>
    <body class="min-h-screen flex flex-col">
        @include('components.navbarDashboardUser')

        <main class="flex-grow">
            @yield('content')
        </main>

        @include('components.footerDashboard')

        <script src="https://unpkg.com/scrollreveal"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                ScrollReveal().reveal('.flex-col, .rounded-lg, .text-center, .font-bold, .p-4', {
                    distance: '40px',
                    duration: 900,
                    easing: 'ease-in-out',
                    origin: 'bottom',
                    interval: 120,
                    reset: false
                });
            });
        </script>
    </body>

</html>
