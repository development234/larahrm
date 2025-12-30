<x-app-layout>


    <div class="py-2">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
 


                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h4 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Tambah Data Honor') }}
                    </h4>
                    <hr class="border-sm border-blue-400 mb-6 mt-1">

                    <form action="{{ route('honor.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name_karyawan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Karyawan</label>
                            <select name="name_karyawan" id="name_karyawan" required
                                class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Pilih Karyawan</option>
                                @foreach($karyawans as $karyawan)
                                    <option value="{{ $karyawan->name_user }}" {{ old('name_karyawan') == $karyawan->name_user ? 'selected' : '' }}>
                                        {{ $karyawan->name_user }} - {{ $karyawan->jabatan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('name_user')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="rincian_lembur" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rincian Lembur</label>
                            <textarea name="rincian_lembur" id="rincian_lembur" rows="3" required
                                class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Deskripsikan rincian tugas lembur...">{{ old('rincian_lembur') }}</textarea>
                            @error('rincian_lembur')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="total_jam" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total Jam</label>
                            <input type="number" name="total_jam" id="total_jam" value="{{ old('total_jam') }}" min="1" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Masukkan total jam lembur">
                            @error('total_jam')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="total_pembayaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total Pembayaran</label>
                            <input type="number" name="total_pembayaran" id="total_pembayaran" value="{{ old('total_pembayaran') }}" min="0" step="0.01" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Masukkan total pembayaran">
                            @error('total_pembayaran')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select name="status" id="status" required
                                class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Pilih Status</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="dibayar" {{ old('status') == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                                <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
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
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>