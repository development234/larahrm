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
                    <!-- Header dengan Tombol Tambah -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-2">
                        <h1 class="text-1xl font-bold text-gray-900 dark:text-white">
                            Data Karyawan
                        </h1>
                    
                        <div class="flex items-center gap-2 w-full sm:w-auto">
                            <!--Pencarian  -->
                            <form action="{{ route('karyawan.index') }}" method="GET"
                                  class="flex items-center w-full sm:w-64">
                            
                                <div class="relative w-full">
                                    <input
                                        type="text"
                                        name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Cari nama / NIK / jabatan…"
                                        class="w-full border border-gray-300 dark:border-gray-600 rounded-md pr-9 px-3 py-1
                                               focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                               dark:bg-gray-800 dark:text-white transition"
                                    >
                            
                                    <!-- Tombol search -->
                                    <button type="submit"
                                            class="absolute inset-y-0 right-1 flex items-center px-1 text-gray-500
                                                   hover:text-blue-600 dark:hover:text-blue-400 transition">
                            
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-5 h-5"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                                        </svg>
                                    </button>
                                </div>
                            </form>

                    
                            <!-- Tombol Tambah -->
                            <a href="{{ route('karyawan.create') }}"
                               class="px-4 py-1 bg-blue-600 text-white rounded-md
                                      hover:bg-blue-700 focus:outline-none focus:ring-2
                                      focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                                + Tambah Karyawan
                            </a>
                        </div>
                    </div>

                    <p class="font-bold text-xs text-gray-400 dark:text-gray-400 mb-6 mt-0 border-t border-blue-400">
                        Data Karyawan dan edit status karyawan.</span>
                     </p>
                     <!--Info total karyawan-->
                    <div class="flex gap-2">
                        <div class="px-4 py-2 bg-green-100 text-green-700 rounded-lg font-semibold">
                            Total: {{ $karyawan->total() }}
                        </div>
                
                        <div class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg font-semibold">
                            Aktif: {{ $totalAktif }}
                        </div>
                    </div>

                    <!-- Tabel Karyawan -->
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    No
                                </th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    ID Personel
                                </th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Nama Lengkap
                                </th>

                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    NIK
                                </th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Jabatan
                                </th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Email
                                </th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    HP
                                </th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Area Kerja
                                </th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Tgl Gabung
                                </th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Status
                                </th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Berkas
                                </th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Aksi
                                </th>
                            </tr>
                            </thead>
                            
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            
                            @forelse ($karyawan as $row)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            
                                <td class="px-3 py-2 text-sm">{{ $karyawan->firstItem() + $loop->index }}</td>
                            
                                <td class="px-3 py-2 text-sm">
                                    {{ $row->id_personel }}
                                </td>
                            
                                <td class="px-3 py-2 text-sm">
                                    {{ $row->nama_lengkap }}
                                </td>
                            
                            
                                <td class="px-3 py-2 text-sm">
                                    {{ $row->nik }}
                                </td>
                            
                                <td class="px-3 py-2 text-sm">
                                    {{ $row->jabatan }}
                                </td>
                            
                                <td class="px-3 py-2 text-sm">
                                    {{ $row->email }}
                                </td>
                            
                                <td class="px-3 py-2 text-sm">
                                    {{ $row->hp }}
                                </td>
                            
                                <td class="px-3 py-2 text-sm">
                                    {{ $row->area_kerja }}
                                </td>
                            
                                <td class="px-3 py-2 text-sm">
                                    {{ optional($row->tanggal_gabung)->format('d/m/Y') }}
                                </td>
                            
                                <td class="px-2 py-2 text-sm">
                                    <span class="px-1 py-1 rounded-full text-xs
                                        {{ $row->Status === 'Aktif'
                                            ? 'bg-green-100 font-xs text-green-700 dark:bg-green-800 dark:text-green-100'
                                            : 'bg-red-100 font-xs text-red-700 dark:bg-red-800 dark:text-red-100' }}">
                                        {{ $row->Status }}
                                    </span>
                                </td>
                            
                                <td class="px-3 py-2 text-sm" x-data="{ open:false, imgSrc:'' }">
                                
                                    @php
                                        $labels = [
                                            'berkas1' => 'KTP',
                                            'berkas2' => 'SKCK',
                                            'berkas3' => 'BerkasLain',
                                        ];
                                    @endphp
                                
                                    @foreach (['berkas1','berkas2','berkas3'] as $file)
                                        @if ($row->$file)
                                            <button
                                                @click="open=true; imgSrc='{{ asset('storage/'.$row->$file) }}'"
                                                class="text-blue-600 dark:text-blue-300 underline mr-2"
                                                type="button">
                                                {{ $labels[$file] }}
                                            </button>
                                        @endif
                                    @endforeach
                                
                                    <!-- Modal -->
                                    <div
                                        x-show="open"
                                        x-transition
                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/70"
                                        @click.away="open=false"
                                        @keydown.escape.window="open=false"
                                    >
                                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-4 max-w-3xl w-full">
                                            <img :src="imgSrc" class="mx-auto rounded-lg max-h-[80vh] object-contain">
                                
                                            <div class="text-right mt-3">
                                                <button
                                                    class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800"
                                                    @click="open=false">
                                                    Tutup
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                
                                </td>


                            
                                <td class="px-4 py-2 text-sm">
                                    <div class="flex items-center space-x-3">
                                
                                        {{-- Detail --}}
                                        <a href="{{ route('karyawan.show', $row->id) }}"
                                           class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                           title="Detail">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                
                                        {{-- Edit --}}
                                        <a href="{{ route('karyawan.edit', $row->id) }}"
                                           class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                                           title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414
                                                         a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                
                                        {{-- Delete --}}
                                        <form action="{{ route('karyawan.destroy', $row->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?')">
                                            @csrf
                                            @method('DELETE')
                                
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                    title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                                                             a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6
                                                             m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                
                                    </div>
                                </td>

                            
                            </tr>
                            @empty
                            <tr>
                                <td colspan="13" class="text-center py-4 text-sm text-gray-500">
                                    Tidak ada data.
                                </td>
                            </tr>
                            @endforelse
                            </tbody>

                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $karyawan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
