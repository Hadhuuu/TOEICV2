<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pendaftaran TOEIC</title>
    {{-- Pastikan Anda sudah mengintegrasikan Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Tambahan custom style jika diperlukan, misalnya untuk font */
        body {
            font-family: 'Inter', sans-serif; /* Contoh penggunaan font Inter */
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.95); /* Sedikit transparan untuk efek modern */
            backdrop-filter: blur(10px); /* Efek glassmorphism jika didukung browser */
        }
    </style>
</head>
<body class="gradient-bg flex items-center justify-center min-h-screen antialiased">
    <div class="form-container p-8 md:p-12 rounded-xl shadow-2xl w-full max-w-md">
        <div class="text-center mb-8">
            {{-- Ganti dengan logo Anda jika ada --}}
            <svg class="w-20 h-20 mx-auto mb-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.75c-2.676 0-5.17-1.013-7-2.75L12 14z"></path></svg>
            <h1 class="text-3xl font-bold text-gray-800">Selamat Datang!</h1>
            <p class="text-gray-600 mt-2">Silakan login untuk melanjutkan ke sistem pendaftaran TOEIC.</p>
        </div>

        {{-- Menampilkan error validasi --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md" role="alert">
                <p class="font-bold">Oops! Ada kesalahan:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- Input Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                <input type="email" name="email" id="email"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition duration-150 ease-in-out"
                       placeholder="anda@email.com" value="{{ old('email') }}" required autofocus>
            </div>

            {{-- Input Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition duration-150 ease-in-out"
                       placeholder="Masukkan password Anda" required>
            </div>

            {{-- Remember Me & Lupa Password --}}
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox"
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-800">
                        Ingat Saya
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline transition duration-150 ease-in-out">
                        Lupa password?
                    </a>
                @endif
            </div>

            {{-- Tombol Login --}}
            <div>
                <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out transform hover:scale-105">
                    Login
                </button>
            </div>
        </form>

        {{-- Link ke Halaman Registrasi (jika ada) --}}
        @if (Route::has('register'))
            <p class="mt-8 text-center text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-800 hover:underline transition duration-150 ease-in-out">
                    Daftar di sini
                </a>
            </p>
        @endif
         <p class="mt-4 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} UPA Bahasa - Pendaftaran TOEIC. All rights reserved.
        </p>
    </div>
</body>
</html>