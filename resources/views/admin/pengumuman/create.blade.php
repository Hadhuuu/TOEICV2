<x-admin-layout>
    @section('header_title', 'Tambah Pengumuman')

    <div class="p-6 bg-gray-900 text-white rounded-lg">
        <h2 class="text-xl font-bold mb-4">Tambah Pengumuman</h2>

        <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium">Judul</label>
                <input type="text" name="judul" class="mt-1 p-2 w-full rounded bg-gray-800 border border-gray-700 text-white">
            </div>
            <div>
                <label class="block text-sm font-medium">Isi</label>
                <textarea name="isi" rows="4" class="mt-1 p-2 w-full rounded bg-gray-800 border border-gray-700 text-white"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">File (PDF)</label>
                <input type="file" name="file" accept=".pdf" class="mt-1 w-full text-white">
            </div>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded text-white">Simpan</button>
        </form>
    </div>
</x-admin-layout>
