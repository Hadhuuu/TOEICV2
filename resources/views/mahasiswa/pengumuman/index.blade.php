{{-- Menggunakan komponen layout mahasiswa --}}
{{-- Atribut 'header_title' di sini akan diteruskan ke komponen mahasiswa-layout.blade.php --}}
<x-mahasiswa-layout :header_title="'Pengumuman'"> {{-- Pastikan nama komponen (mahasiswa-layout) sesuai dengan nama file tanpa .blade.php dan case-nya (biasanya kebab-case) --}}

    {{-- Konten spesifik untuk halaman pengumuman akan otomatis masuk ke dalam $slot default komponen --}}
    <div class="container mx-auto p-4 md:p-8">
        {{-- Judul Halaman di dalam Konten --}}
        <h1 class="text-3xl font-bold text-slate-100 mb-8">Pengumuman</h1>

        {{-- Pesan Sukses --}}
        @if(session('success'))
            <div class="bg-green-600 border border-green-500 text-green-50 px-4 py-3 rounded-md relative mb-6 shadow-md" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Konten Pengumuman --}}
        @if($pengumuman->isEmpty())
            <div class="bg-slate-800 border border-slate-700 text-slate-400 px-6 py-8 rounded-lg shadow-md text-center" role="alert">
                <svg class="mx-auto h-12 w-12 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.676.75.75 0 01.819.162l3.192 3.192a.75.75 0 01-1.06 1.06l-3.192-3.192a8.97 8.97 0 00-3.463.676A9 9 0 0015 21a9 9 0 00-9-9 8.97 8.97 0 00-.676-3.463.75.75 0 01.162-.819l3.192-3.192a.75.75 0 011.06-1.06l-3.192 3.192zM15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-slate-300">Belum ada pengumuman</h3>
                <p class="mt-1 text-sm text-slate-400">Silakan periksa kembali nanti.</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach($pengumuman as $item)
                    <article class="bg-slate-800 shadow-lg rounded-lg p-6 border border-slate-700 hover:shadow-indigo-500/30 transition-shadow duration-300">
                        <h2 class="text-2xl font-semibold text-indigo-400 mb-3">{{ $item->judul }}</h2>
                        <p class="text-sm text-slate-400 mb-4">
                            Dipublikasikan pada: {{ $item->tanggal_publish ? $item->tanggal_publish->translatedFormat('l, d F Y \p\u\k\u\l H:i') : 'Tanggal tidak tersedia' }}
                        </p>
                        <div class="text-slate-300 prose prose-sm sm:prose prose-invert max-w-none mb-4">
                            {!! nl2br(e($item->isi)) !!}
                        </div>

                       @if($item->file)
                    <div class="mt-6">
                        <a href="{{ Storage::url($item->file) }}"
                        target="_blank" {{-- Membuka PDF di tab baru --}}
                        class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition duration-150 ease-in-out shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                        Unduh Dokumen Lampiran
                        </a>
                </div>
                    @endif
                    </article>
                @endforeach
            </div>

            @if ($pengumuman->hasPages())
            <div class="mt-10 p-4 bg-slate-800 rounded-md shadow">
                 {{ $pengumuman->links() }}
            </div>
            @endif
        @endif
    </div>
</x-mahasiswa-layout>