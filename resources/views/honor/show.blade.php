<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Data Honor') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-lg font-semibold mb-2">Informasi Karyawan</h4>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="font-medium">Nama Karyawan</dt>
                                    <dd class="text-gray-600 dark:text-gray-400">{{ $honor->name_karyawan }}</dd>
                                </div>
                                <div>
                                    <dt class="font-medium">Status</dt>
                                    <dd>
                                        <span class="px-2 py-1 rounded-full text-xs 
                                            @if($honor->status == 'dibayar') bg-green-100 text-green-800
                                            @elseif($honor->status == 'ditolak') bg-red-100 text-red-800
                                            @else bg-yellow-100 text-yellow-800 @endif">
                                            {{ ucfirst($honor->status) }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold mb-2">Detail Pembayaran</h4>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="font-medium">Total Jam Lembur</dt>
                                    <dd class="text-gray-600 dark:text-gray-400">{{ $honor->total_jam }} jam</dd>
                                </div>
                                <div>
                                    <dt class="font-medium">Total Pembayaran</dt>
                                    <dd class="text-gray-600 dark:text-gray-400">Rp {{ number_format($honor->total_pembayaran, 0, ',', '.') }}</dd>
                                </div>
                                <div>
                                    <dt class="font-medium">Tanggal Dibuat</dt>
                                    <dd class="text-gray-600 dark:text-gray-400">{{ $honor->created_at->format('d/m/Y H:i') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="text-lg font-semibold mb-2">Rincian Lembur</h4>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded">
                            <p class="text-gray-600 dark:text-gray-400 whitespace-pre-line">{{ $honor->rincian_lembur }}</p>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('honor.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>