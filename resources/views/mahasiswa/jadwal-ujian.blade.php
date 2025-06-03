<x-mahasiswa-layout>
    <x-slot name="header_title">
        Jadwal Ujian TOEIC Saya
    </x-slot>

    <div class="space-y-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
            <div>
                <p class="text-gray-500 dark:text-gray-400">Lihat dan kelola jadwal ujian TOEIC Anda</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <a href="{{ route('mahasiswa.hasil_ujian') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Lihat Hasil Ujian
                </a>
                <a href="{{ route('mahasiswa.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>

        <div x-data="{ activeTab: 'upcoming' }" class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="border-b border-gray-200 dark:border-gray-700">
                <nav class="flex -mb-px">
                    <button @click="activeTab = 'upcoming'" :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'upcoming', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600': activeTab !== 'upcoming' }" class="w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm">
                        Akan Datang
                    </button>
                    <button @click="activeTab = 'past'" :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'past', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600': activeTab !== 'past' }" class="w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm">
                        Selesai
                    </button>
                    <button @click="activeTab = 'all'" :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'all', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600': activeTab !== 'all' }" class="w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm">
                        Semua Jadwal
                    </button>
                </nav>
            </div>

            @if ($jadwalPeserta->isEmpty())
                <div class="flex flex-col items-center justify-center p-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 dark:text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">Belum Ada Jadwal Ujian</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-center max-w-md mb-6">
                        Anda belum terdaftar pada jadwal ujian TOEIC. Silakan hubungi admin atau periksa pendaftaran Anda.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <a href="#" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Daftar Ujian TOEIC
                        </a>
                        <a href="{{ route('mahasiswa.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            @else
                <!-- Upcoming Exams Tab -->
                <div x-show="activeTab === 'upcoming'" class="p-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Jadwal Ujian yang Akan Datang</h3>
                        <div class="mt-2 md:mt-0">
                            <div class="relative">
                                <input type="text" id="search-upcoming" placeholder="Cari jadwal..." class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        $upcomingExams = $jadwalPeserta->filter(function($peserta) {
                            return $peserta->is_upcoming;
                        });
                    @endphp

                    @if ($upcomingExams->isEmpty())
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-md p-4 mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-300">Tidak ada jadwal ujian yang akan datang</h3>
                                    <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-400">
                                        <p>Anda tidak memiliki jadwal ujian TOEIC yang akan datang. Silakan daftar untuk ujian berikutnya.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Ujian</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Waktu</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Lokasi</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No. Peserta</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($upcomingExams as $peserta)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $peserta->jadwal->tanggal_ujian_mulai->format('d-M-Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ $peserta->jadwal->tanggal_ujian_mulai->format('H:i') }} - {{ $peserta->jadwal->tanggal_ujian_selesai->format('H:i') }} WIB
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ $peserta->jadwal->lokasi }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                <span class="font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                                    {{ $peserta->nomor_peserta ?: '-' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                @if ($peserta->is_in_progress)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                                                        <span class="w-2 h-2 mr-1 bg-yellow-500 rounded-full animate-pulse"></span>
                                                        Sedang Berlangsung
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                                        <span class="w-2 h-2 mr-1 bg-blue-500 rounded-full"></span>
                                                        Akan Datang
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                <a href="{{ route('mahasiswa.jadwal_ujian.detail', $peserta->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                    Lihat Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- Past Exams Tab -->
                <div x-show="activeTab === 'past'" class="p-6" style="display: none;">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Jadwal Ujian yang Telah Selesai</h3>
                        <div class="mt-2 md:mt-0">
                            <div class="relative">
                                <input type="text" id="search-past" placeholder="Cari jadwal..." class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        $pastExams = $jadwalPeserta->filter(function($peserta) {
                            return $peserta->is_completed || (!$peserta->is_upcoming && !$peserta->is_in_progress);
                        });
                    @endphp

                    @if ($pastExams->isEmpty())
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md p-4 mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800 dark:text-blue-300">Belum ada ujian yang selesai</h3>
                                    <div class="mt-2 text-sm text-blue-700 dark:text-blue-400">
                                        <p>Anda belum menyelesaikan ujian TOEIC. Jadwal ujian yang telah selesai akan muncul di sini.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Ujian</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Waktu</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Lokasi</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No. Peserta</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($pastExams as $peserta)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $peserta->jadwal->tanggal_ujian_mulai->format('d-M-Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ $peserta->jadwal->tanggal_ujian_mulai->format('H:i') }} - {{ $peserta->jadwal->tanggal_ujian_selesai->format('H:i') }} WIB
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ $peserta->jadwal->lokasi }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                <span class="font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                                    {{ $peserta->nomor_peserta ?: '-' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                @if ($peserta->is_completed)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                        </svg>
                                                        Selesai
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1H8z" clip-rule="evenodd" />
                                                        </svg>
                                                        Terlewat
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('mahasiswa.jadwal_ujian.detail', $peserta->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                        Lihat Detail
                                                    </a>
                                                    @if ($peserta->is_completed)
                                                        <span class="text-gray-300 dark:text-gray-600">|</span>
                                                        <a href="{{ route('mahasiswa.hasil_ujian.by_jadwal', $peserta->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                            Lihat Hasil
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- All Exams Tab -->
                <div x-show="activeTab === 'all'" class="p-6" style="display: none;">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Semua Jadwal Ujian</h3>
                        <div class="mt-2 md:mt-0">
                            <div class="relative">
                                <input type="text" id="search-all" placeholder="Cari jadwal..." class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Ujian</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Waktu</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Lokasi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No. Peserta</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($jadwalPeserta as $peserta)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $peserta->jadwal->tanggal_ujian_mulai->format('d-M-Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $peserta->jadwal->tanggal_ujian_mulai->format('H:i') }} - {{ $peserta->jadwal->tanggal_ujian_selesai->format('H:i') }} WIB
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $peserta->jadwal->lokasi }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                                {{ $peserta->nomor_peserta ?: '-' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            @if ($peserta->is_completed)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                    Selesai
                                                </span>
                                            @elseif ($peserta->is_in_progress)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                                                    <span class="w-2 h-2 mr-1 bg-yellow-500 rounded-full animate-pulse"></span>
                                                    Sedang Berlangsung
                                                </span>
                                            @elseif ($peserta->is_upcoming)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                                    <span class="w-2 h-2 mr-1 bg-blue-500 rounded-full"></span>
                                                    Akan Datang
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1H8z" clip-rule="evenodd" />
                                                    </svg>
                                                    Terlewat
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('mahasiswa.jadwal_ujian.detail', $peserta->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                    Lihat Detail
                                                </a>
                                                @if ($peserta->is_completed)
                                                    <span class="text-gray-300 dark:text-gray-600">|</span>
                                                    <a href="{{ route('mahasiswa.hasil_ujian.by_jadwal', $peserta->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                        Lihat Hasil
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        <!-- Available Exam Schedules Section -->
        <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Jadwal Ujian Tersedia</h3>
                    <div class="mt-2 md:mt-0">
                        <a href="#" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Daftar Ujian Baru
                        </a>
                    </div>
                </div>

                @if ($jadwalTersedia->isEmpty())
                    <div class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-md p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Tidak ada jadwal tersedia</h3>
                                <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    <p>Saat ini tidak ada jadwal ujian TOEIC yang tersedia untuk pendaftaran. Silakan periksa kembali nanti.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Ujian</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Waktu</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Lokasi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kuota</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($jadwalTersedia as $jadwal)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $jadwal->tanggal_ujian_mulai->format('d-M-Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $jadwal->tanggal_ujian_mulai->format('H:i') }} - {{ $jadwal->tanggal_ujian_selesai->format('H:i') }} WIB
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $jadwal->lokasi }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            @php
                                                $registered = $jadwal->jadwalPeserta->count();
                                                $percentage = ($jadwal->kuota > 0) ? ($registered / $jadwal->kuota) * 100 : 0;
                                                $isAlmostFull = $percentage >= 80;
                                                $isFull = $percentage >= 100;
                                            @endphp
                                            
                                            <div class="flex items-center">
                                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 mr-2 max-w-[100px]">
                                                    <div class="h-2.5 rounded-full {{ $isFull ? 'bg-red-500' : ($isAlmostFull ? 'bg-yellow-500' : 'bg-green-500') }}" style="width: {{ min($percentage, 100) }}%"></div>
                                                </div>
                                                <span>{{ $registered }}/{{ $jadwal->kuota }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            @php
                                                $alreadyRegistered = $jadwalPeserta->contains(function($peserta) use ($jadwal) {
                                                    return $peserta->jadwal_id === $jadwal->id;
                                                });
                                            @endphp
                                            
                                            @if ($alreadyRegistered)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                    Sudah Terdaftar
                                                </span>
                                            @elseif ($isFull)
                                                <button disabled class="inline-flex items-center px-3 py-1.5 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest cursor-not-allowed">
                                                    Kuota Penuh
                                                </button>
                                            @else
                                                <a href="#" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Daftar
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Information Section -->
        <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Informasi Ujian TOEIC</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-200 dark:border-blue-800">
                        <h4 class="font-medium text-blue-800 dark:text-blue-300 mb-2">Persiapan Ujian</h4>
                        <ul class="list-disc list-inside space-y-2 text-sm text-blue-700 dark:text-blue-400">
                            <li>Pastikan Anda hadir 30 menit sebelum waktu ujian dimulai</li>
                            <li>Bawa kartu identitas (KTM dan KTP) yang valid</li>
                            <li>Siapkan alat tulis (pensil 2B, penghapus)</li>
                            <li>Pastikan perangkat yang digunakan untuk ujian online memiliki koneksi internet yang stabil</li>
                            <li>Periksa email Anda H-1 sebelum ujian untuk instruksi lebih lanjut dari ITC</li>
                        </ul>
                    </div>
                    <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg border border-purple-200 dark:border-purple-800">
                        <h4 class="font-medium text-purple-800 dark:text-purple-300 mb-2">Ketentuan Ujian</h4>
                        <ul class="list-disc list-inside space-y-2 text-sm text-purple-700 dark:text-purple-400">
                            <li>Ujian TOEIC terdiri dari 2 bagian: Listening (45 menit) dan Reading (75 menit)</li>
                            <li>Total skor maksimal adalah 990 poin</li>
                            <li>Skor minimal kelulusan adalah 400 untuk Program D-III dan 450 untuk Program D-IV</li>
                            <li>Hasil ujian akan diumumkan maksimal 10 hari kerja setelah pelaksanaan ujian</li>
                            <li>Sertifikat TOEIC berlaku selama 2 tahun sejak tanggal ujian</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality for upcoming exams
            document.getElementById('search-upcoming').addEventListener('keyup', function() {
                filterTable(this.value, 'upcoming');
            });

            // Search functionality for past exams
            document.getElementById('search-past').addEventListener('keyup', function() {
                filterTable(this.value, 'past');
            });

            // Search functionality for all exams
            document.getElementById('search-all').addEventListener('keyup', function() {
                filterTable(this.value, 'all');
            });

            function filterTable(query, tabId) {
                query = query.toLowerCase();
                const tab = document.querySelector(`[x-show="activeTab === '${tabId}'"]`);
                const rows = tab.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(query)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
        });
    </script>
    @endpush
</x-mahasiswa-layout>
