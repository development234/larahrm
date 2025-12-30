<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Surat Baru') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                                @error('tanggal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="perihal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Perihal</label>
                                <input type="text" name="perihal" id="perihal" value="{{ old('perihal') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                                @error('perihal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="tujuan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tujuan</label>
                                <input type="text" name="tujuan" id="tujuan" value="{{ old('tujuan') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                                @error('tujuan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="berkas_surat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Berkas Surat</label>
                                <input type="file" name="berkas_surat" id="berkas_surat" class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600">
                                @error('berkas_surat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                <select name="status" id="status" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="dikirim" {{ old('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                    <option value="diterima" {{ old('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex justify-end space-x-4">
                                <a href="{{ route('surat.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Batal</a>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>