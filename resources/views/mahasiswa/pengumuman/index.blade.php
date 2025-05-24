<x-app-layout>
    <div class="p-6 bg-gray-900 text-white rounded-lg space-y-4">
        <h2 class="text-xl font-bold">Pengumuman</h2>
        @foreach($pengumuman as $p)
            <div class="p-4 bg-gray-800 rounded shadow">
                <h3 class="text-lg font-semibold">{{ $p->judul }}</h3>
                <p class="mt-2">{{ $p->isi }}</p>
                @if($p->file)
                    <a href="{{ asset('storage/' . $p->file) }}" target="_blank" class="text-indigo-400 underline mt-2 block">Lihat Lampiran PDF</a>
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>
