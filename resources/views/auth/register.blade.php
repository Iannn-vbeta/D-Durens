<x-guest-layout>
<div class="flex flex-wrap w-full min-h-screen bg-gray-100">
    <!-- Container -->
    <div class="flex flex-1 bg-white shadow-lg rounded-lg overflow-hidden m-4 md:m-20">
        <!-- Form Register (Left Side) -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-12">
            <form method="POST" action="{{ route('register') }}" class="w-full max-w-md">
                @csrf

                <!-- Username -->
                <div class="mb-4">
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input
                        id="username"
                        class="block w-full max-w-full mt-2 border border-gray-300 rounded-md shadow-sm"
                        type="text"
                        name="username"
                        :value="old('username')"
                        required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input
                        id="email"
                        class="block w-full max-w-full mt-2 border border-gray-300 rounded-md shadow-sm"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input
                        id="password"
                        class="block w-full max-w-full mt-2 border border-gray-300 rounded-md shadow-sm"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input
                        id="password_confirmation"
                        class="block w-full max-w-full mt-2 border border-gray-300 rounded-md shadow-sm"
                        type="password"
                        name="password_confirmation"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Already Registered Link and Register Button -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('login') }}"
                       class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- Gambar (Right Side) -->
        <div class="hidden md:block md:w-1/2 bg-cover bg-center rounded-r-lg"
             style="background-image: url('{{ asset('img/bg-login.png') }}'); min-height: 400px;">
        </div>
    </div>
</div>

</x-guest-layout>
