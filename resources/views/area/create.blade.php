<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Area Baru') }}
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
                        {{ __('Tambah Area') }}
                    </h4>
                    <form action="{{ route('area.store') }}" method="POST">
                        @csrf
                        <div class="mt-3">
                            <x-input-label for="Nama Area" value="Nama Area" />
                            <x-text-input id="nama_area" name="nama_area" class="block mt-1 w-full bg-gray-100" type="text" />
                        </div>
                        <div class="mt-3">
                            <x-input-label for="Kota" value="Kota" />
                            <x-text-input id="kota" name="kota" class="block mt-1 w-full bg-gray-100" type="text" />
                        </div>
                        
                        <div class="mt-3">
                            <button class="px-4 py-1 bg-blue-300 hover:bg-blue-500 text-white rounded shadow">Simpan</button>
                            <a href="{{ route('area.index') }}" class="px-4 py-1 bg-yellow-300 hover:bg-yellow-500 text-white rounded shadow">Kembali</a>
                        </div>
                    </form>
    </div>
</x-app-layout>

