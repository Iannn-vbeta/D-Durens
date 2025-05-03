<x-layout.original>
    <div class="max-w-7xl mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Daftar Akun User</h2>
            <button onclick="openModal('addUserModal')"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Tambah Data</button>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2">Username</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-4 py-2">{{ $user->username }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <button
                                    onclick="openEditModal({{ $user->id }}, '{{ $user->username }}', '{{ $user->email }}')"
                                    class="text-yellow-600 hover:underline">Edit</button>
                                <form action="{{ route('akunUser.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah User --}}
    <div id="addUserModal" class="fixed inset-0 bg-black bg-opacity-30 items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h3 class="text-lg font-bold mb-4">Tambah User Baru</h3>
            <form action="{{ route('akunAdmin.store') }}" method="POST" class="space-y-4"
                onsubmit="return validatePasswords()">
                @csrf
                <input type="text" name="username" required placeholder="Username"
                    class="w-full border border-gray-300 p-2 rounded">
                <input type="email" name="email" required placeholder="Email"
                    class="w-full border border-gray-300 p-2 rounded">
                <input type="password" name="password" id="password" required placeholder="Password"
                    class="w-full border border-gray-300 p-2 rounded">
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    placeholder="Konfirmasi Password" class="w-full border border-gray-300 p-2 rounded">
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal('addUserModal')" class="text-gray-500">Batal</button>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit User --}}
    <div id="editUserModal" class="fixed inset-0 bg-black bg-opacity-30 items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h3 class="text-lg font-bold mb-4">Edit User</h3>
            <form id="editUserForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="text" name="username" id="editUsername" required
                    class="w-full border border-gray-300 p-2 rounded">
                <input type="email" name="email" id="editEmail" required
                    class="w-full border border-gray-300 p-2 rounded">
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal('editUserModal')" class="text-gray-500">Batal</button>
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
                </div>
            </form>

        </div>
    </div>

    {{-- Modal Scripts --}}
    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function openEditModal(id, username, email) {
            openModal('editUserModal');
            document.getElementById('editUsername').value = username;
            document.getElementById('editEmail').value = email;

            const form = document.getElementById('editUserForm');
            form.action = `/akun-user/${id}`;
        }

        function validatePasswords() {
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            if (password !== passwordConfirmation) {
                alert('Password dan Konfirmasi Password tidak cocok!');
                return false;
            }
            return true;
        }
    </script>
</x-layout.original>
