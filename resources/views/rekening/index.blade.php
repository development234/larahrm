<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bank') }}
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

            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                <div class="flex justify-between items-center mb-2 border-b border-blue-300">
                    <h2 class="text-lg font-bold mb-4">Daftar Bank</h2>
                    <a href="{{ route('rekening.create') }}"
                       class="px-4 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                        + Tambah Rekening
                    </a>
                </div>

                {{-- TABEL --}}
                <table class="w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">Bank</th>
                            <th class="p-2 border">Kode</th>
                            <th class="p-2 border text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($rekening as $row)
                            <tr>
                                <td class="border p-2">{{ $row->bank }}</td>
                                <td class="border p-2">{{ $row->kode_bank }}</td>
                                <td class="border p-2 text-center">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('rekening.edit', $row->id) }}"
                                           class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                                           title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414
                                                         a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('rekening.destroy', $row->id) }}" method="POST"
                                              onsubmit="return confirm('Hapus rekening ini?')">
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
                                <td colspan="4" class="text-center p-3 text-gray-500">
                                    Belum ada data rekening
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $rekening->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
