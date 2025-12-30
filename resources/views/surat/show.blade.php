<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Surat') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold">Tanggal</h4>
                            <p>{{ $surat->tanggal->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold">Perihal</h4>
                            <p>{{ $surat->perihal }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold">Tujuan</h4>
                            <p>{{ $surat->tujuan }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold">Status</h4>
                            <span class="px-2 py-1 rounded text-xs font-medium 
                                @if($surat->status == 'draft') bg-gray-200 text-gray-800
                                @elseif($surat->status == 'dikirim') bg-blue-200 text-blue-800
                                @elseif($surat->status == 'diterima') bg-green-200 text-green-800
                                @elseif($surat->status == 'ditolak') bg-red-200 text-red-800
                                @endif">
                                {{ ucfirst($surat->status) }}
                            </span>
                        </div>
                        @if($surat->berkas_surat)
                        <div class="md:col-span-2">
                            <h4 class="font-semibold">Berkas Surat</h4>
                            <a href="{{ route('surat.download', $surat->id) }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                {{ $surat->berkas_surat }}
                            </a>
                        </div>
                        @endif
                    </div>

                    <div class="mt-6 flex justify-end space-x-4">
                        <a href="{{ route('surat.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Kembali</a>
                        <a href="{{ route('surat.edit', $surat->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>