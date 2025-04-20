<x-guest-layout>
    <div class="flex flex-wrap w-100 h-50">
        <!-- Container -->
        <div class="flex flex-1">
            <!-- Form Login (Left Side) -->
            <div class="w-full md:w-1/2 flex items-center justify-center p-8">
                <!-- Session Status -->
                <x-auth-session-status :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="w-full max-w-md">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <x-input-label for="username" :value="__('Username')" />
                        <x-text-input id="username" type="text" name="username" :value="old('username')" required autofocus
                            autocomplete="off" class="block w-full mt-1" />
                        <x-input-error :messages="$errors->get('username')" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" type="password" name="password" required
                            autocomplete="current-password" class="block w-full mt-1" />
                        <x-input-error :messages="$errors->get('password')" />
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-4 flex items-center">
                        <label for="remember_me" class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" class="mr-2">
                            <span>{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button>
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Gambar (Right Side) -->
            <div class="hidden md:block w-1/2">
                <img src="{{ asset('img/bg-login.png') }}" alt="Login Image" class="object-cover w-full  h-full">
            </div>
        </div>
    </div>
</x-guest-layout>
