<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                     <div class="flex items-center">
                        {{-- Ganti dengan ikon yang sesuai --}}
                        <svg class="w-12 h-12 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <h1 class="ml-3 text-2xl font-medium text-gray-900 dark:text-white">
                            Selamat Datang, {{ $user->name }}!
                        </h1>
                    </div>
                    <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                        Selamat datang di dashboard pendaftaran TOEIC. Di sini Anda dapat mendaftar ujian, melihat jadwal, dan memeriksa hasil ujian Anda.
                        {{-- Tambahkan info NIM jika ada di profile --}}
                        @if($user->mahasiswaProfile)
                        <br><strong>NIM:</strong> {{ $user->mahasiswaProfile->nim }}
                        @endif
                    </p>
                </div>

                <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                    {{-- Tombol Aksi Mahasiswa --}}
                    {{-- Logika untuk tombol Daftar akan lebih kompleks, tergantung status pendaftaran & apakah sudah pernah ikut --}}
                    {{-- Contoh Sederhana: --}}
                    <a href="#" class="flex items-center p-6 bg-gradient-to-r from-green-500 to-teal-600 dark:from-green-600 dark:to-teal-700 hover:from-green-600 hover:to-teal-700 dark:hover:from-green-700 dark:hover:to-teal-800 text-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-8 h-8 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        <div>
                            <h3 class="text-lg font-semibold">Daftar Ujian TOEIC</h3>
                            <p class="text-sm opacity-90">Isi formulir dan unggah dokumen pendaftaran.</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center p-6 bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-700 dark:to-indigo-800 hover:from-blue-600 hover:to-indigo-700 dark:hover:from-blue-800 dark:hover:to-indigo-900 text-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-8 h-8 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <h3 class="text-lg font-semibold">Status Pendaftaran Saya</h3>
                            <p class="text-sm opacity-90">Lihat status verifikasi pendaftaran Anda.</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center p-6 bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-700 dark:to-indigo-800 hover:from-blue-600 hover:to-indigo-700 dark:hover:from-blue-800 dark:hover:to-indigo-900 text-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-8 h-8 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <div>
                            <h3 class="text-lg font-semibold">Jadwal Ujian Saya</h3>
                            <p class="text-sm opacity-90">Informasi jadwal ujian yang telah ditetapkan.</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center p-6 bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-700 dark:to-indigo-800 hover:from-blue-600 hover:to-indigo-700 dark:hover:from-blue-800 dark:hover:to-indigo-900 text-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-8 h-8 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-4-4H5a4 4 0 000 8h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 001.414 0l2.414-2.414A1 1 0 0116.414 19H19a4 4 0 000-8h-1a4 4 0 00-4 4v2"></path></svg>
                        <div>
                            <h3 class="text-lg font-semibold">Lihat Hasil Ujian</h3>
                            <p class="text-sm opacity-90">Cek nilai dan sertifikat TOEIC Anda.</p>
                        </div>
                    </a>

                     <a href="#" class="flex items-center p-6 bg-gradient-to-r from-gray-500 to-gray-600 dark:from-gray-600 dark:to-gray-700 hover:from-gray-600 hover:to-gray-700 dark:hover:from-gray-700 dark:hover:to-gray-800 text-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-8 h-8 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        <div>
                            <h3 class="text-lg font-semibold">Lihat Pengumuman</h3>
                            <p class="text-sm opacity-90">Informasi terbaru dari UPA Bahasa.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>