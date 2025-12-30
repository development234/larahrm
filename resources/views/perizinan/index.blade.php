<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Perizinan') }}
        </h5>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <!-- Notifikasi -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-1xl font-bold">Perizinan</h3>
                        <a href="{{ route('perizinan.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">
                            + Ajukan Perizinan
                        </a>
                    </div>
                    
                    <p class="text-gray-400 dark:text-gray-400 mb-6 mt-0 border-t border-blue-300">
                        Fitur untuk mengajukan izin dan mengelola cuti 
                    </p>

                    <!-- Tabel Perizinan -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-700">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-600">
                                    <th class="py-3 px-4 border-b border-gray-300 dark:border-gray-500">No</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-500">Karyawan</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-500">Jabatan</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-500">Jenis Izin</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-500">Tanggal Izin</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-500">Durasi</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-500">Status</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-500">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($perizinan as $index => $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="py-3 px-4 border-b border-gray-300 dark:border-gray-500">{{ $index + 1 }}</td>
                                    <td class="py-3 px-4 border-b border-gray-300 dark:border-gray-500">{{ $item->karyawan }}</td>
                                    <td class="py-3 px-4 border-b border-gray-300 dark:border-gray-500">{{ $item->jabatan }}</td>
                                    <td class="py-3 px-4 border-b border-gray-300 dark:border-gray-500">{{ $item->jenis_izin }}</td>
                                    <td class="py-3 px-4 border-b border-gray-300 dark:border-gray-500">{{ $item->tanggal_izin->format('d/m/Y') }}</td>
                                    <td class="py-3 px-4 border-b border-gray-300 dark:border-gray-500">{{ $item->durasi }}</td>
                                    <td class="py-3 px-4 border-b border-gray-300 dark:border-gray-500">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                            @if($item->status == 'disetujui') bg-green-100 text-green-800
                                            @elseif($item->status == 'ditolak') bg-red-100 text-red-800
                                            @else bg-yellow-100 text-yellow-800 @endif">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 border-b border-gray-300 dark:border-gray-500">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('perizinan.edit', $item->id) }}" 
                                               class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                            </a>
                                            <form action="{{ route('perizinan.destroy', $item->id) }}" method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus perizinan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="py-4 px-4 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada data perizinan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>