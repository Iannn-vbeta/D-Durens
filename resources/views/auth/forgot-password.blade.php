<x-guest-layout>
    <div class="max-w-xl w-full mx-auto mt-10 bg-white p-4 sm:p-8 rounded-lg shadow-md">
        <div class="mb-6 text-sm text-gray-600 text-center">
            {{ __('Lupa password? Tidak masalah. Masukkan email kamu dan kami akan kirimkan link untuk reset password.') }}
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-primary-button class="w-full justify-center">
                    {{ __('Kirim Link Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
