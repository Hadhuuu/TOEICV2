<x-mahasiswa-layout>
    <x-slot name="header_title">
        Beranda Mahasiswa
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Selamat Datang, <span class="text-indigo-500 dark:text-indigo-400">{{ $user->name }}</span>!
        </h2>
        @if($user->mahasiswaProfile)
        <p class="text-sm text-gray-600 dark:text-gray-400">
            NIM: {{ $user->mahasiswaProfile->nim }} - {{ $user->mahasiswaProfile->program_studi }}
        </p>
        @endif
    </x-slot>

    <div class="space-y-8">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 dark:from-blue-700 dark:to-indigo-800 text-white p-6 py-8 rounded-xl shadow-xl">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-4 md:mb-0 md:mr-6 text-center md:text-left">
                    <h3 class="text-2xl font-bold mb-1">Status Pendaftaran TOEIC Anda</h3>
                    @if ($pendaftaranTerbaru)
                        @if ($pendaftaranTerbaru->status === 'menunggu_verifikasi')
                            <p class="text-lg opacity-90">Pendaftaran Anda pada <span class="font-semibold">{{ $pendaftaranTerbaru->created_at->translatedFormat('d M Y') }}</span> sedang <span class="font-bold text-yellow-300">MENUNGGU VERIFIKASI</span>.</p>
                            <p class="text-sm opacity-80">Mohon tunggu informasi selanjutnya dari UPA Bahasa.</p>
                        @elseif ($pendaftaranTerbaru->status === 'terverifikasi')
                            <p class="text-lg opacity-90">Pendaftaran Anda telah <span class="font-bold text-green-300">TERVERIFIKASI!</span></p>
                            @if (!$jadwalPeserta)
                                <p class="text-sm opacity-80">Anda akan segera mendapatkan jadwal ujian. Mohon periksa secara berkala.</p>
                            @endif
                        @elseif ($pendaftaranTerbaru->status === 'ditolak')
                            <p class="text-lg opacity-90">Mohon maaf, pendaftaran Anda <span class="font-bold text-red-300">DITOLAK</span>.</p>
                            <p class="text-sm opacity-80">Catatan: {{ $pendaftaranTerbaru->catatan_admin ?: 'Tidak ada catatan.' }}</p>
                            <a href="#" class="mt-3 inline-block bg-white text-blue-600 font-semibold px-4 py-2 rounded-lg text-sm hover:bg-gray-100 transition-colors">Hubungi Admin</a>
                        @elseif ($pendaftaranTerbaru->status === 'sudah_test_sebelumnya')
                             <p class="text-lg opacity-90">Anda tercatat <span class="font-bold text-purple-300">SUDAH MENGIKUTI UJIAN TOEIC</span> sebelumnya.</p>
                             <p class="text-sm opacity-80">Silakan cek hasil ujian Anda atau hubungi admin jika ada pertanyaan.</p>
                        @endif
                    @else
                        <p class="text-lg opacity-90">Anda belum melakukan pendaftaran TOEIC.</p>
                        <p class="text-sm opacity-80">Segera daftar untuk mengikuti ujian sertifikasi TOEIC.</p>
                    @endif
                </div>
                @if (!$pendaftaranTerbaru || ($pendaftaranTerbaru && $pendaftaranTerbaru->status === 'ditolak'))
                    <a href="{{ route('mahasiswa.pendaftaran.create') }}" class="bg-white text-blue-700 font-bold px-8 py-3 rounded-lg shadow-md hover:bg-gray-200 transition-transform transform hover:scale-105 whitespace-nowrap text-center">
                        DAFTAR UJIAN TOEIC SEKARANG
                    </a>
                @elseif($pendaftaranTerbaru)
                     <a href="#" class="bg-white/20 hover:bg-white/30 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-transform transform hover:scale-105 whitespace-nowrap text-center">
                        Lihat Detail Pendaftaran
                    </a>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @if ($jadwalPeserta && $jadwalPeserta->jadwal)
            <div class="lg:col-span-2 bg-white dark:bg-slate-800 p-6 rounded-xl shadow-lg">
                <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-1">Jadwal Ujian Anda</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Berikut adalah detail jadwal ujian TOEIC Anda yang telah ditetapkan.</p>
                <div class="bg-indigo-50 dark:bg-indigo-900/30 p-4 rounded-lg border border-indigo-200 dark:border-indigo-700">
                    <div class="flex items-center mb-3">
                        <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <h5 class="text-lg font-semibold text-indigo-700 dark:text-indigo-300">{{ $jadwalPeserta->jadwal->lokasi }}</h5>
                    </div>
                    <p class="text-gray-700 dark:text-gray-200 mb-1">
                        <span class="font-semibold">Tanggal:</span> {{ Carbon\Carbon::parse($jadwalPeserta->jadwal->tanggal_ujian_mulai)->translatedFormat('l, d F Y') }}
                    </p>
                    <p class="text-gray-700 dark:text-gray-200 mb-1">
                        <span class="font-semibold">Waktu:</span> {{ Carbon\Carbon::parse($jadwalPeserta->jadwal->tanggal_ujian_mulai)->format('H:i') }} - {{ Carbon\Carbon::parse($jadwalPeserta->jadwal->tanggal_ujian_selesai)->format('H:i') }} WIB
                    </p>
                    <p class="text-gray-700 dark:text-gray-200">
                        <span class="font-semibold">No. Peserta:</span> <span class="font-mono bg-gray-200 dark:bg-gray-700 px-2 py-0.5 rounded">{{ $jadwalPeserta->nomor_peserta ?: '-' }}</span>
                    </p>
                    {{-- Countdown Timer (Contoh sederhana, butuh JS lebih lanjut untuk real time) --}}
                    @php
                        $tglUjian = Carbon\Carbon::parse($jadwalPeserta->jadwal->tanggal_ujian_mulai);
                        $diff = $tglUjian->isFuture() ? $tglUjian->diffForHumans(null, true, false, 2) : null;
                    @endphp
                    @if($diff)
                    <p class="mt-3 text-sm text-blue-600 dark:text-blue-400 font-medium">
                        Ujian dalam: {{ $diff }} lagi!
                    </p>
                    @endif
                </div>
                <p class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                    Pastikan Anda mempersiapkan diri dengan baik dan hadir tepat waktu. Periksa email Anda untuk instruksi lebih lanjut dari ITC H-1 sebelum ujian.
                </p>
            </div>
            @endif

            @if ($hasilUjian)
            <div class="lg:col-span-{{ $jadwalPeserta ? '1' : '2' }} bg-white dark:bg-slate-800 p-6 rounded-xl shadow-lg">
                <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-1">Hasil Ujian TOEIC</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Skor terakhir Anda pada ujian tanggal {{ Carbon\Carbon::parse($hasilUjian->tanggal_ujian)->translatedFormat('d M Y') }}.</p>
                <div class="space-y-2 text-center">
                    <div class="py-3 px-4 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                        <p class="text-xs text-blue-700 dark:text-blue-300 font-medium">SKOR TOTAL</p>
                        <p class="text-4xl font-bold text-blue-600 dark:text-blue-400">{{ $hasilUjian->nilai_total }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div class="py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Listening</p>
                            <p class="font-semibold text-gray-700 dark:text-gray-200">{{ $hasilUjian->nilai_listening ?? '-' }}</p>
                        </div>
                         <div class="py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Reading</p>
                            <p class="font-semibold text-gray-700 dark:text-gray-200">{{ $hasilUjian->nilai_reading ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                @if($hasilUjian->file_sertifikat_path)
                    <a href="{{-- route('mahasiswa.download.sertifikat', $hasilUjian->id) --}}" class="mt-4 w-full block text-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors text-sm">
                        Unduh Sertifikat
                    </a>
                @else
                    <p class="mt-4 text-xs text-center text-gray-500 dark:text-gray-400">Sertifikat akan segera tersedia.</p>
                @endif
            </div>
            @endif

            @if (!$jadwalPeserta && !$hasilUjian)
            <div class="lg:col-span-3 bg-white dark:bg-slate-800 p-6 rounded-xl shadow-lg flex flex-col items-center justify-center text-center">
                 <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V16a2 2 0 01-2 2h-1m-6-16l-3 3m0 0l-3-3m3 3V3"></path></svg>
                <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Belum Ada Informasi Jadwal atau Hasil Ujian</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Pastikan pendaftaran Anda sudah terverifikasi untuk mendapatkan jadwal ujian.
                    Hasil ujian akan tampil di sini setelah Anda menyelesaikan tes.
                </p>
            </div>
            @endif
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Pengumuman Terbaru</h4>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">Lihat Semua &rarr;</a>
            </div>
            <div class="space-y-4">
                @forelse ($pengumumanTerbaru as $item)
                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:shadow-md transition-shadow">
                        <a href="#" class="block">
                            <h5 class="font-semibold text-blue-700 dark:text-blue-400 mb-1">{{ $item->judul }}</h5>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                                Dipublikasikan pada: {{ Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d F Y') }}
                                 <span class="mx-1">&bull;</span> Jenis: <span class="capitalize">{{ str_replace('_', ' ', $item->jenis) }}</span>
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-2">{{ Str::limit(strip_tags($item->isi), 150) }}</p>
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada pengumuman terbaru.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-mahasiswa-layout>