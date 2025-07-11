<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>SIRAGU - Statistik Penilaian Guru</title>
    <style>
        @media (max-width: 640px) {
            .mobile-stack {
                flex-direction: column !important;
                align-items: flex-start !important;
            }

            .mobile-text-center {
                text-align: center !important;
            }

            .mobile-full-width {
                width: 100% !important;
            }

            .mobile-mt-2 {
                margin-top: 0.5rem !important;
            }

            .mobile-p-3 {
                padding: 0.75rem !important;
            }

            .mobile-flex-col {
                flex-direction: column !important;
            }

            .mobile-space-y-2>*+* {
                margin-top: 0.5rem !important;
            }

            .mobile-items-start {
                align-items: flex-start !important;
            }

            .mobile-text-left {
                text-align: left !important;
            }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        @media (max-width: 640px) {
            .chart-container {
                height: 250px;
            }
        }

        .rank-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }

        .rank-1 {
            background-color: #FFD700;
        }

        .rank-2 {
            background-color: #C0C0C0;
        }

        .rank-3 {
            background-color: #CD7F32;
        }

        .progress-ring {
            transform: rotate(-90deg);
        }

        .progress-ring-circle {
            transition: stroke-dasharray 0.35s;
            transform-origin: 50% 50%;
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen pb-16 font-sans">

    <!-- App Header -->
    <header class="bg-white dark:bg-gray-800 shadow-sm py-3 px-4 border-b border-gray-100 dark:border-gray-700">
        <div class="flex justify-between items-center max-w-6xl mx-auto">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-bangala rounded-md flex items-center justify-center text-white font-bold">S</div>
                <h1 class="font-semibold text-lg">SIRAGU</h1>
            </div>
            <div class="flex items-center space-x-3">
                <button class="text-gray-500 hover:text-bangala">
                    <i class="far fa-bell"></i>
                </button>
                <div
                    class="w-8 h-8 rounded-full bg-bangala/10 flex items-center justify-center text-bangala font-medium text-sm">
                    KS
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-4">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-6 mobile-stack mobile-space-y-2">
            <div class="mobile-full-width mobile-text-center sm:text-left">
                <h1 class="text-xl font-semibold">Statistik Penilaian Guru</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Analisis Kinerja Guru SMP • Semester Ganjil
                    2024/2025</p>
            </div>
            <div class="flex gap-4 justify-end mb-4">
                <div class="relative">
                    <select id="tahun_ajaran"
                        class="w-48 pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-lg focus:ring-2 focus:ring-bangala focus:bg-white dark:focus:bg-gray-600 transition-all duration-200 text-sm">
                        @foreach (tahunAjaranTerakhir() as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                    {{-- <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i> --}}
                </div>

                <div class="relative">
                    <select id="semester"
                        class="w-40 pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-lg focus:ring-2 focus:ring-bangala focus:bg-white dark:focus:bg-gray-600 transition-all duration-200 text-sm">
                        <option value="ganjil" @if (semesterSekarang() == 'ganjil') selected @endif>Ganjil</option>
                        <option value="genap" @if (semesterSekarang() == 'genap') selected @endif>Genap</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Rata-rata Keseluruhan</p>
                        <p class="text-2xl font-bold text-bangala">89.3</p>
                        <p class="text-xs text-green-600 dark:text-green-400 flex items-center mt-1">
                            <i class="fas fa-arrow-up mr-1"></i> +2.1 dari semester lalu
                        </p>
                    </div>
                    <div class="w-10 h-10 bg-bangala/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-chart-line text-bangala"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nilai Tertinggi</p>
                        <p class="text-2xl font-bold text-green-600">96.5</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Dr. Andi Setiawan</p>
                    </div>
                    <div
                        class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-trophy text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nilai Terendah</p>
                        <p class="text-2xl font-bold text-red-600">76.2</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Perlu Pembinaan</p>
                    </div>
                    <div class="w-10 h-10 bg-red-100 dark:bg-red-900/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Guru Berprestasi</p>
                        <p class="text-2xl font-bold text-goldspel">15</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">≥85 (71% dari total)</p>
                    </div>
                    <div class="w-10 h-10 bg-goldspel/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-star text-goldspel"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700 mb-6">
            <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                <h2 class="text-lg font-semibold">Trend Penilaian Per Semester</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Pergerakan rata-rata nilai kinerja guru</p>
            </div>
            <div class="p-4">
                <div class="chart-container">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Top and Bottom Performers -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Top 3 Performers -->
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700">
                <div
                    class="p-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/10 dark:to-emerald-900/10">
                    <h3 class="text-lg font-semibold text-green-800 dark:text-green-300 flex items-center">
                        <i class="fas fa-trophy mr-2"></i>
                        Top 3 Guru Terbaik
                    </h3>
                    <p class="text-sm text-green-600 dark:text-green-400">Berdasarkan nilai kinerja semester ini</p>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    <!-- Rank 1 -->
                    <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors relative">
                        <div class="rank-badge rank-1">1</div>
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center relative">
                                <i class="fas fa-user-tie text-green-600 dark:text-green-400"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold">Dr. Andi Setiawan, M.Pd</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Fisika • 12 Tahun Pengalaman</p>
                                <div class="flex items-center mt-1">
                                    <div class="flex text-yellow-400 text-sm">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Sangat Baik</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-green-600">96.5</div>
                                <div class="text-xs text-green-600 flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i> +3.2
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rank 2 -->
                    <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors relative">
                        <div class="rank-badge rank-2">2</div>
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-tie text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold">Siti Nurhaliza, S.Pd</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Matematika • 8 Tahun Pengalaman</p>
                                <div class="flex items-center mt-1">
                                    <div class="flex text-yellow-400 text-sm">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Sangat Baik</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-blue-600">94.8</div>
                                <div class="text-xs text-blue-600 flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i> +1.5
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rank 3 -->
                    <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors relative">
                        <div class="rank-badge rank-3">3</div>
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-12 h-12 bg-purple-100 dark:bg-purple-900/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-tie text-purple-600 dark:text-purple-400"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold">Ahmad Fauzi, S.Pd</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Bahasa Indonesia • 10 Tahun
                                    Pengalaman</p>
                                <div class="flex items-center mt-1">
                                    <div class="flex text-yellow-400 text-sm">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Baik</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-purple-600">93.2</div>
                                <div class="text-xs text-purple-600 flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i> +0.8
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <!-- Bottom Navigation -->
    <nav
        class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 py-2">
        <div class="flex justify-around max-w-2xl mx-auto">
            <a href="#" class="flex flex-col items-center text-gray-400 hover:text-bangala">
                <i class="fas fa-home text-sm sm:text-base"></i>
                <span class="text-xs mt-1">Beranda</span>
            </a>
            <a href="/statistik" class="flex flex-col items-center text-bangala">
                <i class="fas fa-chart-line text-sm sm:text-base"></i>
                <span class="text-xs mt-1">Analisis</span>
            </a>
            <a href="/list-guru" class="flex flex-col items-center text-gray-400 hover:text-bangala">
                <i class="fas fa-users text-sm sm:text-base"></i>
                <span class="text-xs mt-1">Guru</span>
            </a>
            <a href="/profile" class="flex flex-col items-center text-gray-400 hover:text-bangala">
                <i class="fas fa-user"></i>
                <span class="text-xs mt-1">Profil</span>
            </a>
        </div>
    </nav>

    <script>
        // Chart configuration
        const ctx = document.getElementById('trendChart').getContext('2d');

        const trendChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sem Ganjil 22/23', 'Sem Genap 22/23', 'Sem Ganjil 23/24', 'Sem Genap 23/24',
                    'Sem Ganjil 24/25'
                ],
                datasets: [{
                    label: 'Rata-rata Nilai',
                    data: [85.2, 86.8, 87.5, 87.2, 89.3],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ef4444',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#667eea',
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y.toFixed(1);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6b7280',
                            font: {
                                size: 11
                            }
                        }
                    },
                    y: {
                        beginAtZero: false,
                        min: 70,
                        max: 100,
                        grid: {
                            color: 'rgba(107, 114, 128, 0.1)'
                        },
                        ticks: {
                            color: '#6b7280',
                            font: {
                                size: 11
                            },
                            callback: function(value) {
                                return value.toFixed(0);
                            }
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                },
                elements: {
                    point: {
                        hoverBackgroundColor: '#fff'
                    }
                }
            }
        });

        // Semester selector functionality
        document.getElementById('semesterSelect').addEventListener('change', function(e) {
            const selectedSemester = e.target.value;
            // Here you would typically fetch new data based on the selected semester
            console.log('Selected semester:', selectedSemester);

            // Simulate data update (in real implementation, this would be an API call)
            updateChartData(selectedSemester);
        });

        function updateChartData(semester) {
            // Sample data for different semesters
            const semesterData = {
                '2024-1': {
                    average: [85.2, 86.8, 87.5, 87.2, 89.3],
                    highest: [92.5, 93.2, 94.1, 95.0, 96.5],
                    lowest: [78.1, 79.5, 78.9, 78.3, 76.2]
                },
                '2023-2': {
                    average: [84.1, 85.5, 86.2, 87.2, 88.1],
                    highest: [91.2, 92.1, 93.5, 95.0, 94.8],
                    lowest: [77.8, 78.9, 79.1, 78.3, 77.5]
                },
                '2023-1': {
                    average: [83.5, 84.8, 85.9, 86.5, 87.5],
                    highest: [90.8, 91.5, 92.8, 94.1, 93.2],
                    lowest: [76.9, 77.8, 78.5, 78.9, 79.1]
                },
                '2022-2': {
                    average: [82.8, 83.9, 85.1, 85.9, 86.8],
                    highest: [89.5, 90.2, 91.8, 92.8, 92.1],
                    lowest: [75.2, 76.8, 77.5, 78.5, 78.9]
                }
            };

            const data = semesterData[semester] || semesterData['2024-1'];

            trendChart.data.datasets[0].data = data.average;
            trendChart.data.datasets[1].data = data.highest;
            trendChart.data.datasets[2].data = data.lowest;
            trendChart.update('active');
        }

        // Initialize chart animation
        setTimeout(() => {
            trendChart.update('active');
        }, 500);

        // Responsive chart handling
        window.addEventListener('resize', function() {
            trendChart.resize();
        });

        // Add smooth hover effects for cards
        document.querySelectorAll('.hover\\:bg-gray-50').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.transition = 'all 0.2s ease';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Add click handlers for interactive elements
        document.querySelectorAll('[data-action]').forEach(element => {
            element.addEventListener('click', function() {
                const action = this.getAttribute('data-action');
                console.log('Action triggered:', action);
                // Handle different actions here
            });
        });
    </script>
</body>

</html>
