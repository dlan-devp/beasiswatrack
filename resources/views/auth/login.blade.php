<x-guest-layout>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600" name="remember">
                <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
            </label>
        </div>

        {{-- forgot pw --}}
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-black hover:text-blue-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            {{-- button login regist --}}
            <x-primary-button class="ms-3 mr-2">
                {{ __('Log in') }}
            </x-primary-button>
            
            <a href="{{ route('register') }}">
                <x-secondary-button>
                    Register
                </x-secondary-button>
            </a>
        </div>
    </form>

    {{-- back to website --}}
    <div class="mt-10 mb-5 flex justify-center items-center">
        <a href="{{ route('scholarships.index') }}">
            <x-secondary-button>
                Back TO BeasiswaTrack
            </x-secondary-button>
        </a>
    </div>
</x-guest-layout>
