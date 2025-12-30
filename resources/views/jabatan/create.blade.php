<x-app-layout>

    <div class="py-1">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="text-1xl font-bold">Tambah Jabatan Baru</h2>
                        <a href="{{ route('jabatan.index') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                    <p class="text-gray-400 dark:text-gray-400 mb-6 mt-0 border-t border-blue-300">
                        Pengatura jabatan
                     </p>
                    <form action="{{ route('jabatan.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Jabatan Field -->
                            <div>
                                <label for="jabatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Jabatan
                                </label>
                                <input type="text" 
                                       id="jabatan" 
                                       name="jabatan" 
                                       value="{{ old('jabatan') }}"
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
                                    <option value="Staff" {{ old('level_persetujuan') == 'Staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="Supervisor" {{ old('level_persetujuan') == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                                    <option value="Manager" {{ old('level_persetujuan') == 'Manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="Director" {{ old('level_persetujuan') == 'Director' ? 'selected' : '' }}>Director</option>
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
                                          required>{{ old('ringkasan_akses') }}</textarea>
                                @error('ringkasan_akses')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button type="submit" 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Simpan Jabatan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>