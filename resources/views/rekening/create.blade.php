<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Rekening Bank') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-4xl sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

                <h3 class="text-lg font-bold mb-4">Form Tambah Rekening</h3>

                <form method="POST" action="{{ route('rekening.store') }}" class="space-y-4">
                    @csrf

                    {{-- BANK --}}
                    <div>
                        <label class="block text-sm mb-1">Nama Bank</label>
                        <input name="bank" class="w-full rounded-md px-2" placeholder="Contoh: BRI / BCA / Mandiri" required>
                    </div>


                    {{-- KODE BANK --}}
                    <div>
                        <label class="block text-sm mb-1">Kode Bank</label>
                        <input name="kode_bank" class="w-full rounded-md px-2" placeholder="014 (contoh BCA)" required>
                    </div>

                    <div class="flex justify-end space-x-3 mt-4">
                        <a href="{{ route('rekening.index') }}"
                           class="px-4 py-1 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Batal
                        </a>

                        <button class="px-4 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>
