<x-mahasiswa-layout>
    <x-slot name="header_title">
        Hasil Ujian Saya
    </x-slot>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Hasil Ujian TOEIC Saya') }}
            </h2>
            <p class="text-gray-500">Lihat hasil ujian TOEIC Anda dan unduh sertifikat</p>
        </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('mahasiswa.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    Kembali ke Dashboard
                </a>
            </div>
    </div>

    <div class="space-y-6">
        @if (!$latestResult)
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col items-center justify-center p-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 dark:text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">Belum Ada Hasil Ujian</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-center max-w-md mb-6">
                        Anda belum mengikuti ujian TOEIC atau hasil ujian Anda belum tersedia. Silakan periksa jadwal ujian Anda.
                    </p>
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Lihat Jadwal Ujian
                    </a>
                </div>
            </div>
        @else
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Informasi Ujian TOEIC</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">ID Ujian: {{ $latestResult->id }}</p>
                        </div>
                        <span class="mt-2 md:mt-0 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $latestResult->is_pass ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                            {{ $latestResult->is_pass ? 'Lulus' : 'Tidak Lulus' }}
                        </span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Mahasiswa</h4>
                                <p class="text-gray-900 dark:text-white">{{ $latestResult->user->name }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">NIM</h4>
                                <p class="text-gray-900 dark:text-white">{{ $latestResult->user->mahasiswaProfile->nim ?? 'N/A' }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Ujian</h4>
                                    <p class="text-gray-900 dark:text-white">{{ $latestResult->tanggal_ujian->format('d-M-Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Waktu Ujian</h4>
                                    <p class="text-gray-900 dark:text-white">09.00 WIB</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Lokasi</h4>
                                    <p class="text-gray-900 dark:text-white">Politeknik Negeri Malang</p>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Laporan</h4>
                                <p class="text-gray-900 dark:text-white">{{ $latestResult->created_at->format('d-M-Y') }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Group</h4>
                                <p class="text-gray-900 dark:text-white">{{ $latestResult->group ?? 'N/A' }}</p>
                            </div>
                            <div class="pt-2">
                                @if ($latestResult->file_sertifikat_path)
                                    <a href="{{ route('mahasiswa.download.sertifikat', $latestResult->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full sm:w-auto justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Unduh Sertifikat
                                    </a>
                                @else
                                    <button disabled class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest cursor-not-allowed w-full sm:w-auto justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Sertifikat Belum Tersedia
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div x-data="{ activeTab: 'scores' }" class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="flex -mb-px">
                        <button @click="activeTab = 'scores'" :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'scores', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600': activeTab !== 'scores' }" class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm">
                            Skor TOEIC
                        </button>
                        <button @click="activeTab = 'history'" :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'history', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600': activeTab !== 'history' }" class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm">
                            Riwayat Ujian
                        </button>
                    </nav>
                </div>

                <div x-show="activeTab === 'scores'" class="p-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Skor TOEIC Anda</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Hasil ujian TOEIC pada tanggal {{ $latestResult->tanggal_ujian->format('d-M-Y') }}</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <div class="w-full h-[300px] relative" id="score-chart">
                                <!-- Canvas will be inserted here by JavaScript -->
                            </div>
                        </div>
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium mb-4 dark:text-white">Detail Skor</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-blue-50 dark:bg-blue-900/30 p-4 rounded-lg">
                                        <p class="text-sm text-blue-600 dark:text-blue-400 font-medium">Listening</p>
                                        <p class="text-2xl font-bold text-blue-700 dark:text-blue-300">{{ $latestResult->listening }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Dari 495</p>
                                    </div>
                                    <div class="bg-green-50 dark:bg-green-900/30 p-4 rounded-lg">
                                        <p class="text-sm text-green-600 dark:text-green-400 font-medium">Reading</p>
                                        <p class="text-2xl font-bold text-green-700 dark:text-green-300">{{ $latestResult->reading }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Dari 495</p>
                                    </div>
                                    <div class="col-span-2 bg-purple-50 dark:bg-purple-900/30 p-4 rounded-lg">
                                        <p class="text-sm text-purple-600 dark:text-purple-400 font-medium">Total</p>
                                        <p class="text-2xl font-bold text-purple-700 dark:text-purple-300">{{ $latestResult->total }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Dari 990</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium mb-2 dark:text-white">Interpretasi Skor</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                    Skor TOEIC Anda menunjukkan kemampuan bahasa Inggris pada level:
                                </p>
                                @php
                                    $level = '';
                                    $badgeClass = '';
                                    
                                    if ($latestResult->total >= 785) {
                                        $level = 'Advanced (785-990)';
                                        $badgeClass = 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
                                    } elseif ($latestResult->total >= 605) {
                                        $level = 'Upper Intermediate (605-780)';
                                        $badgeClass = 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
                                    } elseif ($latestResult->total >= 405) {
                                        $level = 'Intermediate (405-600)';
                                        $badgeClass = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200';
                                    } else {
                                        $level = 'Basic (10-400)';
                                        $badgeClass = 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
                                    }
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                    {{ $level }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'history'" class="p-6" style="display: none;">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Riwayat Ujian TOEIC</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Perbandingan hasil ujian TOEIC Anda</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Ujian</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Listening</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Reading</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $latestResult->tanggal_ujian->format('d-M-Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        <div class="flex items-center">
                                            {{ $latestResult->listening }}
                                            @if ($previousResult)
                                                @php
                                                    $listeningDiff = $latestResult->listening - $previousResult->listening;
                                                @endphp
                                                <span class="ml-2 flex items-center text-xs">
                                                    @if ($listeningDiff > 0)
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-50 text-green-800 dark:bg-green-900/50 dark:text-green-300">
                                                            <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                                            </svg>
                                                            {{ $listeningDiff }}
                                                        </span>
                                                    @elseif ($listeningDiff < 0)
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-50 text-red-800 dark:bg-red-900/50 dark:text-red-300">
                                                            <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                                            </svg>
                                                            {{ abs($listeningDiff) }}
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-50 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                            <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                            </svg>
                                                            0
                                                        </span>
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        <div class="flex items-center">
                                            {{ $latestResult->reading }}
                                            @if ($previousResult)
                                                @php
                                                    $readingDiff = $latestResult->reading - $previousResult->reading;
                                                @endphp
                                                <span class="ml-2 flex items-center text-xs">
                                                    @if ($readingDiff > 0)
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-50 text-green-800 dark:bg-green-900/50 dark:text-green-300">
                                                            <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                                            </svg>
                                                            {{ $readingDiff }}
                                                        </span>
                                                    @elseif ($readingDiff < 0)
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-50 text-red-800 dark:bg-red-900/50 dark:text-red-300">
                                                            <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                                            </svg>
                                                            {{ abs($readingDiff) }}
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-50 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                            <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                            </svg>
                                                            0
                                                        </span>
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        <div class="flex items-center">
                                            {{ $latestResult->total }}
                                            @if ($previousResult)
                                                @php
                                                    $totalDiff = $latestResult->total - $previousResult->total;
                                                @endphp
                                                <span class="ml-2 flex items-center text-xs">
                                                    @if ($totalDiff > 0)
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-50 text-green-800 dark:bg-green-900/50 dark:text-green-300">
                                                            <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                                            </svg>
                                                            {{ $totalDiff }}
                                                        </span>
                                                    @elseif ($totalDiff < 0)
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-50 text-red-800 dark:bg-red-900/50 dark:text-red-300">
                                                            <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                                            </svg>
                                                            {{ abs($totalDiff) }}
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-50 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                            <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                            </svg>
                                                            0
                                                        </span>
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $latestResult->is_pass ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                                            {{ $latestResult->is_pass ? 'Lulus' : 'Tidak Lulus' }}
                                        </span>
                                    </td>
                                </tr>
                                
                                @if ($previousResult)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $previousResult->tanggal_ujian->format('d-M-Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $previousResult->listening }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $previousResult->reading }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $previousResult->total }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $previousResult->is_pass ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                                                {{ $previousResult->is_pass ? 'Lulus' : 'Tidak Lulus' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if ($latestResult)
        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const canvas = document.createElement('canvas');
                canvas.className = 'w-full h-full';
                document.getElementById('score-chart').appendChild(canvas);
                
                const ctx = canvas.getContext('2d');
                if (!ctx) return;
                
                // Set canvas dimensions
                const dpr = window.devicePixelRatio || 1;
                const rect = canvas.getBoundingClientRect();
                canvas.width = rect.width * dpr;
                canvas.height = rect.height * dpr;
                ctx.scale(dpr, dpr);
                
                // Clear canvas
                ctx.clearRect(0, 0, rect.width, rect.height);
                
                // Chart dimensions
                const chartWidth = rect.width - 40;
                const chartHeight = rect.height - 60;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2 + 10;
                
                // Draw gauge background
                const gaugeWidth = chartWidth * 0.8;
                const gaugeHeight = 20;
                
                // Check if dark mode is enabled
                const isDarkMode = document.documentElement.classList.contains('dark');
                
                // Colors for dark mode
                const colors = {
                    listening: {
                        bg: isDarkMode ? "#1e3a8a" : "#e6f2ff",
                        fill: isDarkMode ? "#3b82f6" : "#3b82f6"
                    },
                    reading: {
                        bg: isDarkMode ? "#14532d" : "#e6ffee",
                        fill: isDarkMode ? "#22c55e" : "#22c55e"
                    },
                    total: {
                        bg: isDarkMode ? "#581c87" : "#f3e8ff",
                        fill: isDarkMode ? "#a855f7" : "#a855f7"
                    },
                    text: isDarkMode ? "#ffffff" : "#000000"
                };
                
                // Draw listening gauge (blue)
                const listeningRatio = {{ $latestResult->listening }} / 495;
                ctx.fillStyle = colors.listening.bg;
                ctx.beginPath();
                roundRect(ctx, centerX - gaugeWidth / 2, centerY - 40, gaugeWidth, gaugeHeight, 10);
                ctx.fill();
                
                ctx.fillStyle = colors.listening.fill;
                ctx.beginPath();
                roundRect(ctx, centerX - gaugeWidth / 2, centerY - 40, gaugeWidth * listeningRatio, gaugeHeight, 10);
                ctx.fill();
                
                // Draw reading gauge (green)
                const readingRatio = {{ $latestResult->reading }} / 495;
                ctx.fillStyle = colors.reading.bg;
                ctx.beginPath();
                roundRect(ctx, centerX - gaugeWidth / 2, centerY, gaugeWidth, gaugeHeight, 10);
                ctx.fill();
                
                ctx.fillStyle = colors.reading.fill;
                ctx.beginPath();
                roundRect(ctx, centerX - gaugeWidth / 2, centerY, gaugeWidth * readingRatio, gaugeHeight, 10);
                ctx.fill();
                
                // Draw total gauge (purple)
                const totalRatio = {{ $latestResult->total }} / 990;
                ctx.fillStyle = colors.total.bg;
                ctx.beginPath();
                roundRect(ctx, centerX - gaugeWidth / 2, centerY + 40, gaugeWidth, gaugeHeight, 10);
                ctx.fill();
                
                ctx.fillStyle = colors.total.fill;
                ctx.beginPath();
                roundRect(ctx, centerX - gaugeWidth / 2, centerY + 40, gaugeWidth * totalRatio, gaugeHeight, 10);
                ctx.fill();
                
                // Add labels
                ctx.fillStyle = colors.text;
                ctx.font = "12px sans-serif";
                ctx.textAlign = "left";
                ctx.fillText("Listening", centerX - gaugeWidth / 2, centerY - 50);
                ctx.fillText("Reading", centerX - gaugeWidth / 2, centerY - 10);
                ctx.fillText("Total", centerX - gaugeWidth / 2, centerY + 30);
                
                // Add scores
                ctx.font = "bold 12px sans-serif";
                ctx.textAlign = "right";
                ctx.fillText("{{ $latestResult->listening }}/495", centerX + gaugeWidth / 2, centerY - 50);
                ctx.fillText("{{ $latestResult->reading }}/495", centerX + gaugeWidth / 2, centerY - 10);
                ctx.fillText("{{ $latestResult->total }}/990", centerX + gaugeWidth / 2, centerY + 30);
                
                // Helper function for rounded rectangles
                function roundRect(ctx, x, y, width, height, radius) {
                    if (width < 2 * radius) radius = width / 2;
                    if (height < 2 * radius) radius = height / 2;
                    ctx.moveTo(x + radius, y);
                    ctx.arcTo(x + width, y, x + width, y + height, radius);
                    ctx.arcTo(x + width, y + height, x, y + height, radius);
                    ctx.arcTo(x, y + height, x, y, radius);
                    ctx.arcTo(x, y, x + width, y, radius);
                }
            });
        </script>
        @endpush
    @endif
</x-mahasiswa-layout>
