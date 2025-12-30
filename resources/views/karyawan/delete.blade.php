<div class="bg-white dark:bg-gray-800 rounded-lg">
    <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-3">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Hapus Karyawan</h3>
        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <div class="mt-4">
        <p class="text-gray-700 dark:text-gray-300">
            Apakah Anda yakin ingin menghapus karyawan <strong>{{ $karyawan->name_user }}</strong> (NIK: {{ $karyawan->nik }})?
        </p>
        
        <div class="flex justify-end space-x-3 pt-4">
            <button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Batal
            </button>
            <form action="{{ route('karyawan.destroy', $karyawan) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>