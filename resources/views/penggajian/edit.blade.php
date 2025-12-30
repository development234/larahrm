<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Penggajian') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Header -->
                    <div class="mb-6">
                        <h3 class="text-1xl font-bold">Edit Data Penggajian</h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-0 border-t border-blue-300">
                            Perbarui informasi data penggajian karyawan.
                        </p>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('penggajian.update', $penggajian->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Karyawan -->
                            <div>
                                <label for="name_user" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nama Karyawan *
                                </label>
                                <select name="name_user" 
                                        id="name_user" 
                                        class="p-2 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('name_user') border-red-500 @enderror"
                                        required>
                                    <option value="">Pilih Karyawan</option>
                                    @foreach($karyawan as $k)
                                        <option value="{{ $k->name_user }}" {{ $penggajian->name_user == $k->name_user ? 'selected' : '' }}>
                                            {{ $k->name_user }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('name_user')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Periode -->
                            <div>
                                <label for="periode" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Periode (Bulan-Tahun) *
                                </label>
                                <input type="month" 
                                       name="periode" 
                                       id="periode"
                                       class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('periode') border-red-500 @enderror"
                                       value="{{ $penggajian->periode }}"
                                       required>
                                @error('periode')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Status *
                                </label>
                                <select name="status" 
                                        id="status"
                                        class="p-2 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('status') border-red-500 @enderror"
                                        required>
                                    <option value="draft" {{ $penggajian->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="diproses" {{ $penggajian->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="selesai" {{ $penggajian->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="dibatalkan" {{ $penggajian->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Proses -->
                            <div>
                                <label for="tanggal_proses" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal Proses
                                </label>
                                <input type="date" 
                                       name="tanggal_proses" 
                                       id="tanggal_proses"
                                       class="p-2 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tanggal_proses') border-red-500 @enderror"
                                       value="{{ $penggajian->tanggal_proses ? $penggajian->tanggal_proses->format('Y-m-d') : '' }}">
                                @error('tanggal_proses')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Total Dibayarkan -->
                            <div class="md:col-span-2">
                                <label for="total_dibayarkan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Total Dibayarkan *
                                </label>
                                <input type="number" 
                                       name="total_dibayarkan" 
                                       id="total_dibayarkan"
                                       class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('total_dibayarkan') border-red-500 @enderror"
                                       value="{{ $penggajian->total_dibayarkan }}"
                                       step="0.01" 
                                       min="0" 
                                       placeholder="0.00"
                                       required>
                                @error('total_dibayarkan')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-8 flex justify-between items-center">
                            <a href="{{ route('penggajian.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>