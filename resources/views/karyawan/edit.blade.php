<x-app-layout>
    <div class="py-1">
        <div class="max-w-7xl  sm:px-6 lg:px-8">
            <!-- Notifikasi -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Header dengan Tombol Kembali -->
                    <div class="flex justify-between items-center mb-6 border-b border-blue-200 mt-0">
                        <h2 class="text-1xl font-bold text-gray-900 dark:text-white">Edit Data Karyawan</h2>
                     
                    </div>

                    <form method="POST" enctype="multipart/form-data" action="{{ route('karyawan.update', $karyawan) }}">
                        @csrf
                        @method('PUT')
                    
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                            {{-- ID PERSONEL --}}
                            <div>
                                <x-input-label value="ID Personel" />
                                <x-text-input
                                    class="block mt-1 w-full bg-gray-100 px-3 h-10 rounded-md"
                                    readonly
                                    value="{{ $karyawan->id_personel }}"
                                />
                            </div>
                    
                            {{-- USERNAME --}}
                            <div>
                                <x-input-label value="Username (name_user)" />
                                <x-text-input
                                    name="name_user"
                                    class="block mt-1 w-full px-3 h-10 rounded-md"
                                    value="{{ old('name_user', $karyawan->name_user) }}"
                                    required
                                />
                                @error('name_user') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>
                    
                            {{-- PASSWORD --}}
                            <div>
                                <x-input-label value="Password Baru" />
                                <x-text-input
                                    name="password"
                                    type="password"
                                    class="block mt-1 w-full px-3 h-10 rounded-md"
                                />
                                <small class="text-gray-400">Kosongkan jika tidak ingin mengganti</small>
                                @error('password') <p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                            </div>
                    
                            {{-- NIK --}}
                            <div>
                                <x-input-label value="NIK (16 digit)" />
                                <x-text-input
                                    name="nik"
                                    class="block mt-1 w-full px-3 h-10 rounded-md"
                                    maxlength="16" inputmode="numeric"
                                    value="{{ old('nik', $karyawan->nik) }}"
                                    required
                                />
                                @error('nik') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>
                    
                            {{-- NAMA --}}
                            <div>
                                <x-input-label value="Nama Lengkap" />
                                <x-text-input
                                    name="nama_lengkap"
                                    class="block mt-1 w-full px-3 h-10 rounded-md"
                                    value="{{ old('nama_lengkap', $karyawan->nama_lengkap) }}"
                                    required
                                />
                            </div>
                    
                            {{-- EMAIL --}}
                            <div>
                                <x-input-label value="Email" />
                                <x-text-input
                                    name="email"
                                    type="email"
                                    class="block mt-1 w-full px-3 h-10 rounded-md"
                                    value="{{ old('email', $karyawan->email) }}"
                                />
                            </div>
                    
                            {{-- HP --}}
                            <div>
                                <x-input-label value="Nomor HP" />
                                <x-text-input
                                    name="hp"
                                    class="block mt-1 w-full px-3 h-10 rounded-md"
                                    value="{{ old('hp', $karyawan->hp) }}"
                                />
                            </div>
                    
                            {{-- TEMPAT LAHIR --}}
                            <div>
                                <x-input-label value="Tempat Lahir" />
                                <x-text-input
                                    name="tempat_lahir"
                                    class="block mt-1 w-full px-3 h-10 rounded-md"
                                    value="{{ old('tempat_lahir', $karyawan->tempat_lahir) }}"
                                />
                            </div>
                    
                            {{-- TGL LAHIR --}}
                            <div>
                                <x-input-label value="Tanggal Lahir" />
                                <x-text-input
                                    name="tgl_lahir"
                                    type="date"
                                    class="block mt-1 w-full px-3 h-10 rounded-md"
                                    value="{{ old('tgl_lahir', optional($karyawan->tgl_lahir)->format('Y-m-d')) }}"
                                />
                            </div>
                    
                            {{-- ALAMAT --}}
                            <div class="md:col-span-2">
                                <x-input-label value="Alamat" />
                                <textarea
                                    name="alamat"
                                    class="w-full rounded-md px-3 mt-1"
                                    rows="3"
                                >{{ old('alamat', $karyawan->alamat) }}</textarea>
                            </div>
                    
                            {{-- AREA --}}
                            <div>
                                <x-input-label value="Area Kerja" />
                                <x-text-input
                                    name="area_kerja"
                                    class="block mt-1 w-full px-3 h-10 rounded-md"
                                    value="{{ old('area_kerja', $karyawan->area_kerja) }}"
                                />
                            </div>
                    
                            {{-- JABATAN --}}
                            <div>
                                <x-input-label value="Jabatan" />
                                <x-text-input
                                    name="jabatan"
                                    class="block mt-1 w-full px-3 h-10 rounded-md"
                                    value="{{ old('jabatan', $karyawan->jabatan) }}"
                                    required
                                />
                            </div>
                    
                            {{-- TG GABUNG --}}
                            <div>
                                <x-input-label value="Tanggal Gabung" />
                                <x-text-input
                                    name="tanggal_gabung"
                                    type="date"
                                    class="block mt-1 w-full px-3 h-10 rounded-md"
                                    value="{{ old('tanggal_gabung', $karyawan->tanggal_gabung->format('Y-m-d')) }}"
                                    required
                                />
                            </div>
                    
                            {{-- AKHIR KONTRAK --}}
                            <div>
                                <x-input-label value="Akhir Kontrak" />
                                <x-text-input
                                    name="akhir_kontrak"
                                    type="date"
                                    class="block mt-1 w-full px-3 h-10 rounded-md"
                                    value="{{ old('akhir_kontrak', optional($karyawan->akhir_kontrak)->format('Y-m-d')) }}"
                                />
                            </div>
                    
                            {{-- REKENING --}}
                            <div>
                                <x-input-label value="No Rekening" />
                                <x-text-input
                                    name="rekening"
                                    class="block mt-1 w-full px-3 h-10 rounded-md"
                                    value="{{ old('rekening', $karyawan->rekening) }}"
                                />
                            </div>
                    
                            {{-- STATUS --}}
                            <div>
                                <x-input-label value="Status" />
                                <select
                                    name="Status"
                                    class="block mt-1 w-full px-3 h-10 rounded-md border-gray-300 dark:border-gray-700"
                                >
                                    <option value="Aktif" {{ old('Status', $karyawan->Status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Non-Aktif" {{ old('Status', $karyawan->Status) == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                </select>
                            </div>
                            
                           

                    </div>
                    <div class="mt-5 font-semi text-blue-800 bold text-xs border-b border-blue-800"><h1>BERKAS KARYAWAN</h1></div>
                    <div class="w-full px-3 h-50 rounded-md grid grid-cols-1 sm:grid-cols-3 gap-10 mt-2">
                    
                                {{-- CARD — KTP --}}
                                <div class="w-full min-w-[220px] bg-white dark:bg-gray-800 rounded-2xl border shadow-md p-5" x-data="{open:false, imgSrc:''}">
                                    <x-input-label value="KTP" />
                            
                                    <div class="mt-3 items-center justify-center">
                                        @if ($karyawan->berkas1)
                                            @php
                                                $url = asset('storage/'.$karyawan->berkas1);
                                                $isImage = preg_match('/\.(jpg|jpeg|png)$/i', $karyawan->berkas1);
                                            @endphp
                            
                                            @if ($isImage)
                                                <img src="{{ $url }}"
                                                     class="w-28 h-28 object-cover rounded shadow cursor-pointer"
                                                     @click="open=true; imgSrc='{{ $url }}'">
                                            @else
                                                <a href="{{ $url }}" target="_blank" class="text-blue-500 underline">
                                                    Lihat berkas lama
                                                </a>
                                            @endif
                                        @else
                                            <div class="w-28 h-28 rounded bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                                                Belum ada
                                            </div>
                                        @endif
                                    </div>
                            
                                    <input type="file" name="berkas1" class="block mt-3 w-full">
                                    <small class="text-gray-400">Biarkan kosong jika tidak ingin mengganti</small>
                            
                                    {{-- modal preview --}}
                                    <div
                                        x-show="open"
                                        class="fixed inset-0 bg-black/70 flex items-center justify-center z-50"
                                        @click.self="open=false"
                                    >
                                        <img :src="imgSrc" class="max-h-[85vh] rounded-lg shadow">
                                    </div>
                                </div>
                            
                            
                                {{-- CARD — SKCK --}}
                                 <div class="w-full min-w-[220px] bg-white dark:bg-gray-800 rounded-2xl border shadow-md p-5" x-data="{open:false, imgSrc:''}">
                                    <x-input-label value="SKCK" />
                            
                                    <div class="mt-3 flex items-center justify-center">
                                        @if ($karyawan->berkas2)
                                            @php
                                                $url = asset('storage/'.$karyawan->berkas2);
                                                $isImage = preg_match('/\.(jpg|jpeg|png)$/i', $karyawan->berkas2);
                                            @endphp
                            
                                            @if ($isImage)
                                                <img src="{{ $url }}"
                                                     class="w-28 h-28 object-cover rounded shadow cursor-pointer"
                                                     @click="open=true; imgSrc='{{ $url }}'">
                                            @else
                                                <a href="{{ $url }}" target="_blank" class="text-blue-500 underline">
                                                    Lihat berkas lama
                                                </a>
                                            @endif
                                        @else
                                            <div class="w-28 h-28 rounded bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                                                Belum ada
                                            </div>
                                        @endif
                                    </div>
                            
                                    <input type="file" name="berkas2" class="block mt-3 w-full">
                                    <small class="text-gray-400">Biarkan kosong jika tidak ingin mengganti</small>
                            
                                    <div
                                        x-show="open"
                                        class="fixed inset-0 bg-black/70 flex items-center justify-center z-50"
                                        @click.self="open=false"
                                    >
                                        <img :src="imgSrc" class="max-h-[85vh] rounded-lg shadow">
                                    </div>
                                </div>
                            
                            
                                {{-- CARD — BERKAS LAIN --}}
                                 <div class="w-full min-w-[220px] bg-white dark:bg-gray-800 rounded-2xl border shadow-md p-5" x-data="{open:false, imgSrc:''}">
                                    <x-input-label value="Berkas Lain" />
                            
                                    <div class="mt-3 flex items-center justify-center">
                                        @if ($karyawan->berkas3)
                                            @php
                                                $url = asset('storage/'.$karyawan->berkas3);
                                                $isImage = preg_match('/\.(jpg|jpeg|png)$/i', $karyawan->berkas3);
                                            @endphp
                            
                                            @if ($isImage)
                                                <img src="{{ $url }}"
                                                     class="w-28 h-28 object-cover rounded shadow cursor-pointer"
                                                     @click="open=true; imgSrc='{{ $url }}'">
                                            @else
                                                <a href="{{ $url }}" target="_blank" class="text-blue-500 underline">
                                                    Lihat berkas lama
                                                </a>
                                            @endif
                                        @else
                                            <div class="w-28 h-28 rounded bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                                                Belum ada
                                            </div>
                                        @endif
                                    </div>
                            
                                    <input type="file" name="berkas3" class="block mt-3 w-full">
                                    <small class="text-gray-400">Biarkan kosong jika tidak ingin mengganti</small>
                            
                                    <div
                                        x-show="open"
                                        class="fixed inset-0 bg-black/70 flex items-center justify-center z-50"
                                        @click.self="open=false"
                                    >
                                        <img :src="imgSrc" class="max-h-[85vh] rounded-lg shadow">
                                    </div>
                                </div>
                        
                            </div>
                        <!-- Tombol Aksi -->
                        <div class="flex items-center justify-end mt-6 pt-6 border-t border-gray-200 dark:border-gray-600">
                            <a href="{{ route('karyawan.index', $karyawan) }}" 
                               class="px-4 py-1 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200 mr-3">
                                Batal
                            </a>
                            <x-primary-button class="ml-4">
                                {{ __('Update Data Karyawan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
