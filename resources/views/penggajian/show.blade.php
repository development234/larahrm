<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Penggajian') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Header dan Action Buttons -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-1xl font-bold">Detail Data Penggajian</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">
                                Informasi lengkap mengenai data penggajian karyawan.
                            </p>
                           
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('penggajian.edit', $penggajian->id) }}" 
                               class="bg-yellow-500 hover:bg-yellow-700 text-white  py-1 px-4 rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                            <a href="{{ route('penggajian.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white py-1 px-4 rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali
                            </a>
                        </div>
                    </div>
                     <hr class="border mb-5">
                    <!-- Detail Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <h4 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Informasi Karyawan</h4>
                                <dl class="space-y-3">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Karyawan</dt>
                                        <dd class="text-sm text-gray-900 dark:text-gray-100 font-semibold">{{ $penggajian->name_user }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Periode</dt>
                                        <dd class="text-sm text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($penggajian->periode . '-01')->format('F Y') }}</dd>
                                    </div>
                                </dl>
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <h4 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Status Penggajian</h4>
                                <dl class="space-y-3">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                        <dd>
                                            @php
                                                $statusColors = [
                                                    'draft' => 'bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-200',
                                                    'diproses' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100',
                                                    'selesai' => 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100',
                                                    'dibatalkan' => 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100'
                                                ];
                                            @endphp
                                            <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $statusColors[$penggajian->status] }}">
                                                {{ ucfirst($penggajian->status) }}
                                            </span>
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Proses</dt>
                                        <dd class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ $penggajian->tanggal_proses ? \Carbon\Carbon::parse($penggajian->tanggal_proses)->format('d F Y') : 'Belum diproses' }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-4">
                            <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-200 dark:border-blue-800">
                                <h4 class="text-lg font-semibold mb-3 text-blue-800 dark:text-blue-200">Informasi Pembayaran</h4>
                                <dl class="space-y-3">
                                    <div>
                                        <dt class="text-sm font-medium text-blue-600 dark:text-blue-400">Total Dibayarkan</dt>
                                        <dd class="text-2xl font-bold text-blue-700 dark:text-blue-300">
                                            Rp {{ number_format($penggajian->total_dibayarkan, 0, ',', '.') }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <h4 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Informasi Sistem</h4>
                                <dl class="space-y-3">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dibuat Pada</dt>
                                        <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $penggajian->created_at->format('d F Y H:i') }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Diupdate Pada</dt>
                                        <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $penggajian->updated_at->format('d F Y H:i') }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>