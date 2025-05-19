<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">


        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            .sidebar-link:hover, .sidebar-link.active {
                background-color: #4a5568; /* bg-gray-700 for dark mode */
                color: #ffffff; /* text-white */
            }
            .sidebar-link.active {
                 border-left: 4px solid #4299e1; /* border-blue-500 */
            }
            .sidebar {
                background: linear-gradient(180deg, #374151 0%, #1f2937 100%); /* Gradasi abu-abu gelap untuk sidebar */
            }
            .navbar-top {
                 background: #ffffff; /* Putih untuk navbar atas */
            }
            .dark .navbar-top {
                background: #1f2937; /* Abu-abu gelap untuk navbar atas di dark mode */
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
        <div class="flex h-screen overflow-hidden">
            <aside class="sidebar w-64 min-h-screen p-4 space-y-4 text-white hidden md:block shadow-lg">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 px-2 py-3 mb-4">
                    {{-- Ganti dengan SVG logo Anda jika ada --}}
                    <svg class="h-8 w-auto text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                         <path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm3.586 6.414a1 1 0 010-1.414l3-3a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-xl font-bold">{{ config('app.name', 'TOEIC App') }}</span>
                </a>

                <nav class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 rounded-md text-sm font-medium transition-colors duration-150 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span>Dashboard</span>
                    </a>
                    {{-- Ganti # dengan route yang sesuai nanti --}}
                    <a href="#" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 rounded-md text-sm font-medium transition-colors duration-150">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span>Kelola Pengumuman</span>
                    </a>
                    <a href="#" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 rounded-md text-sm font-medium transition-colors duration-150">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <span>Verifikasi Pendaftar</span>
                    </a>
                    <a href="#" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 rounded-md text-sm font-medium transition-colors duration-150">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>Kelola Jadwal Ujian</span>
                    </a>
                    <a href="#" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 rounded-md text-sm font-medium transition-colors duration-150">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        <span>Input/Kelola Hasil</span>
                    </a>
                    <a href="#" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 rounded-md text-sm font-medium transition-colors duration-150">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <span>Manajemen User</span>
                    </a>
                </nav>
            </aside>

            <div class="flex-1 flex flex-col overflow-hidden">
                <header class="navbar-top dark:bg-gray-800 shadow-md">
                    <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                        <button class="md:hidden text-gray-500 dark:text-gray-400 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>
                        
                        <div class="hidden md:block text-xl font-semibold text-gray-800 dark:text-gray-200">
                            {{ $header_title ?? 'Dashboard' }} {{-- Variabel untuk judul header halaman --}}
                        </div>

                        <div class="relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </header>

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 dark:bg-gray-900">
                    <div class="container mx-auto px-6 py-8">
                        {{-- Slot untuk judul header dari view spesifik --}}
                        @if (isset($header))
                            <div class="mb-6">
                                {{ $header }}
                            </div>
                        @endif
                        
                        {{ $slot }} {{-- Ini adalah tempat konten utama halaman akan dimuat --}}
                    </div>
                </main>
                 <footer class="text-center p-4 text-sm text-gray-500 dark:text-gray-400 border-t dark:border-gray-700">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Pendaftaran TOEIC') }}. UPA Bahasa. All rights reserved.
                </footer>
            </div>
        </div>
    </body>
</html>