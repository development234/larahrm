<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pembayaran Lembur') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-8xl sm:px-6 lg:px-8">
            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Total Karyawan Lembur Bulan Ini -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-500 bg-opacity-20">
                                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Karyawan Lembur</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $totalKaryawanLemburBulanIni }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Bulan {{ now()->translatedFormat('F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Jam Lembur -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-6 rounded-full bg-green-500 bg-opacity-20">
                                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Jam Lembur</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $totalJamLemburBulanIni }} jam</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Bulan {{ now()->translatedFormat('F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Pembayaran -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-500 bg-opacity-20">
                                <svg class="w-8 h-8 text-yellow-500" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                    <text x="12" y="16" text-anchor="middle" font-family="Arial, sans-serif" font-size="10" font-weight="bold" fill="currentColor">Rp</text>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pembayaran</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">Rp {{ number_format($totalPembayaranBulanIni, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Bulan {{ now()->translatedFormat('F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rata-rata per Karyawan -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-500 bg-opacity-20">
                                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Rata-rata per Karyawan</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                    @php
                                        $rataPembayaran = $totalKaryawanLemburBulanIni > 0 ? $totalPembayaranBulanIni / $totalKaryawanLemburBulanIni : 0;
                                    @endphp
                                    Rp {{ number_format($rataPembayaran, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Bulan {{ now()->translatedFormat('F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Breakdown -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                @foreach($statusHonorBulanIni as $status)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400 capitalize">
                                {{ $status->status }}
                            </span>
                            <span class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $status->total }}
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                            @php
                                $totalAllStatus = $statusHonorBulanIni->sum('total');
                                $percentage = $totalAllStatus > 0 ? ($status->total / $totalAllStatus) * 100 : 0;
                                $colorClass = [
                                    'pending' => 'bg-yellow-500',
                                    'dibayar' => 'bg-green-500',
                                    'ditolak' => 'bg-red-500'
                                ][$status->status] ?? 'bg-blue-500';
                            @endphp
                            <div class="h-2 rounded-full {{ $colorClass }}" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Tabel Data Honor -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-1xl font-bold">Data Pembayaran Lembur</h3>
                        <a href="{{ route('honor.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">
                            + Data Honor
                        </a>
                    </div>
                    <p class="text-gray-400 dark:text-gray-400 mb-6 mt-0 border-t border-blue-300">
                        Data Lembur dan honor karyawan
                    </p>
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Karyawan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Rincian Lembur</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total Jam</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total Pembayaran</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($honors as $honor)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">{{ $honor->name_karyawan }}</td>
                                        <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">
                                            <div class="max-w-xs truncate" title="{{ $honor->rincian_lembur }}">
                                                {{ Str::limit($honor->rincian_lembur, 50) }}
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">{{ $honor->total_jam }} jam</td>
                                        <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">Rp {{ number_format($honor->total_pembayaran, 0, ',', '.') }}</td>
                                        <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">
                                            <span class="px-2 py-1 rounded-full text-xs 
                                                @if($honor->status == 'dibayar') bg-green-100 text-green-800
                                                @elseif($honor->status == 'ditolak') bg-red-100 text-red-800
                                                @else bg-yellow-100 text-yellow-800 @endif">
                                                {{ ucfirst($honor->status) }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">
                                            {{ $honor->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('honor.show', $honor->id) }}" class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </a>
                                                <a href="{{ route('honor.edit', $honor->id) }}" class="text-green-600 hover:text-green-900" title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('honor.destroy', $honor->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data honor ini?')">
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
                                            Tidak ada data honor.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($honors->hasPages())
                    <div class="mt-4 px-6 py-4 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0">
                            <div class="text-sm text-gray-700 dark:text-gray-400">
                                Menampilkan {{ $honors->firstItem() ?? 0 }} - {{ $honors->lastItem() ?? 0 }} dari {{ $honors->total() }} data
                            </div>
                            <div class="flex space-x-1">
                                <!-- Previous Page Link -->
                                @if($honors->onFirstPage())
                                    <span class="px-3 py-1 text-gray-400 dark:text-gray-600 bg-gray-100 dark:bg-gray-700 rounded-md cursor-not-allowed">
                                        &laquo;
                                    </span>
                                @else
                                    <a href="{{ $honors->previousPageUrl() }}" class="px-3 py-1 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-md hover:bg-gray-50 dark:hover:bg-gray-500 transition-colors">
                                        &laquo;
                                    </a>
                                @endif

                                <!-- Pagination Elements -->
                                @foreach($honors->links()->elements[0] as $page => $url)
                                    @if($page == $honors->currentPage())
                                        <span class="px-3 py-1 text-white bg-blue-500 border border-blue-500 rounded-md">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}" class="px-3 py-1 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-md hover:bg-gray-50 dark:hover:bg-gray-500 transition-colors">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                <!-- Next Page Link -->
                                @if($honors->hasMorePages())
                                    <a href="{{ $honors->nextPageUrl() }}" class="px-3 py-1 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-md hover:bg-gray-50 dark:hover:bg-gray-500 transition-colors">
                                        &raquo;
                                    </a>
                                @else
                                    <span class="px-3 py-1 text-gray-400 dark:text-gray-600 bg-gray-100 dark:bg-gray-700 rounded-md cursor-not-allowed">
                                        &raquo;
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>