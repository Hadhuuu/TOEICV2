<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TOEIC App') }} - Mahasiswa</title> {{-- Judul Tab --}}

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            .sidebar-link { color: #d1d5db; /* gray-300 */ }
            .sidebar-link:hover, .sidebar-link.active {
                background-color: rgba(79, 70, 229, 0.3); /* indigo-600 opacity */
                color: #ffffff;
                border-left: 4px solid #6366f1; /* indigo-500 */
                padding-left: calc(0.75rem - 4px);
            }
            .sidebar-link.active { font-weight: 600; }
            .sidebar { background: linear-gradient(180deg, #1f2937 0%, #111827 100%); }
            .navbar-top { background: linear-gradient(90deg, #3b82f6 0%, #6366f1 100%); }
            ::-webkit-scrollbar { width: 8px; height: 8px; }
            ::-webkit-scrollbar-track { background: #1f2937; }
            ::-webkit-scrollbar-thumb { background: #4f46e5; border-radius: 4px; }
            ::-webkit-scrollbar-thumb:hover { background: #6366f1; }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-slate-900">
        <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
            <aside
                class="sidebar w-64 min-h-screen p-4 pt-6 space-y-4 text-white shadow-2xl transform transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-y-0 fixed inset-y-0 left-0 z-30"
                :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
                
                <a href="{{ route('mahasiswa.dashboard') }}" class="flex items-center space-x-3 px-2 mb-8">
                    <svg class="h-10 w-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.75c-2.676 0-5.17-1.013-7-2.75L12 14z"></path></svg>
                    <span class="text-2xl font-extrabold tracking-tight text-white">TOEIC_V2</span>
                </a>

                <nav class="space-y-1.5">
                    <a href="{{ route('mahasiswa.dashboard') }}" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 rounded-md text-sm font-medium transition-colors duration-150 {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span>Beranda</span>
                    </a>
                    <a href="#" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 rounded-md text-sm font-medium transition-colors duration-150 {{-- request()->routeIs('mahasiswa.pendaftaran.*') ? 'active' : '' --}}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        <span>Pendaftaran TOEIC</span>
                    </a>
                    <a href="#" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 rounded-md text-sm font-medium transition-colors duration-150 {{-- request()->routeIs('mahasiswa.jadwal') ? 'active' : '' --}}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>Jadwal Ujian Saya</span>
                    </a>
                    <a href="#" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 rounded-md text-sm font-medium transition-colors duration-150 {{-- request()->routeIs('mahasiswa.hasil') ? 'active' : '' --}}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-4-4H5a4 4 0 000 8h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 001.414 0l2.414-2.414A1 1 0 0116.414 19H19a4 4 0 000-8h-1a4 4 0 00-4 4v2"></path></svg>
                        <span>Hasil Ujian Saya</span>
                    </a>
                    <a href="#" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 rounded-md text-sm font-medium transition-colors duration-150 {{-- request()->routeIs('mahasiswa.pengumuman') ? 'active' : '' --}}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        <span>Pengumuman</span>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 rounded-md text-sm font-medium transition-colors duration-150 {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>Profil Saya</span>
                    </a>
                </nav>
            </aside>

            <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-20 bg-black opacity-50 md:hidden" aria-hidden="true"></div>

            <div class="flex-1 flex flex-col overflow-hidden">
                <header class="navbar-top shadow-md sticky top-0 z-20">
                    <div class="max-w-full mx-auto py-3 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between h-12">
                            <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 rounded-md p-1">
                                <span class="sr-only">Open sidebar</span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                            </button>
                            <div class="flex-1 text-center md:text-left md:pl-4">
                                <h1 class="text-lg font-semibold text-white">
                                    {{ $header_title ?? 'Dashboard Mahasiswa' }}
                                </h1>
                            </div>
                            <div class="relative">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-gray-200 focus:outline-none transition ease-in-out duration-150">
                                            <div>{{ Auth::user()->name }}</div>
                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                            </div>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                         <div class="bg-white dark:bg-gray-700 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 py-1">
                                            <x-dropdown-link :href="route('profile.edit')" class="dark:text-gray-200 dark:hover:bg-gray-600">
                                                {{ __('Profile') }}
                                            </x-dropdown-link>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-dropdown-link :href="route('logout')"
                                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                                        class="dark:text-gray-200 dark:hover:bg-gray-600">
                                                    {{ __('Log Out') }}
                                                </x-dropdown-link>
                                            </form>
                                        </div>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 dark:bg-slate-800">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                        @if (isset($header))
                            <div class="mb-6 text-gray-900 dark:text-gray-100">
                                {{ $header }}
                            </div>
                        @endif
                        {{ $slot }}
                    </div>
                </main>
                <footer class="text-center p-4 text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-slate-800">
                    &copy; {{ date('Y') }} TOEIC_V2. UPA Bahasa. All rights reserved.
                </footer>
            </div>
        </div>
        @stack('scripts')
    </body>
</html>