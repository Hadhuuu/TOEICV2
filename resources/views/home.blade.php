<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard TOEIC</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

<!-- Header -->
<header class="bg-white shadow fixed w-full top-0 left-0 z-50">
    <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-6">
            {{-- Logo --}}
            <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 14l9-5-9-5-9 5 9 5z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.75c-2.676 0-5.17-1.013-7-2.75L12 14z"></path>
            </svg>
            <a href="#pengumuman" class="text-blue-600 hover:text-blue-800 font-medium">Pengumuman</a>
            <a href="#kontak" class="text-blue-600 hover:text-blue-800 font-medium">Contact Admin</a>
        </div>
        <a href="/login" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">Login</a>
    </div>
</header>

<!-- Hero Section -->
<section class="w-full h-screen bg-cover bg-center flex flex-col items-center justify-center text-center px-4"
         style="background-image: url('{{ asset('images/toeic-banner.jpg') }}'); margin-top: 64px;">
    <div class="bg-black bg-opacity-50 text-white p-6 rounded max-w-3xl">
        <p class="text-sm uppercase tracking-wide text-green-300 mb-2">Sistem Informasi Pendaftaran TOEIC</p>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Apa Itu TOEIC?</h1>
        <p class="text-lg md:text-xl mb-6 leading-relaxed">
            TOEIC (Test of English for International Communication) adalah tes yang mengukur kemampuan bahasa Inggris
            dalam konteks profesional dan bisnis internasional. Tes ini digunakan oleh banyak institusi dan perusahaan
            sebagai indikator kompetensi bahasa Inggris.
        </p>
        <a href="/login"
           class="bg-yellow-400 hover:bg-yellow-500 text-black px-6 py-3 rounded-full font-semibold transition">
            DAFTAR TOEIC SEKARANG!
        </a>
    </div>
</section>

<!-- Pengumuman -->
<section id="pengumuman" class="max-w-4xl mx-auto py-12 px-4 text-center">
    <h2 class="text-3xl font-semibold mb-2">Pengumuman Terbaru</h2>
    <p class="text-gray-600 mb-4">Cek di bawah!</p>
    <a href="{{ asset('pengumuman.pdf') }}" target="_blank"
       class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition">
        Lihat Pengumuman (PDF)
    </a>
</section>

<!-- Kontak Admin (tujuan scroll) -->
<section id="kontak" class="h-20"></section>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20bertanya%20tentang%20pendaftaran%20TOEIC"
   class="fixed bottom-6 right-6 bg-green-500 hover:bg-green-600 p-3 rounded-full shadow-lg z-50"
   target="_blank" title="Hubungi via WhatsApp">
    <img src="{{ asset('images/whatsapp-icon.png') }}" alt="WhatsApp" class="w-16 h-16"/>
</a>

<!-- Footer -->
<footer class="bg-white text-center py-4 mt-10 border-t text-gray-500 text-sm">
    © 2025 UPA Bahasa - Pendaftaran TOEIC. All rights reserved.
</footer>

</body>
</html>
