<x-app-layout>
    <div class="py-2">
        <div class="max-w-7xl sm:px-6 lg:px-8">

            {{-- Alert --}}
            @if (session('success'))
                <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-slate-700 dark:text-slate-200">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- ===================== INFORMASI PERSONAL ===================== --}}
                        <div class="bg-slate-50 dark:bg-slate-900/40 rounded-2xl p-6 shadow-sm">
                            <div class="flex justify-between mb-4">
                                <h3 class="text-lg font-semibold text-slate-600 dark:text-white">
                                    Informasi Personal
                                </h3>
                            </div>

                            <div class="space-y-4">

                                {{-- Item helper --}}
                                @php
                                    function infoItem($icon, $label, $value) {
                                        echo '
                                        <div class="flex items-center space-x-3 p-3 bg-white dark:bg-slate-800 rounded-xl">
                                            <div class="w-10 h-10 bg-blue-100 dark:bg-slate-700 rounded-lg flex items-center justify-center">
                                                '.$icon.'
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <label class="text-xs text-slate-500 uppercase">'.$label.'</label>
                                                <p class="text-sm font-semibold truncate">'.$value.'</p>
                                            </div>
                                        </div>';
                                    }
                                @endphp

                                {!! infoItem('<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>', 'Nama Karyawan', $karyawan->nama_lengkap) !!}

                                {!! infoItem('<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/>
                                </svg>', 'NIK', $karyawan->nik) !!}

                                {!! infoItem('<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 12H4m8-8v16"/>
                                </svg>', 'Jabatan', $karyawan->jabatan) !!}

                                {!! infoItem('<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6l8 6 8-6"/>
                                </svg>', 'Email', $karyawan->email ?? '-') !!}

                                {!! infoItem('<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5h18M8 5v14m8-14v14M5 19h14"/>
                                </svg>', 'Nomor HP', $karyawan->hp ?? '-') !!}

                                {!! infoItem('<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3M5 8h14v11H5z"/>
                                </svg>', 'Tempat / Tanggal Lahir', ($karyawan->tempat_lahir ?? "-").", ".($karyawan->tgl_lahir ? \Carbon\Carbon::parse($karyawan->tgl_lahir)->format('d-m-Y') : '-')) !!}

                                {!! infoItem('<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 11l9-7 9 7v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7z"/>
                                </svg>', 'Alamat', $karyawan->alamat ?? '-') !!}

                            </div>
                        </div>


                        {{-- ===================== INFORMASI PEKERJAAN ===================== --}}
                        <div class="bg-slate-50 dark:bg-slate-900/40 rounded-2xl p-6 shadow-sm">

                            <h3 class="text-lg font-semibold text-slate-600 dark:text-white mb-4">
                                Informasi Pekerjaan
                            </h3>

                            <div class="space-y-4">

                                {{-- Join date --}}
                                <div class="p-3 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                                    <label class="text-xs text-slate-500 uppercase">Tanggal Gabung</label>
                                    <p class="font-semibold">
                                        {{ \Carbon\Carbon::parse($karyawan->tanggal_gabung)->format('d F Y') }}
                                    </p>
                                </div>

                                {{-- Status --}}
                                <div class="p-3 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                                    <label class="text-xs text-slate-500 uppercase">Status</label>
                                    <div>
                                        <span class="px-3 py-1 rounded-full text-sm
                                            {{ $karyawan->Status === 'Aktif' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-700' }}">
                                            {{ $karyawan->Status }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Masa kerja --}}
                                <div class="p-3 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                                    <label class="text-xs text-slate-500 uppercase">Masa Kerja</label>
                                    <p>
                                        {{ \Carbon\Carbon::parse($karyawan->tanggal_gabung)->diffInYears(now()) }} tahun,
                                        {{ \Carbon\Carbon::parse($karyawan->tanggal_gabung)->diffInMonths(now()) % 12 }} bulan
                                    </p>
                                </div>

                                {{-- Area kerja --}}
                                <div class="p-3 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                                    <label class="text-xs text-slate-500 uppercase">Area Kerja</label>
                                    <p class="font-semibold">{{ $karyawan->area_kerja ?? '-' }}</p>
                                </div>

                                {{-- Kontrak --}}
                                <div class="p-3 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                                    <label class="text-xs text-slate-500 uppercase">Akhir Kontrak</label>
                                    <p class="font-semibold">
                                        {{ $karyawan->akhir_kontrak ? \Carbon\Carbon::parse($karyawan->akhir_kontrak)->format('d F Y') : '-' }}
                                    </p>
                                </div>

                                {{-- Rekening --}}
                                <div class="p-3 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                                    <label class="text-xs text-slate-500 uppercase">Rekening</label>
                                    <p class="font-semibold">{{ $karyawan->rekening ?? '-' }}</p>
                                </div>

                            </div>
                        </div>


                        {{-- ===================== LOGIN ===================== --}}
                        <div class="bg-slate-50 dark:bg-slate-900/40 rounded-2xl p-6 shadow-sm">
                            <h3 class="text-lg font-semibold mb-3">Informasi Login Aplikasi</h3>

                            <div class="space-y-3">
                                <p><b>Username:</b> {{ $karyawan->name_user }}</p>
                                <p><b>Password:</b> {{ $karyawan->password }}</p>
                            </div>
                        </div>


                        {{-- ===================== BERKAS ===================== --}}
                        <div class="bg-slate-50 dark:bg-slate-900/40 rounded-2xl p-6 shadow-sm">
                            <h3 class="text-lg font-semibold mb-3">Berkas Karyawan</h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                @foreach (['berkas1' => 'KTP', 'berkas2' => 'SKCK', 'berkas3' => 'Surat Lain'] as $field => $label)
                                    <div>
                                        <label class="text-sm font-medium">{{ $label }}</label>
                                        @php
                                            $file = $karyawan->$field;
                                            $url = $file ? asset('storage/'.$file) : null;
                                            $isImage = $file && preg_match('/\.(jpg|jpeg|png)$/i', $file);
                                        @endphp

                                        @if ($file)
                                            @if($isImage)
                                                <img src="{{ $url }}" class="mt-2 w-32 h-32 object-cover rounded shadow">
                                            @else
                                                <a href="{{ $url }}" class="text-blue-600 underline mt-2 block" target="_blank">
                                                    Lihat berkas
                                                </a>
                                            @endif
                                        @else
                                            <p class="text-slate-400 mt-1">Tidak ada file</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- ===================== SISTEM ===================== --}}
                        <div class="bg-slate-50 dark:bg-slate-900/40 rounded-2xl p-6 md:col-span-2">
                            <h3 class="text-lg font-semibold mb-4">Informasi Sistem</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm text-slate-500">Dibuat</label>
                                    <p>{{ $karyawan->created_at->format('d F Y H:i:s') }}</p>
                                </div>
                                <div>
                                    <label class="text-sm text-slate-500">Diupdate</label>
                                    <p>{{ $karyawan->updated_at->format('d F Y H:i:s') }}</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- ===================== TOMBOL ===================== --}}
                    <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-slate-200 dark:border-slate-700">

                        <a href="{{ route('karyawan.index') }}"
                           class="px-4 py-1 bg-slate-500 hover:bg-slate-600 text-white rounded">
                            Kembali
                        </a>

                        <a href="{{ route('karyawan.edit', $karyawan) }}"
                           class="px-4 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded">
                            Edit
                        </a>

                        <form action="{{ route('karyawan.destroy', $karyawan) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="px-4 py-1 bg-red-600 hover:bg-red-700 text-white rounded"
                                    onclick="return confirm('Hapus karyawan {{ $karyawan->name_user }}?')">
                                Hapus
                            </button>
                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
