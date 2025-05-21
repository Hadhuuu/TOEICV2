<x-admin-layout>
    <x-slot name="header_title">
        Edit User: {{ $user->name }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Edit Data Pengguna: <span class="text-indigo-500 dark:text-indigo-400">{{ $user->name }}</span>
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-slate-800 shadow-xl rounded-xl p-6 md:p-8">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @method('PUT')
            @include('admin.users._form_fields', ['user' => $user])
        </form>
    </div>
</x-admin-layout>