<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Perizinan') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-1xl font-bold mb-0">Edit Data Perizinan</h3>
                    <hr class="border-blue-300 mt-0 mb-6">
                    <form action="{{ route('perizinan.update', $perizinan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Karyawan -->
                            <div>
                                <label for="karyawan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nama Karyawan
                                </label>
                                <select name="karyawan_id" id="karyawan_id" 
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" required>
                                    <option value="">Pilih Karyawan</option>
                                    @foreach($karyawan as $k)
                                        <option value="{{ $k->id }}" {{ old('karyawan_id', $perizinan->karyawan_id) == $k->id ? 'selected' : '' }}>
                                            {{ $k->name_user }} - {{ $k->jabatan }} <!-- Gunakan name_user -->
                                        </option>
                                    @endforeach
                                </select>
                                @error('karyawan_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jabatan (readonly, akan terisi otomatis) -->
                            <div>
                                <label for="jabatan_display" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Jabatan
                                </label>
                                <input type="text" id="jabatan_display" 
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-gray-100 dark:bg-gray-600 dark:text-white"
                                       value="{{ old('jabatan', $perizinan->jabatan) }}" readonly>
                                <input type="hidden" name="jabatan" id="jabatan_hidden" value="{{ old('jabatan', $perizinan->jabatan) }}">
                            </div>

                            <!-- Jenis Izin -->
                            <div>
                                <label for="jenis_izin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Jenis Izin
                                </label>
                                <select name="jenis_izin" id="jenis_izin" 
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" required>
                                    <option value="">Pilih Jenis Izin</option>
                                    <option value="Cuti Tahunan" {{ old('jenis_izin', $perizinan->jenis_izin) == 'Cuti Tahunan' ? 'selected' : '' }}>Cuti Tahunan</option>
                                    <option value="Cuti Sakit" {{ old('jenis_izin', $perizinan->jenis_izin) == 'Cuti Sakit' ? 'selected' : '' }}>Cuti Sakit</option>
                                    <option value="Izin Pribadi" {{ old('jenis_izin', $perizinan->jenis_izin) == 'Izin Pribadi' ? 'selected' : '' }}>Izin Pribadi</option>
                                    <option value="Izin Keluarga" {{ old('jenis_izin', $perizinan->jenis_izin) == 'Izin Keluarga' ? 'selected' : '' }}>Izin Keluarga</option>
                                    <option value="Izin Lainnya" {{ old('jenis_izin', $perizinan->jenis_izin) == 'Izin Lainnya' ? 'selected' : '' }}>Izin Lainnya</option>
                                </select>
                                @error('jenis_izin')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Izin -->
                            <div>
                                <label for="tanggal_izin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal Izin
                                </label>
                                <input type="date" name="tanggal_izin" id="tanggal_izin" 
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                       value="{{ old('tanggal_izin', $perizinan->tanggal_izin->format('Y-m-d')) }}" required>
                                @error('tanggal_izin')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Durasi -->
                            <div>
                                <label for="durasi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Durasi
                                </label>
                                <select name="durasi" id="durasi" 
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" required>
                                    <option value="">Pilih Durasi</option>
                                    <option value="1 Hari" {{ old('durasi', $perizinan->durasi) == '1 Hari' ? 'selected' : '' }}>1 Hari</option>
                                    <option value="2 Hari" {{ old('durasi', $perizinan->durasi) == '2 Hari' ? 'selected' : '' }}>2 Hari</option>
                                    <option value="3 Hari" {{ old('durasi', $perizinan->durasi) == '3 Hari' ? 'selected' : '' }}>3 Hari</option>
                                    <option value="1 Minggu" {{ old('durasi', $perizinan->durasi) == '1 Minggu' ? 'selected' : '' }}>1 Minggu</option>
                                    <option value="2 Minggu" {{ old('durasi', $perizinan->durasi) == '2 Minggu' ? 'selected' : '' }}>2 Minggu</option>
                                    <option value="1 Bulan" {{ old('durasi', $perizinan->durasi) == '1 Bulan' ? 'selected' : '' }}>1 Bulan</option>
                                </select>
                                @error('durasi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Status
                                </label>
                                <select name="status" id="status" 
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" required>
                                    <option value="pending" {{ old('status', $perizinan->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="disetujui" {{ old('status', $perizinan->status) == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="ditolak" {{ old('status', $perizinan->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4 mt-6">
                            <a href="{{ route('perizinan.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">
                                Update Perizinan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk menangani perubahan dropdown karyawan -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const karyawanSelect = document.getElementById('karyawan_id');
            const jabatanDisplay = document.getElementById('jabatan_display');
            const jabatanHidden = document.getElementById('jabatan_hidden');
            
            // Data karyawan dari PHP
            const karyawanData = {!! json_encode($karyawan->pluck('jabatan', 'id')) !!};

            karyawanSelect.addEventListener('change', function() {
                const selectedId = this.value;
                if (selectedId && karyawanData[selectedId]) {
                    jabatanDisplay.value = karyawanData[selectedId];
                    jabatanHidden.value = karyawanData[selectedId];
                } else {
                    jabatanDisplay.value = '';
                    jabatanHidden.value = '';
                }
            });

            // Trigger change event saat halaman load
            karyawanSelect.dispatchEvent(new Event('change'));
        });
    </script>
</x-app-layout>