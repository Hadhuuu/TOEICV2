{{-- resources/views/admin/users/_form_fields.blade.php --}}
@csrf
<div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
    <div class="sm:col-span-3">
        <label for="name" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Nama Lengkap <span class="text-red-500">*</span></label>
        <div class="mt-1">
            <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" required
                   class="block w-full rounded-lg border-0 py-2.5 text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 placeholder:text-gray-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-white dark:bg-slate-700/50">
            @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="sm:col-span-3">
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Alamat Email <span class="text-red-500">*</span></label>
        <div class="mt-1">
            <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" required
                   class="block w-full rounded-lg border-0 py-2.5 text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 placeholder:text-gray-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-white dark:bg-slate-700/50">
            @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="sm:col-span-3">
        <label for="password" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Password @if(!isset($user))<span class="text-red-500">*</span>@endif</label>
        <div class="mt-1">
            <input type="password" name="password" id="password" {{ !isset($user) ? 'required' : '' }}
                   class="block w-full rounded-lg border-0 py-2.5 text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 placeholder:text-gray-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-white dark:bg-slate-700/50">
            @if(isset($user)) <p class="mt-1 text-xs text-gray-500 dark:text-slate-400">Kosongkan jika tidak ingin mengubah password.</p> @endif
            @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="sm:col-span-3">
        <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Konfirmasi Password @if(!isset($user))<span class="text-red-500">*</span>@endif</label>
        <div class="mt-1">
            <input type="password" name="password_confirmation" id="password_confirmation" {{ !isset($user) ? 'required' : '' }}
                   class="block w-full rounded-lg border-0 py-2.5 text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 placeholder:text-gray-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-white dark:bg-slate-700/50">
        </div>
    </div>

    <div class="sm:col-span-3">
        <label for="role" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Role <span class="text-red-500">*</span></label>
        <div class="mt-1">
            <select id="role" name="role" required
                    class="block w-full rounded-lg border-0 py-2.5 pl-3 pr-10 text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-white dark:bg-slate-700/50">
                <option value="mahasiswa" {{ old('role', $user->role ?? '') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>
    
    {{-- Field tambahan untuk profil mahasiswa, hanya muncul jika role mahasiswa dipilih --}}
    <div class="sm:col-span-6" id="mahasiswa_fields" style="{{ old('role', $user->role ?? 'mahasiswa') == 'mahasiswa' ? '' : 'display:none;' }}">
        <div class="mt-6 border-t border-gray-300 dark:border-slate-700 pt-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-200">Detail Profil Mahasiswa (Opsional)</h3>
        </div>
        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6 mt-4">
            <div class="sm:col-span-3">
                <label for="nim" class="block text-sm font-medium text-gray-900 dark:text-gray-200">NIM</label>
                <input type="text" name="nim" id="nim" value="{{ old('nim', $user->mahasiswaProfile->nim ?? '') }}"
                       class="mt-1 block w-full rounded-lg border-0 py-2.5 text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 placeholder:text-gray-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-white dark:bg-slate-700/50">
                @error('nim') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            <div class="sm:col-span-3">
                <label for="nik" class="block text-sm font-medium text-gray-900 dark:text-gray-200">NIK</label>
                <input type="text" name="nik" id="nik" value="{{ old('nik', $user->mahasiswaProfile->nik ?? '') }}"
                       class="mt-1 block w-full rounded-lg border-0 py-2.5 text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-slate-700 placeholder:text-gray-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 sm:text-sm sm:leading-6 bg-white dark:bg-slate-700/50">
                @error('nik') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            {{-- Tambahkan field profile lainnya di sini jika diperlukan (no_wa, alamat, dll.) --}}
        </div>
    </div>
</div>

<div class="mt-8 pt-6 border-t border-gray-300 dark:border-slate-700 flex items-center justify-end gap-x-6">
    <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100">Batal</a>
    <button type="submit"
            class="rounded-md bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors duration-150 transform hover:scale-105">
        {{ isset($user) ? 'Update User' : 'Simpan User Baru' }}
    </button>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role');
        const mahasiswaFieldsDiv = document.getElementById('mahasiswa_fields');

        function toggleMahasiswaFields() {
            if (roleSelect.value === 'mahasiswa') {
                mahasiswaFieldsDiv.style.display = '';
            } else {
                mahasiswaFieldsDiv.style.display = 'none';
            }
        }
        // Initial check
        toggleMahasiswaFields();
        // Event listener
        roleSelect.addEventListener('change', toggleMahasiswaFields);
    });
</script>
@endpush