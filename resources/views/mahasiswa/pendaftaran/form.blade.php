<x-mahasiswa-layout>
    <x-slot name="header_title">
        Pendaftaran Ujian TOEIC
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Formulir Pendaftaran Ujian TOEIC
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-slate-800 shadow-xl rounded-xl p-6 md:p-8">
        @if (session('success'))
            <div class="mb-6 bg-green-100 dark:bg-green-900/30 border-l-4 border-green-500 dark:border-green-600 text-green-700 dark:text-green-300 p-4 rounded-md" role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-red-100 dark:bg-red-900/30 border-l-4 border-red-500 dark:border-red-600 text-red-700 dark:text-red-300 p-4 rounded-md" role="alert">
                <p class="font-bold">Error!</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if (!$bisaMendaftarBaru && $pesanStatus)
            {{-- Tampilkan Status Pendaftaran Saat Ini --}}
            <div class="bg-blue-50 dark:bg-blue-900/30 border-l-4 border-blue-500 dark:border-blue-600 text-blue-700 dark:text-blue-300 p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-3">Informasi Pendaftaran Anda</h3>
                <p class="mb-2">{{ $pesanStatus }}</p>
                @if($pendaftaranTerakhir)
                <p class="text-sm">Tanggal Pendaftaran: {{ $pendaftaranTerakhir->created_at->translatedFormat('l, d F Y H:i') }}</p>
                @if($pendaftaranTerakhir->status === 'ditolak' && $pendaftaranTerakhir->catatan_admin)
                <p class="text-sm mt-2 pt-2 border-t border-blue-200 dark:border-blue-700">Catatan Admin: {{ $pendaftaranTerakhir->catatan_admin }}</p>
                @endif
                @endif
                 <a href="{{ route('mahasiswa.dashboard') }}" class="mt-4 inline-block text-sm text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md font-medium">
                    Kembali ke Beranda
                </a>
            </div>
        @elseif ($pendaftaranTerakhir && $pendaftaranTerakhir->status === 'ditolak')
             <div class="mb-6 bg-yellow-50 dark:bg-yellow-900/30 border-l-4 border-yellow-500 dark:border-yellow-600 text-yellow-700 dark:text-yellow-300 p-4 rounded-md" role="alert">
                <p class="font-bold">Informasi</p>
                <p>Pendaftaran Anda sebelumnya ditolak. Catatan: {{ $pendaftaranTerakhir->catatan_admin ?: 'Tidak ada catatan.' }}. Anda dapat melakukan pendaftaran baru di bawah ini.</p>
            </div>
            @include('mahasiswa.pendaftaran._form_fields') {{-- Kita akan buat partial untuk form --}}
        @else
            {{-- Tampilkan Form Pendaftaran --}}
            @include('mahasiswa.pendaftaran._form_fields')
        @endif
    </div>

</x-mahasiswa-layout>