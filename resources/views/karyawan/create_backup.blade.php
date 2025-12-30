<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Karyawan Baru') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Tampilkan error validasi -->
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <strong class="font-bold">Whoops! Ada kesalahan:</strong>
                            <ul class="list-disc list-inside mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Tampilkan flash message -->
                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('karyawan.store') }}">
                        @csrf

                        <!-- Pilih User dari Tabel Users -->
                        <div class="mt-4">
                            <x-input-label for="name_user" :value="__('Pilih Karyawan dari User')" />
                            <select id="name_user" name="name_user" class="p-2 block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                <option value="">Pilih User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->name }}" {{ old('name_user') == $user->name ? 'selected' : '' }}>
                                        {{ $user->name }} - {{ $user->email }}
                                    </option>
                                @endforeach
                            </select>
                            @error('name_user')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NIK -->
                        <!--<div class="mt-4">
                            <x-input-label for="nik" :value="__('NIK')" />
                            <x-text-input id="nik" class="block mt-1 w-full" type="text" name="nik" :value="old('nik')" required placeholder="Nomor Induk Karyawan" />
                            @error('nik')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>-->
                        <!-- NIK -->
                        <div class="mt-4">
                            <x-input-label for="nik" :value="__('NIK')" />
                        
                            <x-text-input id="nik" class="block mt-1 w-full"
                                type="text" name="nik" value="{{ old('nik') }}" required
                                placeholder="NIK (16 digit)" inputmode="numeric" pattern="[0-9]{16}" maxlength="16" />
                        
                            @error('nik')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Jabatan -->
                        <div class="mt-4">
                            <x-input-label for="jabatan" :value="__('Jabatan')" />
                            <x-text-input id="jabatan" class="p-2 block mt-1 w-full" type="text" name="jabatan" :value="old('jabatan')" required placeholder="Posisi/jabatan karyawan" />
                            @error('jabatan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Gabung -->
                        <div class="mt-4">
                            <x-input-label for="tanggal_gabung" :value="__('Tanggal Gabung')" />
                            <x-text-input id="tanggal_gabung" class="block mt-1 w-full" type="date" name="tanggal_gabung" :value="old('tanggal_gabung', date('Y-m-d'))" required />
                            @error('tanggal_gabung')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mt-4">
                            <x-input-label for="Status" :value="__('Status')" />
                            <select id="Status" name="Status" class="p-2 block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">Pilih Status</option>
                                <option value="Aktif" {{ old('Status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Non-Aktif" {{ old('Status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                            @error('Status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('karyawan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2 transition duration-200">
                                Batal
                            </a>
                            <x-primary-button class="ml-4">
                                {{ __('Simpan Karyawan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>