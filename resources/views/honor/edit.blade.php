<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Honor') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h4 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Edit Data Lemburan') }}
                    </h4>
                    <hr class="border-sm border-blue-400 mb-6 mt-1">
                    <form action="{{ route('honor.update', $honor->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name_user" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Karyawan</label>
                            <select name="name_karyawan" id="name_karyawan" required
                                class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Pilih Karyawan</option>
                                @foreach($karyawans as $karyawan)
                                    <option value="{{ $karyawan->name_user }}" {{ $honor->name_user == $karyawan->name_user ? 'selected' : '' }}>
                                        {{ $karyawan->name_user }} - {{ $karyawan->jabatan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('name_karyawan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="rincian_lembur" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rincian Lembur</label>
                            <textarea name="rincian_lembur" id="rincian_lembur" rows="3" required
                                class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $honor->rincian_lembur }}</textarea>
                            @error('rincian_lembur')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="total_jam" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total Jam</label>
                            <input type="number" name="total_jam" id="total_jam" value="{{ $honor->total_jam }}" min="1" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('total_jam')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="total_pembayaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total Pembayaran</label>
                            <input type="number" name="total_pembayaran" id="total_pembayaran" value="{{ $honor->total_pembayaran }}" min="0" step="0.01" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('total_pembayaran')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select name="status" id="status" required
                                class="p-2mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="pending" {{ $honor->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="dibayar" {{ $honor->status == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                                <option value="ditolak" {{ $honor->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('honor.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>