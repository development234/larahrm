<section class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Kolom Avatar -->
    <div class="md:col-span-1 flex flex-col items-center">
    <div class="w-48 h-48 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center overflow-hidden">
        {!! App\Helpers\AvatarHelper::renderAvatar($user->name) !!}
    </div>
        
        <div class="mt-4 text-center">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                Avatar: {{ $user->name === 'male' ? 'Laki-laki' : 'Perempuan' }}
            </p>
            
            <!-- Tombol untuk mengganti avatar (opsional) -->
            <button type="button" class="mt-2 inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-900 dark:text-indigo-200 dark:hover:bg-indigo-800">
                {{ __('Change Avatar') }}
            </button>
        </div>
    </div>

    <!-- Kolom Form -->
    <div class="md:col-span-2">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Profile Information') }}
            </h2>
            <hr class="mt-0 mb-0 border-blue-500">
            <p class="mt-0 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Nama')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</section>