<x-admin-layout>
    <x-slot name="header_title">
        Detail User: {{ $user->name }}
    </x-slot>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                Detail Pengguna: <span class="text-indigo-500 dark:text-indigo-400">{{ $user->name }}</span>
            </h2>
            <a href="{{ route('admin.users.edit', $user) }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md text-sm transition-colors">
                Edit User Ini
            </a>
        </div>
    </x-slot>

    <div class="bg-white dark:bg-slate-800 shadow-xl rounded-xl p-6 md:p-8">
        <div class="space-y-4">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-slate-400">ID Pengguna</p>
                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $user->id }}</p>
            </div>
            <div class="border-t border-gray-200 dark:border-slate-700 pt-4">
                <p class="text-sm font-medium text-gray-500 dark:text-slate-400">Nama Lengkap</p>
                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
            </div>
            <div class="border-t border-gray-200 dark:border-slate-700 pt-4">
                <p class="text-sm font-medium text-gray-500 dark:text-slate-400">Alamat Email</p>
                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $user->email }}</p>
            </div>
            <div class="border-t border-gray-200 dark:border-slate-700 pt-4">
                <p class="text-sm font-medium text-gray-500 dark:text-slate-400">Role</p>
                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                     <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $user->role == 'admin' ? 'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200' : 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200' }}">
                        {{ Str::title($user->role) }}
                    </span>
                </p>
            </div>
             <div class="border-t border-gray-200 dark:border-slate-700 pt-4">
                <p class="text-sm font-medium text-gray-500 dark:text-slate-400">Email Terverifikasi</p>
                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                    {{ $user->email_verified_at ? $user->email_verified_at->translatedFormat('d M Y, H:i') : 'Belum' }}
                </p>
            </div>
            <div class="border-t border-gray-200 dark:border-slate-700 pt-4">
                <p class="text-sm font-medium text-gray-500 dark:text-slate-400">Tanggal Terdaftar</p>
                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $user->created_at->translatedFormat('l, d F Y, H:i') }}</p>
            </div>

            @if ($user->role === 'mahasiswa' && $user->mahasiswaProfile)
                <div class="border-t border-gray-200 dark:border-slate-700 pt-6 mt-6">
                     <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-200">Detail Profil Mahasiswa</h3>
                </div>
                <div class="border-t border-gray-200 dark:border-slate-700 pt-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-slate-400">NIM</p>
                    <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $user->mahasiswaProfile->nim ?? '-' }}</p>
                </div>
                <div class="border-t border-gray-200 dark:border-slate-700 pt-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-slate-400">NIK</p>
                    <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $user->mahasiswaProfile->nik ?? '-' }}</p>
                </div>
                <div class="border-t border-gray-200 dark:border-slate-700 pt-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-slate-400">No. WhatsApp</p>
                    <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $user->mahasiswaProfile->no_wa ?? '-' }}</p>
                </div>
                 <div class="border-t border-gray-200 dark:border-slate-700 pt-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-slate-400">Kampus</p>
                    <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $user->mahasiswaProfile->kampus ?? '-' }}</p>
                </div>
                 <div class="border-t border-gray-200 dark:border-slate-700 pt-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-slate-400">Jurusan / Program Studi</p>
                    <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $user->mahasiswaProfile->jurusan ?? '-' }} / {{ $user->mahasiswaProfile->program_studi ?? '-' }}</p>
                </div>
                {{-- Tambahkan field profile lainnya --}}
            @endif
        </div>
         <div class="mt-8 pt-6 border-t border-gray-200 dark:border-slate-700">
            <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold leading-6 text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">&larr; Kembali ke Daftar User</a>
        </div>
    </div>
</x-admin-layout>