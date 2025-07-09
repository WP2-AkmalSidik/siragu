@extends('layouts.admin')
@section('title', 'Dashboard')
@section('description', 'Dashboard Rapor Guru')
@section('content')
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Guru</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $gurus }}</p>
                    <p class="text-sm text-green-600 dark:text-green-400">+{{ $guruThisMonth }} bulan ini</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-blue-600 dark:text-blue-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Penilaian Masuk</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">156</p>
                    <p class="text-sm text-green-600 dark:text-green-400">+12 hari ini</p>
                </div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-line text-green-600 dark:text-green-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nilai Rata-rata</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">87.5</p>
                    <p class="text-sm text-green-600 dark:text-green-400">+2.1 dari bulan lalu</p>
                </div>
                <div class="w-12 h-12 bg-goldspel bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-star text-goldspel"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Rapor Selesai</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">18</p>
                    <p class="text-sm text-bangala">6 dalam proses</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-xl flex items-center justify-center">
                    <i class="fas fa-file-alt text-purple-600 dark:text-purple-400"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Guru Terbaik & Chart -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Guru Terbaik Bulan Ini -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100 dark:border-gray-700">
            <h3 class="text-lg font-semibold mb-3 sm:mb-4 text-gray-900 dark:text-white flex items-center">
                <i class="fas fa-trophy text-yellow-500 mr-2"></i>
                Guru Terbaik {{ tahunAjaranSekarang() }} {{ semesterSekarang() }}
            </h3>

            <div class="space-y-3 sm:space-y-4">
                <!-- Peringkat 1 -->
                <div class="relative overflow-hidden">
                    <div
                        class="flex items-center space-x-3 sm:space-x-4 p-3 sm:p-4 bg-gradient-to-r from-goldspel to-bangala rounded-lg sm:rounded-xl text-white relative z-10">
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-crown text-yellow-300 text-lg sm:text-xl"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold sm:text-base text-gray-800 dark:text-gray-100 truncate">
                                Siti
                                Aminah, S.Pd</p>
                            <p class="text-xs sm:text-sm opacity-90 text-gray-800 dark:text-gray-100 truncate">
                                Guru Matematika</p>
                            <div class="flex items-center mt-1">
                                <div class="flex">
                                    <i class="fas fa-star text-yellow-300 text-xs"></i>
                                    <i class="fas fa-star text-yellow-300 text-xs"></i>
                                    <i class="fas fa-star text-yellow-300 text-xs"></i>
                                    <i class="fas fa-star text-yellow-300 text-xs"></i>
                                    <i class="fas fa-star text-yellow-300 text-xs"></i>
                                </div>
                                <span
                                    class="ml-2 text-xs sm:text-sm text-gray-800 dark:text-gray-100 font-medium">95.2</span>
                            </div>
                        </div>
                        <div
                            class="bg-white bg-opacity-20 rounded-full w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center text-xs sm:text-sm font-bold">
                            1
                        </div>
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-goldspel/80 to-bangala/80 dark:from-goldspel/90 dark:to-bangala/90 blur-md opacity-30 z-0">
                    </div>
                </div>

                <!-- Peringkat 2 dan 3 -->
                <div class="space-y-2 sm:space-y-3">
                    <!-- Peringkat 2 -->
                    <div
                        class="flex items-center justify-between p-3 sm:p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                        <div class="flex items-center space-x-3 sm:space-x-4">
                            <div
                                class="w-8 h-8 sm:w-10 sm:h-10 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center shrink-0">
                                <span class="text-xs sm:text-sm font-medium">2</span>
                            </div>
                            <div class="min-w-0">
                                <p class="font-medium text-sm sm:text-base text-gray-800 dark:text-gray-100 truncate">
                                    Ahmad Fauzi, S.Pd</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">Bahasa Indonesia
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm sm:text-base font-medium text-goldspel dark:text-yellow-400">92.8</span>
                        </div>
                    </div>

                    <!-- Peringkat 3 -->
                    <div
                        class="flex items-center justify-between p-3 sm:p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                        <div class="flex items-center space-x-3 sm:space-x-4">
                            <div
                                class="w-8 h-8 sm:w-10 sm:h-10 bg-amber-100 dark:bg-amber-900/50 rounded-full flex items-center justify-center shrink-0">
                                <span class="text-xs sm:text-sm font-medium">3</span>
                            </div>
                            <div class="min-w-0">
                                <p class="font-medium text-sm sm:text-base text-gray-800 dark:text-gray-100 truncate">
                                    Fatimah Azzahra, S.Pd</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">Guru IPA</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm sm:text-base font-medium text-goldspel dark:text-yellow-400">91.5</span>
                        </div>
                    </div>
                </div>

                <!-- Tombol Lihat Semua -->
                <button
                    class="w-full mt-2 py-2 px-4 text-xs sm:text-sm font-medium text-goldspel dark:text-yellow-400 hover:text-bangala dark:hover:text-yellow-300 rounded-lg border border-goldspel/30 dark:border-yellow-400/30 hover:border-bangala dark:hover:border-yellow-300 transition-all duration-200 flex items-center justify-center space-x-1">
                    <span>Lihat Semua Peringkat</span>
                    <i class="fas fa-chevron-right text-xs"></i>
                </button>
            </div>
        </div>

        <!-- Chart -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Perkembangan Nilai</h3>
                <select class="px-3 py-1 bg-gray-100 dark:bg-gray-700 rounded-lg text-sm">
                    <option>6 Bulan Terakhir</option>
                    <option>1 Tahun</option>
                </select>
            </div>
            <div class="h-64">
                <canvas id="performanceChart"></canvas>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // Chart.js Configuration
        const ctx = document.getElementById('performanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Rata-rata Nilai',
                    data: [82, 85, 83, 87, 89, 87.5],
                    borderColor: '#913013',
                    backgroundColor: 'rgba(145, 48, 19, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Target',
                    data: [85, 85, 85, 85, 85, 85],
                    borderColor: '#c19e5e',
                    backgroundColor: 'rgba(193, 158, 94, 0.1)',
                    borderDash: [5, 5],
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 75,
                        max: 95
                    }
                }
            }
        });
    </script>
@endpush
