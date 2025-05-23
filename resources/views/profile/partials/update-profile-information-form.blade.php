<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Perbarui informasi profil akun Anda dan alamat email.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Nama dan Email dalam satu baris (2 kolom) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full dark:bg-slate-700/50 dark:text-gray-100 dark:border-slate-600" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Alamat Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full dark:bg-slate-700/50 dark:text-gray-100 dark:border-slate-600" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-sm text-gray-800 dark:text-gray-200">
                            {{ __('Alamat email Anda belum terverifikasi.') }}
                            <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                            </button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        {{-- Divider --}}
        <div class="border-t border-gray-200 dark:border-slate-700 my-8"></div> {{-- Tambah margin atas bawah --}}

        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Detail Data Mahasiswa') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Lengkapi atau perbarui detail data kemahasiswaan Anda.") }}
            </p>
        </header>
        
        {{-- Data Mahasiswa dalam Grid 2 Kolom --}}
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
            <div>
                <x-input-label for="nim" :value="__('NIM (Nomor Induk Mahasiswa)')" />
                <x-text-input id="nim" name="nim" type="text" class="mt-1 block w-full dark:bg-slate-700/50 dark:text-gray-100 dark:border-slate-600 {{ $user->mahasiswaProfile && $user->mahasiswaProfile->nim ? 'bg-gray-100 dark:bg-slate-800 cursor-not-allowed' : '' }}" 
                              :value="old('nim', $user->mahasiswaProfile->nim ?? '')" 
                              :readonly="$user->mahasiswaProfile && $user->mahasiswaProfile->nim" /> 
                <x-input-error class="mt-2" :messages="$errors->get('nim')" />
                @if($user->mahasiswaProfile && $user->mahasiswaProfile->nim)
                    <p class="mt-1 text-xs text-gray-500 dark:text-slate-400">NIM tidak dapat diubah. Hubungi admin jika ada kesalahan.</p>
                @endif
            </div>

            <div>
                <x-input-label for="nik" :value="__('NIK (Nomor Induk Kependudukan)')" />
                <x-text-input id="nik" name="nik" type="text" class="mt-1 block w-full dark:bg-slate-700/50 dark:text-gray-100 dark:border-slate-600" :value="old('nik', $user->mahasiswaProfile->nik ?? '')" />
                <x-input-error class="mt-2" :messages="$errors->get('nik')" />
            </div>

            <div>
                <x-input-label for="no_wa" :value="__('Nomor WhatsApp Aktif')" />
                <x-text-input id="no_wa" name="no_wa" type="text" placeholder="Contoh: 08123456789" class="mt-1 block w-full dark:bg-slate-700/50 dark:text-gray-100 dark:border-slate-600" :value="old('no_wa', $user->mahasiswaProfile->no_wa ?? '')" />
                <x-input-error class="mt-2" :messages="$errors->get('no_wa')" />
            </div>

            <div>
                <x-input-label for="kampus" :value="__('Kampus')" />
                @php
                    $kampusOptions = ['Utama', 'PSDKU Kediri', 'PSDKU Lumajang', 'PSDKU Pamekasan'];
                @endphp
                <select id="kampus" name="kampus" class="mt-1 block w-full rounded-md shadow-sm dark:bg-slate-700/50 dark:text-gray-100 dark:border-slate-600 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">
                    <option value="">Pilih Kampus</option>
                    @foreach ($kampusOptions as $kampus)
                        <option value="{{ $kampus }}" {{ old('kampus', $user->mahasiswaProfile->kampus ?? '') == $kampus ? 'selected' : '' }}>{{ $kampus }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('kampus')" />
            </div>

            <div>
                <x-input-label for="jurusan" :value="__('Jurusan')" />
                <x-text-input id="jurusan" name="jurusan" type="text" class="mt-1 block w-full dark:bg-slate-700/50 dark:text-gray-100 dark:border-slate-600" :value="old('jurusan', $user->mahasiswaProfile->jurusan ?? '')" />
                <x-input-error class="mt-2" :messages="$errors->get('jurusan')" />
            </div>

            <div>
                <x-input-label for="program_studi" :value="__('Program Studi')" />
                <x-text-input id="program_studi" name="program_studi" type="text" class="mt-1 block w-full dark:bg-slate-700/50 dark:text-gray-100 dark:border-slate-600" :value="old('program_studi', $user->mahasiswaProfile->program_studi ?? '')" />
                <x-input-error class="mt-2" :messages="$errors->get('program_studi')" />
            </div>
        </div> {{-- End of 2-column grid for mahasiswa details --}}
        
        {{-- Alamat Asal (Full width) --}}
        <div class="mt-6"> {{-- Tambahkan margin top jika perlu --}}
            <x-input-label for="alamat_asal" :value="__('Alamat Asal (sesuai KTP)')" />
            <textarea id="alamat_asal" name="alamat_asal" rows="3" class="mt-1 block w-full rounded-md shadow-sm dark:bg-slate-700/50 dark:text-gray-100 dark:border-slate-600 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">{{ old('alamat_asal', $user->mahasiswaProfile->alamat_asal ?? '') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('alamat_asal')" />
        </div>

        {{-- Alamat Sekarang (Full width) --}}
        <div class="mt-6"> {{-- Tambahkan margin top jika perlu --}}
            <x-input-label for="alamat_sekarang" :value="__('Alamat Sekarang (Domisili)')" />
            <textarea id="alamat_sekarang" name="alamat_sekarang" rows="3" class="mt-1 block w-full rounded-md shadow-sm dark:bg-slate-700/50 dark:text-gray-100 dark:border-slate-600 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">{{ old('alamat_sekarang', $user->mahasiswaProfile->alamat_sekarang ?? '') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('alamat_sekarang')" />
        </div>

        <div class="flex items-center gap-4 mt-8"> {{-- Tambah margin top --}}
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600">{{ __('Simpan Perubahan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)" {{-- Durasi pesan diperpanjang --}}
                    class="text-sm text-green-600 dark:text-green-400"
                >{{ __('Berhasil disimpan.') }}</p>
            @endif
        </div>
    </form>
</section>