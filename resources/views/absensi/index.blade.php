<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Absensi') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-8xl  sm:px-6 lg:px-8">
            <!-- Notifikasi -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Card Utama -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-0">
                        <h3 class="text-1xl font-bold">Absensi</h3>
                        <div class="space-x-2">
                            <a href="{{ route('absensi.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded">
                                + Absensi
                            </a>
                            <button onclick="showAbsenMasukModal()" class="bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded">
                                Absen Masuk
                            </button>
                        </div>
                    </div>

                    <p class="text-gray-400 bg-clip-text dark:text-gray-400 mb-6 mt-1 border-t border-blue-200">
                       Fitur untuk mencatat kehadiran dan waktu kerja
                    </p>

                    <!-- Tabel Data Absensi -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-700 rounded-lg">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-600">
                                    <th class="py-3 px-4 text-left">No</th>
                                    <th class="py-3 px-4 text-left">Nama</th>
                                    <th class="py-3 px-4 text-left">Jabatan</th>
                                    <th class="py-3 px-4 text-left">Tanggal</th>
                                    <th class="py-3 px-4 text-left">Jam Masuk</th>
                                    <th class="py-3 px-4 text-left">Jam Keluar</th>
                                    <th class="py-3 px-4 text-left">Status</th>
                                    <th class="py-3 px-4 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($absensi as $index => $absen)
                                    <tr class="border-b border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                                        <td class="py-3 px-4">{{ $absen->nama }}</td>
                                        <td class="py-3 px-4">{{ $absen->jabatan }}</td>
                                        <td class="py-3 px-4">{{ \Carbon\Carbon::parse($absen->tanggal)->format('d/m/Y') }}</td>
                                        <td class="py-3 px-4">
                                            @if($absen->jam_masuk)
                                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                    {{ $absen->jam_masuk }}
                                                </span>
                                            @else
                                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                    Belum Absen
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">
                                            @if($absen->jam_keluar)
                                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                    {{ $absen->jam_keluar }}
                                                </span>
                                            @else
                                                @if($absen->jam_masuk)
                                                    <button onclick="absenKeluar({{ $absen->id }})" class="bg-orange-500 hover:bg-orange-700 text-white text-xs font-bold py-1 px-2 rounded">
                                                        Absen Keluar
                                                    </button>
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">
                                            @php
                                                $statusColors = [
                                                    'Hadir' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                                    'Izin' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                                    'Sakit' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                                    'Alpha' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300'
                                                ];
                                            @endphp
                                            <span class="text-xs font-medium px-2.5 py-0.5 rounded {{ $statusColors[$absen->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ $absen->status }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('absensi.edit', $absen->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                    Edit
                                                </a>
                                                <form action="{{ route('absensi.destroy', $absen->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="py-4 px-4 text-center text-gray-500 dark:text-gray-400">
                                            Tidak ada data absensi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Absen Masuk -->
    <div id="absenMasukModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Absen Masuk</h3>
                <form action="{{ route('absensi.masuk') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="modal_karyawan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Karyawan</label>
                        <select name="karyawan_id" id="modal_karyawan_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">Pilih Karyawan</option>
                            @foreach($karyawan as $k)
                                <option value="{{ $k->id }}">
                                    {{ $k->name_user }} - {{ $k->jabatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="hideAbsenMasukModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                            Absen Masuk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showAbsenMasukModal() {
            document.getElementById('absenMasukModal').classList.remove('hidden');
        }

        function hideAbsenMasukModal() {
            document.getElementById('absenMasukModal').classList.add('hidden');
        }

        function absenKeluar(id) {
            if (confirm('Apakah Anda yakin ingin melakukan absen keluar?')) {
                window.location.href = "{{ url('absensi/keluar') }}/" + id;
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('absenMasukModal');
            if (event.target === modal) {
                hideAbsenMasukModal();
            }
        }
    </script>
</x-app-layout>