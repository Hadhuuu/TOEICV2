<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Sistem Pendaftaran TOEIC</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Pastikan Tailwind CSS terintegrasi --}}
    {{-- Font Awesome untuk ikon (opsional, bisa diganti SVG) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Inter', sans-serif; /* Menggunakan font Inter yang modern */
        }
        .hero-section {
            /* Ganti dengan URL gambar banner Anda yang sebenarnya */
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7)), url('https://languagecenter.unj.ac.id/wp-content/uploads/2023/07/Header-photo-for-TEP-e-scaled.jpg');
            background-size: cover;
            background-position: center;
        }
        .btn-gradient-blue {
            background-image: linear-gradient(to right, #3b82f6 0%, #6366f1 51%, #3b82f6 100%);
            background-size: 200% auto;
            transition: 0.5s;
        }
        .btn-gradient-blue:hover {
            background-position: right center; /* change the direction of the change here */
        }
        .btn-gradient-yellow {
            background-image: linear-gradient(to right, #f59e0b 0%, #facc15 51%, #f59e0b 100%);
            background-size: 200% auto;
            transition: 0.5s;
        }
        .btn-gradient-yellow:hover {
            background-position: right center;
        }
        .section-card {
            background-color: rgba(255, 255, 255, 0.9); /* Sedikit transparan untuk efek modern */
            backdrop-filter: blur(5px); /* Efek glassmorphism jika didukung browser */
        }
        .dark .section-card {
             background-color: rgba(30, 41, 59, 0.8); /* bg-slate-800 dengan opacity */
             backdrop-filter: blur(5px);
        }

    </style>
</head>
<body class="bg-slate-100 dark:bg-slate-900 text-slate-800 dark:text-slate-200 font-sans antialiased">

<!-- Header -->
<header class="bg-white dark:bg-slate-800 shadow-lg fixed w-full top-0 left-0 z-50 transition-colors duration-300">
    <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <a href="#" class="flex items-center space-x-2">
                <svg class="h-10 w-10 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.75c-2.676 0-5.17-1.013-7-2.75L12 14z"></path>
                </svg>
                <span class="text-2xl font-bold text-indigo-700 dark:text-indigo-400">TOEIC_V2</span>
            </a>
            <nav class="hidden md:flex items-center space-x-6">
                <a href="#hero" class="text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition-colors duration-300">Beranda</a>
                <a href="#pengumuman" class="text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition-colors duration-300">Pengumuman</a>
                <a href="#tentang-toeic" class="text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition-colors duration-300">Tentang TOEIC</a>
                <a href="#kontak" class="text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition-colors duration-300">Kontak Admin</a>
            </nav>
            <div class="flex items-center">
                <a href="{{ route('login') }}" class="btn-gradient-blue text-white px-6 py-2.5 rounded-lg font-semibold shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-300 text-sm">
                    Login
                </a>
                {{-- Tombol Mobile Menu (opsional) --}}
                <button class="md:hidden ml-4 text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Hero Section -->
<section id="hero" class="w-full min-h-screen hero-section flex flex-col items-center justify-center text-center px-4 pt-24 pb-12">
    {{-- pt-24 untuk memberi ruang bagi fixed header --}}
    <div class="bg-black bg-opacity-60 text-white p-8 md:p-12 rounded-xl shadow-2xl max-w-3xl">
        <p class="text-sm uppercase tracking-wider text-indigo-300 mb-3 font-semibold">Sistem Informasi Pendaftaran TOEIC</p>
        <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
            TOEIC POLINEMA
        </h1>
        <p class="text-lg md:text-xl mb-8 leading-relaxed text-slate-200">
            Ukur dan buktikan kemampuan bahasa Inggris Anda dalam konteks profesional dan bisnis internasional.
            Daftar sekarang dan buka pintu peluang karir yang lebih luas!
        </p>
        <a href="{{ route('login') }}"
           class="btn-gradient-yellow text-slate-900 px-8 py-4 rounded-lg font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 inline-block">
            <i class="fas fa-rocket mr-2"></i> DAFTAR SEKARANG!
        </a>
    </div>
</section>

<!-- Tentang TOEIC Section -->
<section id="tentang-toeic" class="py-16 md:py-24 bg-slate-50 dark:bg-slate-800">
    <div class="container mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-indigo-700 dark:text-indigo-400 mb-6">Apa Itu TOEIC?</h2>
        <div class="bg-white dark:bg-slate-700 p-8 rounded-xl shadow-xl text-left">
            <p class="text-lg text-slate-700 dark:text-slate-300 leading-relaxed mb-4">
                TOEIC (Test of English for International Communication) adalah sebuah tes standar internasional yang dirancang khusus untuk mengukur kemampuan berbahasa Inggris sehari-hari bagi mereka yang bekerja atau akan bekerja di lingkungan internasional.
            </p>
            <p class="text-lg text-slate-700 dark:text-slate-300 leading-relaxed mb-4">
                Tes ini berfokus pada kemampuan praktis dalam situasi kerja nyata, seperti rapat, korespondensi, presentasi, dan interaksi sosial di tempat kerja. Skor TOEIC diakui secara global oleh ribuan perusahaan, instansi pemerintah, dan institusi pendidikan sebagai tolok ukur kemahiran berbahasa Inggris.
            </p>
            <div class="grid md:grid-cols-2 gap-6 mt-8">
                <div class="bg-indigo-50 dark:bg-indigo-900/30 p-6 rounded-lg">
                    <div class="flex items-center text-indigo-600 dark:text-indigo-300 mb-3">
                        <i class="fas fa-briefcase text-2xl mr-3"></i>
                        <h4 class="text-xl font-semibold">Relevan dengan Dunia Kerja</h4>
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">Soal-soal mencerminkan situasi komunikasi nyata di tempat kerja.</p>
                </div>
                <div class="bg-indigo-50 dark:bg-indigo-900/30 p-6 rounded-lg">
                    <div class="flex items-center text-indigo-600 dark:text-indigo-300 mb-3">
                        <i class="fas fa-globe-americas text-2xl mr-3"></i>
                        <h4 class="text-xl font-semibold">Diakui Internasional</h4>
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">Digunakan oleh perusahaan dan institusi di seluruh dunia.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pengumuman Section -->
<section id="pengumuman" class="py-16 md:py-24">
    <div class="container mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-indigo-700 dark:text-indigo-400 mb-4">Pengumuman Terbaru</h2>
        <p class="text-slate-600 dark:text-slate-400 mb-8 max-w-2xl mx-auto">
            Informasi penting terkait jadwal pendaftaran, pelaksanaan ujian, dan pengambilan sertifikat akan diumumkan di sini. Pastikan Anda selalu memeriksa halaman ini secara berkala.
        </p>
        <div class="bg-white dark:bg-slate-800 p-8 rounded-xl shadow-xl section-card">
            {{-- Di sini Anda bisa menampilkan daftar pengumuman dari database nantinya --}}
            {{-- Untuk saat ini, kita gunakan link PDF --}}
            <div class="flex flex-col items-center">
                <svg class="w-16 h-16 text-indigo-500 dark:text-indigo-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <h3 class="text-xl font-semibold text-slate-700 dark:text-slate-200 mb-2">Jadwal Pendaftaran TOEIC Periode Berikutnya</h3>
                <p class="text-slate-500 dark:text-slate-400 mb-6">Pengumuman resmi mengenai jadwal pendaftaran akan segera dirilis. Silakan unduh dokumen panduan umum di bawah ini.</p>
                <a href="{{ asset('pengumuman.pdf') }}" {{-- Ganti dengan link PDF yang valid --}}
                   target="_blank"
                   class="btn-gradient-blue text-white px-8 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-300 inline-flex items-center">
                    <i class="fas fa-file-pdf mr-2"></i> Lihat Pengumuman (PDF)
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Kontak Admin (tujuan scroll) -->
<section id="kontak" class="py-10"></section>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20bertanya%20tentang%20pendaftaran%20TOEIC"
   class="fixed bottom-8 right-8 bg-green-500 hover:bg-green-600 p-4 rounded-full shadow-2xl z-50 transform hover:scale-110 transition-all duration-300"
   target="_blank" title="Hubungi via WhatsApp">
    {{-- Menggunakan ikon Font Awesome sebagai alternatif jika gambar tidak ada --}}
    <i class="fab fa-whatsapp text-white text-4xl"></i>
    {{-- Atau jika Anda punya gambar: --}}
    {{-- <img src="{{ asset('images/whatsapp-icon.png') }}" alt="WhatsApp" class="w-10 h-10"/> --}}
</a>

<!-- Footer -->
<footer class="bg-slate-800 dark:bg-slate-900 text-center py-8 border-t border-slate-700 dark:border-slate-700">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center mb-4">
            <div class="flex items-center space-x-2 mb-4 md:mb-0">
                <svg class="h-8 w-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.75c-2.676 0-5.17-1.013-7-2.75L12 14z"></path></svg>
                <span class="text-xl font-semibold text-slate-200">TOEIC_V2</span>
            </div>
            <div class="text-sm text-slate-400">
                UPA Bahasa - Politeknik Negeri Malang
            </div>
        </div>
        <p class="text-xs text-slate-500">
            &copy; {{ date('Y') }} Sistem Pendaftaran TOEIC. All rights reserved.
        </p>
    </div>
</footer>

</body>
</html>