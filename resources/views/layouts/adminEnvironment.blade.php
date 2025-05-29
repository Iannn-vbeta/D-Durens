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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        @vite('resources/css/app.css')
        <style>
            html {
                scroll-behavior: smooth;
            }
        </style>
            <style>

    </style>
    </head>
    <body>
        <div class="flex min-h-screen">
            @include('components.sidebarDashboardAdmin')
            <main class="flex-1 p-6">
            @yield('content')
            </main>
        </div>
    </body>

</html>
