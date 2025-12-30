<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Jabatan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <a href="{{ route('jabatan.index') }}" 
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>

                    <form action="{{ route('jabatan.update', $jabatan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Jabatan Field -->
                            <div>
                                <label for="jabatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Jabatan
                                </label>
                                <input type="text" 
                                       id="jabatan" 
                                       name="jabatan" 
                                       value="{{ old('jabatan', $jabatan->jabatan) }}"
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                       required>
                                @error('jabatan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Level Persetujuan Field -->
                            <div>
                                <label for="level_persetujuan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Level Persetujuan
                                </label>
                                <select id="level_persetujuan" 
                                        name="level_persetujuan"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                        required>
                                    <option value="">Pilih Level Persetujuan</option>
                                    <option value="Staff" {{ old('level_persetujuan', $jabatan->level_persetujuan) == 'Staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="Supervisor" {{ old('level_persetujuan', $jabatan->level_persetujuan) == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                                    <option value="Manager" {{ old('level_persetujuan', $jabatan->level_persetujuan) == 'Manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="Director" {{ old('level_persetujuan', $jabatan->level_persetujuan) == 'Director' ? 'selected' : '' }}>Director</option>
                                </select>
                                @error('level_persetujuan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Ringkasan Akses Field -->
                            <div>
                                <label for="ringkasan_akses" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Ringkasan Akses
                                </label>
                                <textarea id="ringkasan_akses" 
                                          name="ringkasan_akses" 
                                          rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                          required>{{ old('ringkasan_akses', $jabatan->ringkasan_akses) }}</textarea>
                                @error('ringkasan_akses')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button type="submit" 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Update Jabatan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>