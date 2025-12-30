<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-8xl sm:px-7 lg:px-9">
            <!-- Notifikasi -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Daftar Area</h2>
                
                        <a href="{{ route('area.create') }}"
                           class="px-4 py-2 bg-blue-300 hover:bg-blue-500 text-white rounded shadow">
                            + Tambah Area
                        </a>
                    </div>
            
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium">#</th>
                                <th class="px-4 py-2 text-left text-sm font-medium">Nama Area</th>
                                <th class="px-4 py-2 text-left text-sm font-medium">Kota</th>
                                <th class="px-4 py-2 text-center text-sm font-medium w-40">Aksi</th>
                            </tr>
                        </thead>
            
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($area as $a)
                                <tr>
                                    <td class="px-4 py-2 text-sm">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $a->nama_area }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $a->kota }}</td>
            
                                    <td class="px-4 py-2 text-center">
                                        <div class="flex items-center space-x-3">
                                        
                                            {{-- Edit --}}
                                            <a href="{{ route('area.edit', $a->id) }}"
                                                   class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                                                   title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414
                                                                 a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                            </a>
                                            {{-- Delete --}}
                                            <form action="{{ route('area.destroy', $a->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus Area ini?')">
                                                @csrf
                                                @method('DELETE')
                                        
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                        title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862 a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6
                                                                     m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $area->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
