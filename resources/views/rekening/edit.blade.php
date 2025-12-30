<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Rekening
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-4xl sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

                <form method="POST" action="{{ route('rekening.update', $rekening->id) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm mb-1">Nama Bank</label>
                        <input name="bank"
                               value="{{ old('bank', $rekening->bank) }}"
                               class="w-full rounded-md"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Kode Bank</label>
                        <input name="kode_bank"
                               value="{{ old('kode_bank', $rekening->kode_bank) }}"
                               class="w-full rounded-md"
                               required>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('rekening.index') }}"
                           class="px-4 py-1 bg-gray-500 text-white rounded">
                            Batal
                        </a>

                        <button class="px-4 py-1 bg-blue-600 text-white rounded">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
