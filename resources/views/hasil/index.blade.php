<x-admin-layout>
    <x-slot name="header_title">
        Input / Kelola Hasil
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Hee iki tak isi opo?
        </h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition
                class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
                <button @click="show = false" class="absolute top-1 right-2 text-lg font-bold">×</button>
            </div>
        @endif

        <form action="{{ route('hasil.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-gray-800 p-6 rounded-lg shadow-md">
            @csrf

            <div class="mb-4">
                <label for="tanggal" class="block text-white mb-1">Tanggal Ujian</label>
                <input type="date" name="tanggal" id="tanggal" class="w-full rounded px-3 py-2 text-gray-900" required>
            </div>

            <div class="mb-4">
                <label for="sesi" class="block text-white mb-1">Sesi Ujian</label>
                <input type="text" name="sesi" id="sesi" placeholder="Contoh: 09.00"
                    class="w-full rounded px-3 py-2 text-gray-900" required>
            </div>

            <div class="mb-4">
                <label for="file_hasil" class="block text-white mb-1">Unggah File Hasil (PDF)</label>
                <input type="file" name="file_hasil" id="file_hasil" accept="application/pdf" class="w-full text-white"
                    required>
            </div>

            <div class="flex justify-center mt-6">
                <button type="submit" class="w-full sm:w-1/2 text-white font-semibold py-2.5 px-6 rounded-lg 
               bg-gradient-to-r from-blue-500 to-indigo-600 
               transition-transform duration-200 transform hover:scale-105 shadow-md">
                    Unggah
                </button>
            </div>
        </form>
    </div>
</x-app-layout>