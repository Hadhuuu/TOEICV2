{{-- resources/views/mahasiswa/pendaftaran/_form_fields.blade.php --}}
<form action="{{ route('mahasiswa.pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf

    {{-- Data Diri Mahasiswa --}}
    <div class="border-b border-gray-300 dark:border-slate-700 pb-6">
        <h3 class="text-xl font-semibold leading-7 text-gray-900 dark:text-gray-100">Data Diri Mahasiswa</h3>
        <p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-400">Pastikan data yang Anda masukkan sudah benar dan sesuai.</p>
    </div>

    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Nama Lengkap (sesuai KTP)</label>
            <div class="mt-2">
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" readonly
                       class="block w-full rounded-md border-0 py-2.5 text-gray-900 dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-gray-100 dark:bg-slate-800 cursor-not-allowed">
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Alamat Email</label>
            <div class="mt-2">
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" readonly
                       class="block w-full rounded-md border-0 py-2.5 text-gray-900 dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-gray-100 dark:bg-slate-800 cursor-not-allowed">
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="nim" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">NIM <span class="text-red-500">*</span></label>
            <div class="mt-2">
                <input type="text" name="nim" id="nim" value="{{ old('nim', $profileData->nim) }}" required
                       class="block w-full rounded-md border-0 py-2.5 text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 placeholder:text-gray-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-white dark:bg-slate-700/50">
                @error('nim') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="nik" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">NIK (Nomor Induk Kependudukan) <span class="text-red-500">*</span></label>
            <div class="mt-2">
                <input type="text" name="nik" id="nik" value="{{ old('nik', $profileData->nik) }}" required
                       class="block w-full rounded-md border-0 py-2.5 text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 placeholder:text-gray-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-white dark:bg-slate-700/50">
                @error('nik') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>
        
        <div class="sm:col-span-3">
            <label for="no_wa" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Nomor WhatsApp Aktif <span class="text-red-500">*</span></label>
            <div class="mt-2">
                <input type="text" name="no_wa" id="no_wa" value="{{ old('no_wa', $profileData->no_wa) }}" required placeholder="Contoh: 081234567890"
                       class="block w-full rounded-md border-0 py-2.5 text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 placeholder:text-gray-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-white dark:bg-slate-700/50">
                @error('no_wa') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="kampus" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Kampus <span class="text-red-500">*</span></label>
            <div class="mt-2">
                <select id="kampus" name="kampus" required
                        class="block w-full rounded-md border-0 py-2.5 text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-white dark:bg-slate-700/50">
                    <option value="">Pilih Kampus</option>
                    @foreach ($kampusOptions as $kampus)
                        <option value="{{ $kampus }}" {{ old('kampus', $profileData->kampus) == $kampus ? 'selected' : '' }}>{{ $kampus }}</option>
                    @endforeach
                </select>
                @error('kampus') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="jurusan" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Jurusan <span class="text-red-500">*</span></label>
            <div class="mt-2">
                <input type="text" name="jurusan" id="jurusan" value="{{ old('jurusan', $profileData->jurusan) }}" required
                       class="block w-full rounded-md border-0 py-2.5 text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 placeholder:text-gray-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-white dark:bg-slate-700/50">
                @error('jurusan') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="program_studi" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Program Studi <span class="text-red-500">*</span></label>
            <div class="mt-2">
                <input type="text" name="program_studi" id="program_studi" value="{{ old('program_studi', $profileData->program_studi) }}" required
                       class="block w-full rounded-md border-0 py-2.5 text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 placeholder:text-gray-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-white dark:bg-slate-700/50">
                @error('program_studi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="col-span-full">
            <label for="alamat_asal" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Alamat Asal (sesuai KTP) <span class="text-red-500">*</span></label>
            <div class="mt-2">
                <textarea id="alamat_asal" name="alamat_asal" rows="3" required
                          class="block w-full rounded-md border-0 py-2.5 text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 placeholder:text-gray-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-white dark:bg-slate-700/50">{{ old('alamat_asal', $profileData->alamat_asal) }}</textarea>
                @error('alamat_asal') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="col-span-full">
            <label for="alamat_sekarang" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Alamat Sekarang (Domisili) <span class="text-red-500">*</span></label>
            <div class="mt-2">
                <textarea id="alamat_sekarang" name="alamat_sekarang" rows="3" required
                          class="block w-full rounded-md border-0 py-2.5 text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 placeholder:text-gray-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-white dark:bg-slate-700/50">{{ old('alamat_sekarang', $profileData->alamat_sekarang) }}</textarea>
                @error('alamat_sekarang') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    {{-- Unggah Dokumen --}}
    <div class="border-b border-gray-300 dark:border-slate-700 pb-6 pt-8">
        <h3 class="text-xl font-semibold leading-7 text-gray-900 dark:text-gray-100">Unggah Dokumen</h3>
        <p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-400">Format file yang diterima: JPG, PNG, PDF. Ukuran maksimal: 2MB per file.</p>
    </div>

    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-2">
            <label for="scan_ktp" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Scan KTP <span class="text-red-500">*</span></label>
            <input type="file" name="scan_ktp" id="scan_ktp" required class="mt-2 block w-full text-sm text-slate-500 dark:text-slate-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 dark:file:bg-blue-800 file:text-blue-700 dark:file:text-blue-200 hover:file:bg-blue-100 dark:hover:file:bg-blue-700"/>
            @error('scan_ktp') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
        <div class="sm:col-span-2">
            <label for="scan_ktm" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Scan KTM <span class="text-red-500">*</span></label>
            <input type="file" name="scan_ktm" id="scan_ktm" required class="mt-2 block w-full text-sm text-slate-500 dark:text-slate-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 dark:file:bg-blue-800 file:text-blue-700 dark:file:text-blue-200 hover:file:bg-blue-100 dark:hover:file:bg-blue-700"/>
            @error('scan_ktm') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
        <div class="sm:col-span-2">
            <label for="pas_foto" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Pas Foto Terbaru <span class="text-red-500">*</span></label>
            <input type="file" name="pas_foto" id="pas_foto" required class="mt-2 block w-full text-sm text-slate-500 dark:text-slate-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 dark:file:bg-blue-800 file:text-blue-700 dark:file:text-blue-200 hover:file:bg-blue-100 dark:hover:file:bg-blue-700"/>
            @error('pas_foto') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>
    
    {{-- Persetujuan --}}
    <div class="pt-8">
        <div class="relative flex items-start">
            <div class="flex h-6 items-center">
              <input id="persetujuan" name="persetujuan" type="checkbox" value="1" required class="h-4 w-4 rounded border-gray-300 dark:border-slate-600 text-indigo-600 focus:ring-indigo-600 dark:bg-slate-700 dark:ring-offset-slate-800">
            </div>
            <div class="ml-3 text-sm leading-6">
              <label for="persetujuan" class="font-medium text-gray-900 dark:text-gray-200">Pernyataan <span class="text-red-500">*</span></label>
              <p class="text-gray-500 dark:text-gray-400">Saya menyatakan bahwa semua data yang saya isikan dan dokumen yang saya unggah adalah benar dan dapat dipertanggungjawabkan.</p>
            </div>
        </div>
        @error('persetujuan') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>


    <div class="pt-6 flex items-center justify-end gap-x-6 border-t border-gray-300 dark:border-slate-700">
        <a href="{{ route('mahasiswa.dashboard') }}" class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100">Batal</a>
        <button type="submit"
                class="rounded-md bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors duration-150 transform hover:scale-105">
            Kirim Pendaftaran
        </button>
    </div>
</form>