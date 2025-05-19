<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        {{-- Ganti dengan ikon yang sesuai --}}
                        <svg class="w-12 h-12 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <h1 class="ml-3 text-2xl font-medium text-gray-900 dark:text-white">
                            Selamat Datang, {{ Auth::user()->name }}!
                        </h1>
                    </div>

                    <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                        Ini adalah halaman dashboard admin. Dari sini Anda dapat mengelola berbagai aspek sistem pendaftaran TOEIC.
                    </p>
                </div>

                <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                    {{-- Tombol Aksi Admin --}}
                    <a href="#" class="flex items-center p-6 bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-700 dark:to-indigo-800 hover:from-blue-600 hover:to-indigo-700 dark:hover:from-blue-800 dark:hover:to-indigo-900 text-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        {{-- Ikon bisa dari Heroicons atau FontAwesome jika terintegrasi --}}
                        <svg class="w-8 h-8 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <div>
                            <h3 class="text-lg font-semibold">Kelola Pengumuman</h3>
                            <p class="text-sm opacity-90">Buat dan edit pengumuman pendaftaran, hasil, dll.</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center p-6 bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-700 dark:to-indigo-800 hover:from-blue-600 hover:to-indigo-700 dark:hover:from-blue-800 dark:hover:to-indigo-900 text-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-8 h-8 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <div>
                            <h3 class="text-lg font-semibold">Verifikasi Pendaftar</h3>
                            <p class="text-sm opacity-90">Lihat dan verifikasi data mahasiswa pendaftar.</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center p-6 bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-700 dark:to-indigo-800 hover:from-blue-600 hover:to-indigo-700 dark:hover:from-blue-800 dark:hover:to-indigo-900 text-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-8 h-8 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <div>
                            <h3 class="text-lg font-semibold">Kelola Jadwal Ujian</h3>
                            <p class="text-sm opacity-90">Atur tanggal, lokasi, dan kuota ujian TOEIC.</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center p-6 bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-700 dark:to-indigo-800 hover:from-blue-600 hover:to-indigo-700 dark:hover:from-blue-800 dark:hover:to-indigo-900 text-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                         <svg class="w-8 h-8 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        <div>
                            <h3 class="text-lg font-semibold">Input/Kelola Hasil Ujian</h3>
                            <p class="text-sm opacity-90">Masukkan dan publikasikan hasil ujian mahasiswa.</p>
                        </div>
                    </a>

                     <a href="#" class="flex items-center p-6 bg-gradient-to-r from-gray-500 to-gray-600 dark:from-gray-600 dark:to-gray-700 hover:from-gray-600 hover:to-gray-700 dark:hover:from-gray-700 dark:hover:to-gray-800 text-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-8 h-8 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <div>
                            <h3 class="text-lg font-semibold">Manajemen User</h3>
                            <p class="text-sm opacity-90">Kelola akun pengguna (admin/mahasiswa).</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>