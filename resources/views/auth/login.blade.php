<x-guest-layout>
<div class="flex flex-wrap w-full min-h-screen bg-gray-100">
    <!-- Container -->
    <div class="flex flex-1 bg-white shadow-lg rounded-lg overflow-hidden m-4 md:m-20">
        <!-- Form Login (Left Side) -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-12">
            <!-- Session Status -->
            <x-auth-session-status :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="w-full max-w-md">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input
                        id="username"
                        type="text"
                        name="username"
                        :value="old('username')"
                        required autofocus
                        autocomplete="off"
                        class="block w-full max-w-full mt-2 border border-gray-300 rounded-md shadow-sm"
                    />
                    <x-input-error :messages="$errors->get('username')" />
                </div>

                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="block w-full max-w-full mt-2 border border-gray-300 rounded-md shadow-sm"
                    />
                    <x-input-error :messages="$errors->get('password')" />
                </div>

                <!-- Remember Me -->
                <div class="mb-4 flex items-center">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="mr-2 rounded border-gray-300">
                        <span>{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mb-6">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button>
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>

                <!-- Register Link -->
                <div class="mt-6 text-center">
                    <p class="text-sm">
                        {{ __("Don't have an account?") }}
                        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">
                            {{ __('Register') }}
                        </a>
                    </p>
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
