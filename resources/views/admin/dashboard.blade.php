<x-admin-layout>
    <x-slot name="header_title">
        Dashboard Admin
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ringkasan Sistem Pendaftaran TOEIC
        </h2>
    </x-slot>

    {{-- Konten Utama Dashboard --}}
    <div class="space-y-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Card Total Pendaftar --}}
            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-6 rounded-xl shadow-lg text-white transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-80">Total Pendaftar</p>
                        <p class="text-3xl font-bold">{{ $totalPendaftar }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
            </div>
            {{-- Card Menunggu Verifikasi --}}
            <div class="bg-gradient-to-br from-yellow-400 to-orange-500 p-6 rounded-xl shadow-lg text-white transform hover:scale-105 transition-transform duration-300">
                 <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-80">Menunggu Verifikasi</p>
                        <p class="text-3xl font-bold">{{ $pendaftarMenungguVerifikasi }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </div>
                </div>
            </div>
            {{-- Card Jadwal Aktif --}}
            <div class="bg-gradient-to-br from-green-500 to-teal-600 p-6 rounded-xl shadow-lg text-white transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-80">Jadwal Ujian Aktif</p>
                        <p class="text-3xl font-bold">{{ $jadwalUjianAktif }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
            </div>
            {{-- Card Peserta Sudah Ujian --}}
            <div class="bg-gradient-to-br from-purple-500 to-pink-600 p-6 rounded-xl shadow-lg text-white transform hover:scale-105 transition-transform duration-300">
                 <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-80">Selesai Ujian (30hr)</p>
                        <p class="text-3xl font-bold">{{ $totalPesertaSudahUjian30Hari }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            {{-- Chart Pendaftar Mingguan --}}
            <div class="lg:col-span-3 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg h-80 md:h-96"> {{-- TAMBAHKAN CLASS TINGGI: misal h-80 (320px) atau h-96 (384px) --}}
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Pendaftar Baru (4 Minggu Terakhir)</h3>
                <canvas id="pendaftarMingguanChart"></canvas>
            </div>
            {{-- Chart Distribusi Kampus --}}
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Distribusi Pendaftar per Kampus</h3>
                <canvas id="distribusiKampusChart" class="max-h-72 mx-auto"></canvas>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Pendaftar Terbaru Menunggu Verifikasi --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Menunggu Verifikasi</h3>
                <div class="space-y-3">
                    @forelse ($pendaftarTerbaruMenunggu as $pendaftaran)
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                            <div>
                                <p class="font-medium text-blue-600 dark:text-blue-400">{{ $pendaftaran->user->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $pendaftaran->user->email }} - Daftar: {{ $pendaftaran->created_at->translatedFormat('d M Y, H:i') }}</p>
                            </div>
                            <a href="#" class="text-xs px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-full transition-colors">Detail</a>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Tidak ada pendaftar yang menunggu verifikasi saat ini.</p>
                    @endforelse
                </div>
            </div>

            {{-- Jadwal Ujian Terdekat --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Jadwal Ujian Terdekat</h3>
                <div class="space-y-3">
                     @forelse ($jadwalTerdekat as $jadwal)
                        <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-md">
                            <p class="font-medium text-indigo-600 dark:text-indigo-400">{{ $jadwal->lokasi }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ Carbon\Carbon::parse($jadwal->tanggal_ujian_mulai)->translatedFormat('l, d M Y, H:i') }}
                                @if($jadwal->tanggal_ujian_selesai)
                                    - {{ Carbon\Carbon::parse($jadwal->tanggal_ujian_selesai)->translatedFormat('H:i') }}
                                @endif
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Kuota: {{ $jadwal->kuota }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Tidak ada jadwal ujian terdekat.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data dari Controller (pastikan di-escape dengan benar jika dari PHP langsung)
        const labelsPendaftarMingguan = @json($labelsPendaftarMingguan);
        const dataPendaftarMingguan = @json($dataPendaftarMingguan);

        const distribusiKampusData = @json($distribusiKampus);
        const labelsDistribusiKampus = Object.keys(distribusiKampusData);
        const dataDistribusiKampus = Object.values(distribusiKampusData);

        // Chart Pendaftar Mingguan
        const pendaftarMingguanCtx = document.getElementById('pendaftarMingguanChart').getContext('2d');
        new Chart(pendaftarMingguanCtx, {
            type: 'bar',
            data: {
                labels: labelsPendaftarMingguan,
                datasets: [{
                    label: 'Jumlah Pendaftar',
                    data: dataPendaftarMingguan,
                    backgroundColor: 'rgba(59, 130, 246, 0.6)', // blue-500
                    borderColor: 'rgba(59, 130, 246, 1)',     // blue-500
                    borderWidth: 1,
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1, // Jika jumlahnya kecil
                            color: document.body.classList.contains('dark') ? '#9ca3af' : '#6b7280', // gray-400 or gray-500
                        },
                        grid: {
                            color: document.body.classList.contains('dark') ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.05)',
                        }
                    },
                    x: {
                         ticks: {
                            color: document.body.classList.contains('dark') ? '#9ca3af' : '#6b7280',
                        },
                        grid: {
                            display: false,
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Sembunyikan legend jika hanya 1 dataset
                    }
                }
            }
        });

        // Chart Distribusi Kampus
        const distribusiKampusCtx = document.getElementById('distribusiKampusChart').getContext('2d');
        new Chart(distribusiKampusCtx, {
            type: 'doughnut', // atau 'pie'
            data: {
                labels: labelsDistribusiKampus,
                datasets: [{
                    label: 'Distribusi Kampus',
                    data: dataDistribusiKampus,
                    backgroundColor: [ // Sediakan warna yang cukup untuk setiap kampus
                        'rgba(59, 130, 246, 0.7)',  // blue-500
                        'rgba(16, 185, 129, 0.7)', // green-500
                        'rgba(239, 68, 68, 0.7)',   // red-500
                        'rgba(245, 158, 11, 0.7)',  // yellow-500 (amber)
                        'rgba(139, 92, 246, 0.7)',  // violet-500
                    ],
                    borderColor: document.body.classList.contains('dark') ? '#374151' : '#ffffff', // gray-700 or white
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                             color: document.body.classList.contains('dark') ? '#e5e7eb' : '#374151', // gray-200 (putih keabuan) untuk dark mode, gray-700 untuk light
                            font: {
                                size: 17 // Ukuran font legenda jika perlu
                            },
                             boxWidth: 15,
                             padding: 15
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
</x-admin-layout>