<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin Dashboard</title>
        @vite(['resources/css/app.css'])
    </head>

    <body class="h-screen flex flex-col">
        <!-- Topbar -->
        <div class="bg-gray-100 border-b border-gray-300 p-4 flex justify-end">
            <div class="relative">
                <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 focus:outline-none"
                    id="userMenuButton">
                    {{ Auth::user()->username }}
                </button>
                <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded shadow-lg hidden"
                    id="userMenuDropdown">
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>

            <script>
                document.addEventListener('click', function(event) {
                    const button = document.getElementById('userMenuButton');
                    const dropdown = document.getElementById('userMenuDropdown');

                    if (button.contains(event.target)) {
                        dropdown.classList.toggle('hidden');
                    } else if (!dropdown.contains(event.target)) {
                        dropdown.classList.add('hidden');
                    }
                });
            </script>
        </div>

        <div class="flex flex-1">
            <!-- Sidebar -->
            <div class="w-64 bg-gray-800 text-white p-4">
                <h4 class="text-lg font-bold mb-4">Admin Panel</h4>
                <nav>
                    <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a>
                    <a href="{{ route('admin.akunUser') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Akun
                        Users</a>
                    <a href="{{ route('admin.akunAdmin') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Akun
                        Admin</a>
                    <a href="{{ route('admin.artikel') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Artikel</a>
                </nav>
            </div>

            <!-- Content -->
            <div class="flex-1 flex flex-col">
                <!-- Main Content -->
                <div class="p-6 overflow-y-auto flex-1">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>

</html>
