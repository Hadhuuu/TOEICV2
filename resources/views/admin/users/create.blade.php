<x-admin-layout>
    <x-slot name="header_title">
        Tambah User Baru
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Formulir Tambah Pengguna Baru
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-slate-800 shadow-xl rounded-xl p-6 md:p-8">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @include('admin.users._form_fields')
        </form>
    </div>
</x-admin-layout>