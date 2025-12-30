<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Data Absensi') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-8xl sm:px-6 lg:px-8">
            <!-- Notifikasi -->
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline"> Ada beberapa masalah dengan input Anda.</span>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Card Form -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6 border-b border-blue-400">
                        <h3 class="text-1xl font-bold">Tambah Data Absensi</h3>
                        <a href="{{ route('absensi.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-1 px-4 rounded">
                            Kembali
                        </a>
                    </div>

                    <form action="{{ route('absensi.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Karyawan (Dropdown) -->
                            <div>
                                <label for="karyawan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nama Karyawan <span class="text-red-500">*</span>
                                </label>
                                <select name="karyawan_id" id="karyawan_id" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        onchange="updateJabatan()">
                                    <option value="">Pilih Karyawan</option>
                                    @foreach($karyawan as $k)
                                        <option value="{{ $k->id }}" 
                                                data-jabatan="{{ $k->jabatan }}"
                                                {{ old('karyawan_id') == $k->id ? 'selected' : '' }}>
                                            {{ $k->name_user }} - {{ $k->nik }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('karyawan_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jabatan (Auto-filled) -->
                            <div>
                                <label for="jabatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Jabatan
                                </label>
                                <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}" 
                                       readonly
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50 dark:bg-gray-600 dark:border-gray-600 dark:text-gray-300"
                                       placeholder="Jabatan akan terisi otomatis">
                                @error('jabatan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal -->
                            <div>
                                <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', now()->toDateString()) }}" 
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @error('tanggal')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Status Kehadiran <span class="text-red-500">*</span>
                                </label>
                                <select name="status" id="status" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="">Pilih Status</option>
                                    <option value="Hadir" {{ old('status') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                    <option value="Izin" {{ old('status') == 'Izin' ? 'selected' : '' }}>Izin</option>
                                    <option value="Sakit" {{ old('status') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                    <option value="Alpha" {{ old('status') == 'Alpha' ? 'selected' : '' }}>Alpha</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jam Masuk -->
                            <div>
                                <label for="jam_masuk" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Jam Masuk <span class="text-red-500">*</span>
                                </label>
                                <input type="time" name="jam_masuk" id="jam_masuk" value="{{ old('jam_masuk', '08:00') }}" 
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @error('jam_masuk')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jam Keluar -->
                            <div>
                                <label for="jam_keluar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Jam Keluar
                                </label>
                                <input type="time" name="jam_keluar" id="jam_keluar" value="{{ old('jam_keluar', '17:00') }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @error('jam_keluar')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Informasi Karyawan Terpilih -->
                        <div id="info-karyawan" class="mt-4 p-4 bg-blue-50 dark:bg-blue-900 rounded-lg hidden">
                            <h4 class="font-medium text-blue-800 dark:text-blue-200 mb-2">Informasi Karyawan:</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <span class="font-medium text-blue-700 dark:text-blue-300">NIK:</span>
                                    <span id="info-nik" class="text-blue-600 dark:text-blue-400 ml-2">-</span>
                                </div>
                                <div>
                                    <span class="font-medium text-blue-700 dark:text-blue-300">Jabatan:</span>
                                    <span id="info-jabatan" class="text-blue-600 dark:text-blue-400 ml-2">-</span>
                                </div>
                                <div>
                                    <span class="font-medium text-blue-700 dark:text-blue-300">Tanggal Gabung:</span>
                                    <span id="info-tanggal-gabung" class="text-blue-600 dark:text-blue-400 ml-2">-</span>
                                </div>
                            </div>
                        </div>

                        <!-- Keterangan Status -->
                        <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Keterangan Status:</h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-sm">
                                <div class="flex items-center">
                                    <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                                    <span class="text-gray-600 dark:text-gray-400">Hadir: Kehadiran normal</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                                    <span class="text-gray-600 dark:text-gray-400">Izin: Ijin tidak masuk</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                                    <span class="text-gray-600 dark:text-gray-400">Sakit: Tidak masuk karena sakit</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                                    <span class="text-gray-600 dark:text-gray-400">Alpha: Tidak masuk tanpa keterangan</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="reset" class="px-6 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500">
                                Reset
                            </button>
                            <button type="submit" class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data karyawan untuk JavaScript
        const karyawanData = {
            @foreach($karyawan as $k)
                "{{ $k->id }}": {
                    name_user: "{{ $k->name_user }}",
                    nik: "{{ $k->nik }}",
                    jabatan: "{{ $k->jabatan }}",
                    tanggal_gabung: "{{ $k->tanggal_gabung }}",
                    status: "{{ $k->Status }}"
                };
            @endforeach
        };

        function updateJabatan() {
            const karyawanId = document.getElementById('karyawan_id').value;
            const jabatanField = document.getElementById('jabatan');
            const infoKaryawan = document.getElementById('info-karyawan');
            const infoNik = document.getElementById('info-nik');
            const infoJabatan = document.getElementById('info-jabatan');
            const infoTanggalGabung = document.getElementById('info-tanggal-gabung');

            if (karyawanId && karyawanData[karyawanId]) {
                const karyawan = karyawanData[karyawanId];
                
                // Update jabatan field
                jabatanField.value = karyawan.jabatan;
                
                // Show info karyawan
                infoKaryawan.classList.remove('hidden');
                infoNik.textContent = karyawan.nik;
                infoJabatan.textContent = karyawan.jabatan;
                infoTanggalGabung.textContent = new Date(karyawan.tanggal_gabung).toLocaleDateString('id-ID');
            } else {
                // Reset fields
                jabatanField.value = '';
                infoKaryawan.classList.add('hidden');
            }
        }

        // Auto-set jam keluar berdasarkan jam masuk
        document.getElementById('jam_masuk').addEventListener('change', function() {
            const jamMasuk = this.value;
            if (jamMasuk) {
                const [hours, minutes] = jamMasuk.split(':');
                let endHours = parseInt(hours) + 9; // Default 9 jam kerja
                if (endHours >= 24) endHours -= 24;
                
                const jamKeluar = String(endHours).padStart(2, '0') + ':' + minutes;
                document.getElementById('jam_keluar').value = jamKeluar;
            }
        });

        // Validasi form sebelum submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const jamMasuk = document.getElementById('jam_masuk').value;
            const jamKeluar = document.getElementById('jam_keluar').value;
            const karyawanId = document.getElementById('karyawan_id').value;
            
            if (!karyawanId) {
                e.preventDefault();
                alert('Silakan pilih karyawan!');
                return;
            }
            
            if (jamMasuk && jamKeluar && jamKeluar <= jamMasuk) {
                e.preventDefault();
                alert('Jam keluar harus setelah jam masuk!');
            }
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateJabatan(); // Untuk menangani old input
        });
    </script>
</x-app-layout>