<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Karyawan Baru') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Error --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h4 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Tambah Karyawan Baru') }}
                    </h4>
                    <form method="POST" action="{{ route('karyawan.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- ID PERSONEL --}}
                        <x-text-input type="hidden" id="id_personel" name="id_personel"/>
                        
                        <!--<div class="mt-4">
                            <x-input-label for="id_personel" value="ID Karyawan" />
                            <x-text-input id="id_personel" name="id_personel"
                                class="block mt-1 w-full bg-gray-100"
                                type="text" />
                        </div>-->

                        {{-- USER --}}
                        <x-text-input type="hidden" id="name_user" name="name_user"/>
                        <!--<div class="mt-4">
                            <x-input-label for="name_user" value="User Name"/>
                            <x-text-input id="name_user" name="name_user"  class="block mt-1 w-full bg-gray-100" type="text" required placeholder="User Name Auto generate"/>
                        </div>-->


                        {{-- NIK --}}
                        <x-text-input type="hidden" id="nik" name="nik"/>

                        <!--<div class="mt-4">
                            <x-input-label for="nik" value="NIK (16 Digit)" />
                            <x-text-input id="nik" name="nik" type="text"
                                class="block mt-1 w-full"
                                inputmode="numeric"
                                pattern="[0-9]{16}"
                                maxlength="16"
                                placeholder="Contoh: 317xxxxxxxxxxxxx"
                                required
                                value="{{ old('nik') }}" />
                            <small class="text-gray-400">* Harus 16 digit angka</small>
                        </div>-->

                        {{-- NAMA LENGKAP --}}
                        <div class="mt-4">
                            <x-input-label for="nama_lengkap" value="Nama Lengkap" />
                            <x-text-input name="nama_lengkap" class="block mt-1 w-full" type="text" required placeholder="Nama Lengkap"/>
                        </div>

                        {{-- EMAIL --}}
                        <div class="mt-4">
                            <x-input-label for="email" value="Email" />
                            <x-text-input name="email" type="email" required class="block mt-1 w-full" />
                        </div>

                        {{-- HP --}}
                        <div class="mt-4">
                            <x-input-label for="hp" value="No. HP" />
                            <x-text-input name="hp" type="text" inputmode="numeric" class="block mt-1 w-full" required />
                        </div>

                        {{-- TEMPAT & TGL LAHIR --}}
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-input-label value="Tempat Lahir" />
                                <x-text-input name="tempat_lahir" class="block mt-1 w-full" type="text" required/>
                            </div>
                            <div>
                                <x-input-label value="Tanggal Lahir" />
                                <x-text-input name="tgl_lahir" type="date" class="block mt-1 w-full" required/>
                            </div>
                        </div>

                        {{-- ALAMAT --}}
                        <div class="mt-4">
                            <x-input-label value="Alamat" />
                            <textarea name="alamat" class="w-full rounded-md" type="text" required></textarea>
                        </div>

                        {{-- AREA KERJA --}}
                        <div class="mt-4">
                            <x-input-label for="area_kerja" value="Area Kerja"/>
                        
                            <select name="area_kerja" id="area_kerja"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600
                                           dark:bg-gray-900 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2">
                                <option value="" >-- Pilih Area Kerja --</option>
                        
                                @foreach ($areas as $area)
                                    <option class="px-2" value="{{ $area->nama_area }}"
                                        {{ old('area_kerja') == $area->nama_area ? 'selected' : '' }}>
                                        {{ $area->nama_area }} - {{ $area->kota }}
                                    </option>
                                @endforeach
                            </select>
                        
                            @error('area_kerja')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        {{-- JABATAN --}}
                        <div class="mt-4">
                            <x-input-label for="jabatan" value="Jabatan" />
                        
                            <select id="jabatan" name="jabatan"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900
                                       dark:text-gray-300 rounded-md shadow-sm focus:border-indigo-500
                                       focus:ring-indigo-500 px-2"
                                required>
                                <option value="">-- Pilih Jabatan --</option>
                        
                                @foreach($jabatan as $row)
                                    <option class="px-2" value="{{ $row->jabatan }}" {{ old('jabatan') == $row->jabatan ? 'selected' : '' }}>
                                        {{ $row->jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        
                            @error('jabatan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- TANGGAL --}}
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-input-label value="Tanggal Gabung" />
                                <x-text-input name="tanggal_gabung" type="date" class="block mt-1 w-full" required />
                            </div>
                            <div>
                                <x-input-label value="Akhir Kontrak" />
                                <x-text-input name="akhir_kontrak" type="date" class="block mt-1 w-full" />
                            </div>
                        </div>

                        {{-- REKENING --}}
                        {{-- REKENING --}}
                        <div class="mt-4 w-50">
                            <x-input-label value="No Rekening" />
                        
                            {{-- TANPA REKENING --}}
                            <div class="flex items-center mb-2">
                                <input 
                                    type="checkbox" 
                                    id="tanpa_rekening" 
                                    class="mr-2"
                                    onchange="toggleRekening()">
                                <label for="tanpa_rekening" class="text-sm">
                                    Tidak Punya Rekening (pembayaran Cash)
                                </label>
                            </div>
                        
                            {{-- PILIH BANK --}}
                            <select 
                                id="rekening_select"
                                class="block w-full rounded-md mb-2 px-2"
                                onchange="selectRekening()">
                        
                                <option value="">-- Pilih Bank --</option>
                        
                                @foreach ($rekening as $rek)
                                    <option 
                                        value="{{ $rek->bank }}"
                                        data-kode="{{ $rek->kode_bank }}">
                                        {{ $rek->bank }} ({{ $rek->kode_bank }})
                                    </option>
                                @endforeach
                            </select>
                        
                            {{-- HIDDEN: dikirim ke server --}}
                            <input type="hidden" name="bank" id="bank">
                            <input type="hidden" name="kode_bank" id="kode_bank">
                        
                            {{-- NOMOR REKENING (manual) --}}
                            <x-text-input 
                                id="rekening"
                                name="rekening"
                                class="block mt-1 w-full px-2"
                                placeholder="Masukkan nomor rekening (manual)"
                            />
                        </div>
                        <script>
                        function toggleRekening() {
                            const cb     = document.getElementById('tanpa_rekening');
                            const select = document.getElementById('rekening_select');
                            const rekening = document.getElementById('rekening');
                        
                            if (cb.checked) {
                                select.disabled = true;
                                rekening.value = "Cash";
                                rekening.readOnly = true;
                                document.getElementById('bank').value = "";
                                document.getElementById('kode_bank').value = "";
                            } else {
                                select.disabled = false;
                                rekening.value = "";
                                rekening.readOnly = false;
                            }
                        }
                        
                        function selectRekening() {
                            const select = document.getElementById('rekening_select');
                        
                            const bank = select.value;
                            const kode = select.options[select.selectedIndex].dataset.kode;
                        
                            // simpan ke hidden input
                            document.getElementById('bank').value = bank;
                            document.getElementById('kode_bank').value = kode;
                        
                            // user tetap mengetik nomor rekening sendiri
                        }
                        </script>






                        {{-- STATUS (default Aktif & tidak bisa diubah) --}}
                        <div class="mt-4">
                            <x-input-label value="Status" />
                        
                            {{-- tampilannya saja (tidak bisa diubah) --}}
                            <select class="block mt-1 w-full rounded-md px-2" disabled>
                                <option class="px-2" value="Aktif" selected>Aktif</option>
                            </select>
                        
                            {{-- nilai sebenarnya yang dikirim ke server --}}
                            <input type="hidden" name="Status" value="Aktif">
                        </div>


                        {{-- UPLOAD BERKAS --}}
                        <div class="mt-6">
                            <x-input-label value="Berkas Pendukung" />
                            <input type="file" name="berkas1" class="block w-full mt-1" />
                            <input type="file" name="berkas2" class="block w-full mt-2" />
                            <input type="file" name="berkas3" class="block w-full mt-2" />
                            <small class="text-gray-400">PDF/JPG/PNG (opsional)</small>
                        </div>

                        {{-- BUTTON --}}
                        <div class="flex justify-end mt-6">
                            <a href="{{ route('karyawan.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded mr-2">
                                Batal
                            </a>
                            <x-primary-button>Simpan</x-primary-button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
