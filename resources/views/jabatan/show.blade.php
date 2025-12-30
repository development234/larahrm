<x-app-layout>
    <div class="py-2">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-2 border-b border-gray-900">
                        <h3 class="text-1xl font-bold mb-0 ">Informasi Jabatan</h3>
                        <a href="{{ route('jabatan.index') }}" 
                           class="bg-gray-500 hover:bg-gray-700 text-white py-1 px-2 rounded">
                            Kembali
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informasi Utama -->
                        <div class="space-y-4">
                           
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Jabatan</label>
                                <p class="mt-1 text-lg text-gray-800 dark:text-white font-medium">{{ $jabatan->jabatan }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Level Persetujuan</label>
                                <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                    {{ $jabatan->level_persetujuan }}
                                </span>
                            </div>
                        </div>

                        <!-- Informasi Tambahan -->
                        <div class="space-y-4 bg-gray-300 p-6">
                            <h3 class="text-1xl font-semibold border-b pb-2 text-gray-600">Informasi Tambahan</h3>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Dibuat Pada</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $jabatan->created_at->format('d/m/Y H:i') }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Diupdate Pada</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $jabatan->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan Akses -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold border-b pb-2 mb-4">Ringkasan Akses</h3>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-gray-900 dark:text-white whitespace-pre-line">{{ $jabatan->ringkasan_akses }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('jabatan.index') }}" 
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>