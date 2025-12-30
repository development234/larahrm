<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Surat Menyurat') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-1xl font-bold">Persuratan</h3>
                        <a href="{{ route('surat.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">
                            Buat Surat Baru
                        </a>
                    </div>
                    <p class="text-gray-400 dark:text-gray-400 mb-6 mt-0 border-t border-blue-300">
                        Surat Menyurat 
                     </p>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-700">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-600">No</th>
                                    <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-600">Tanggal</th>
                                    <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-600">Perihal</th>
                                    <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-600">Tujuan</th>
                                    <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-600">Status</th>
                                    <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($surat as $item)
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-600">{{ $loop->iteration }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-600">{{ $item->tanggal->format('d/m/Y') }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-600">{{ $item->perihal }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-600">{{ $item->tujuan }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-600">
                                        <span class="px-2 py-1 rounded text-xs font-medium 
                                            @if($item->status == 'draft') bg-gray-200 text-gray-800
                                            @elseif($item->status == 'dikirim') bg-blue-200 text-blue-800
                                            @elseif($item->status == 'diterima') bg-green-200 text-green-800
                                            @elseif($item->status == 'ditolak') bg-red-200 text-red-800
                                            @endif">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-600">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('surat.show', $item->id) }}" class="text-blue-600 hover:text-blue-900">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('surat.edit', $item->id) }}" class="text-green-600 hover:text-green-900">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            @if($item->berkas_surat)
                                                <a href="{{ route('surat.download', $item->id) }}" class="mx-auto text-purple-600 hover:text-purple-900">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @endif
                                            <form action="{{ route('surat.destroy', $item->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?')">
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
                                    <td colspan="6" class="py-4 px-4 text-center">Tidak ada data surat.</td>
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