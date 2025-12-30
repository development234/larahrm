<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="space-y-2">
            <x-input-label for="name" :value="__('Full Name')" class="font-medium text-gray-700" />
            <x-text-input 
                id="name" 
                class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-200" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                autocomplete="name"
                placeholder="Enter your full name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Email Address -->
        <div class="mt-6 space-y-2">
            <x-input-label for="email" :value="__('Email Address')" class="font-medium text-gray-700" />
            <x-text-input 
                id="email" 
                class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-200" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
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
                autocomplete="new-password"
                placeholder="Create a password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-6 space-y-2">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="font-medium text-gray-700" />
            <x-text-input 
                id="password_confirmation" 
                class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-200"
                type="password"
                name="password_confirmation"
                required 
                autocomplete="new-password"
                placeholder="Confirm your password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Register Button -->
        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 focus:ring-2 focus:ring-green-300 focus:ring-offset-2 transition-all duration-200 shadow-lg shadow-green-500/25">
                <span class="font-semibold">{{ __('Create account') }}</span>
            </x-primary-button>
        </div>

        <!-- Login Link -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-600">
                {{ __('Already have an account?') }}
                <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-800 transition duration-200 hover:underline">
                    {{ __('Sign in') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>