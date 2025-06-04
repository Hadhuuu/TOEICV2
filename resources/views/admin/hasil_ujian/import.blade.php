<x-admin-layout>
    <x-slot name="header_title">
        Impor Hasil Ujian TOEIC
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Unggah File Excel Hasil Ujian
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-slate-800 shadow-xl rounded-xl p-6 md:p-8">
        @if (session('success'))
            <div class="mb-6 bg-green-100 dark:bg-green-900/30 border-l-4 border-green-500 dark:border-green-600 text-green-700 dark:text-green-300 p-4 rounded-md" role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
                @if (session('import_details'))
                    <ul class="list-disc list-inside text-sm mt-2">
                        @foreach (session('import_details') as $detail)
                            <li>{{ $detail }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif

        @if (session('error'))
             <div class="mb-6 bg-red-100 dark:bg-red-900/30 border-l-4 border-red-500 dark:border-red-600 text-red-700 dark:text-red-300 p-4 rounded-md" role="alert">
                <p class="font-bold">Gagal!</p>
                <p>{{ session('error') }}</p>
                 @if (session('import_errors'))
                    <ul class="list-disc list-inside text-sm mt-2">
                        @foreach (session('import_errors') as $errorItem)
                            <li>Baris {{ $errorItem['row'] ?? 'N/A' }}: {{ $errorItem['message'] ?? 'Error tidak diketahui' }}
                                @if (!empty($errorItem['values']))
                                    <pre class="text-xs whitespace-pre-wrap">{{ json_encode($errorItem['values']) }}</pre>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif

        <form action="{{ route('admin.hasil_ujian.import.excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="excel_file" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Pilih File Excel (.xlsx, .xls)</label>
                    <div class="mt-2">
                        <input type="file" name="excel_file" id="excel_file" required
                               class="block w-full text-sm text-slate-500 dark:text-slate-300
                                      file:mr-4 file:py-2.5 file:px-4
                                      file:rounded-lg file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-indigo-50 dark:file:bg-indigo-800 file:text-indigo-700 dark:file:text-indigo-200
                                      hover:file:bg-indigo-100 dark:hover:file:bg-indigo-700
                                      focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800
                                      dark:bg-slate-700/50 dark:border-slate-600 rounded-lg border border-gray-300">
                        @error('excel_file')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <p class="mt-2 text-xs text-gray-500 dark:text-slate-400">
                        Pastikan file Excel memiliki kolom: NIM, Nama Mahasiswa, Tanggal Ujian, Skor Listening, Skor Reading, Skor Total.
                        <br>Format Tanggal Ujian: YYYY-MM-DD atau DD-MM-YYYY atau MM/DD/YYYY.
                        <br><a href="#" class="text-indigo-600 dark:text-indigo-400 hover:underline">Unduh Template Excel (Jika ada)</a>
                    </p>
                </div>

                <div class="pt-2 flex items-center justify-end gap-x-6 border-t border-gray-300 dark:border-slate-700">
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100">Batal</a>
                    <button type="submit"
                            class="rounded-md bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:from-blue-500 hover:to-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors duration-150 transform hover:scale-105">
                        <svg class="w-5 h-5 inline-block mr-1 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        Impor Data Hasil Ujian
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>