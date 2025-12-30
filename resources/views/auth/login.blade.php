<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg text-blue-700" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email Address')" class="font-medium text-gray-700" />
            <x-text-input 
                id="email" 
                class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-200" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="email" 
                placeholder="Enter your email address"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Password -->
        <div class="mt-6 space-y-2">
            <x-input-label for="password" :value="__('Password')" class="font-medium text-gray-700" />
            <x-text-input 
                id="password" 
                class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-200"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
                placeholder="Enter your password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-6">
            <label for="remember_me" class="inline-flex items-center">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 transition duration-200" 
                    name="remember"
                >
                <span class="ms-2 text-sm text-gray-600 hover:text-gray-800 cursor-pointer transition duration-200">
                    {{ __('Remember me') }}
                </span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-800 font-medium transition duration-200 hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <div class="mt-3">
            <x-primary-button class="w-full justify-center py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 focus:ring-2 focus:ring-blue-300 focus:ring-offset-2 transition-all duration-200 shadow-lg shadow-blue-500/25">
                <span class="font-semibold">{{ __('Sign in to your account') }}</span>
            </x-primary-button>
        </div>

        <!-- Register Link -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-600">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-800 transition duration-200 hover:underline">
                    {{ __('Create account') }}
                </a>
            </p>
        </div>
<div class="mt-8 text-center">
    <p class="text-sm text-gray-600 mb-2">Download Aplikasi:</p>
   <a href="{{ asset('downloads/app-debug.apk') }}"
       class="inline-flex items-center px-4 py-2 bg-green-600 text-dark rounded-lg hover:bg-green-700 transition duration-200"
       download>
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        Download alfathapp.apk
    </a>
</div>
    </form>
</x-guest-layout>