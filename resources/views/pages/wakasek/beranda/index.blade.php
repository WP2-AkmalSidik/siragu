<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
    <title>SIRAGU - Dashboard Wakasek</title>
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
                <div class="w-8 h-8 rounded-full bg-bangala/10 flex items-center justify-center text-bangala font-medium text-sm">
                    WK
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-4">
        <!-- Wakasek Profile Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl font-semibold">Halo, Dr. Ahmad Wakil</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Wakasek Kurikulum | SMPIT Abu Bakar</p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold text-bangala">15/21</div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Guru Dinilai</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Guru</p>
                        <p class="text-2xl font-bold text-bangala">21</p>
                    </div>
                    <div class="w-10 h-10 bg-bangala/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-bangala"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Sudah Dinilai</p>
                        <p class="text-2xl font-bold text-green-600">15</p>
                    </div>
                    <div class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Menunggu</p>
                        <p class="text-2xl font-bold text-orange-600">6</p>
                    </div>
                    <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-clock text-orange-600"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Rata-rata</p>
                        <p class="text-2xl font-bold text-goldspel">87.5</p>
                    </div>
                    <div class="w-10 h-10 bg-goldspel/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-chart-line text-goldspel"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-4">Menu Penilaian</h2>
            <div class="grid grid-cols-2 gap-4">
                <a href="#" onclick="openForm('prestasi1')" 
                   class="dashboard-card bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-100 dark:border-gray-700 hover:border-amber-500 transition-all group">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/20 rounded-full flex items-center justify-center text-amber-600 dark:text-amber-400 group-hover:scale-110 transition-transform">
                            <i class="fas fa-trophy text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold">Prestasi 1</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Administrasi Pembelajaran</p>
                        </div>
                    </div>
                </a>

                <a href="#" onclick="openForm('prestasi2')" 
                   class="dashboard-card bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-100 dark:border-gray-700 hover:border-orange-500 transition-all group">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/20 rounded-full flex items-center justify-center text-orange-600 dark:text-orange-400 group-hover:scale-110 transition-transform">
                            <i class="fas fa-medal text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold">Prestasi 2</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Tugas Tambahan</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Assessments -->
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700">
            <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                <h2 class="text-lg font-semibold">Penilaian Terbaru</h2>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                <div class="p-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <p class="font-medium">Siti Nurhaliza, S.Pd</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Matematika • Prestasi 1</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                            Selesai
                        </span>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Nilai: 92</p>
                    </div>
                </div>

                <div class="p-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div>
                            <p class="font-medium">Ahmad Fauzi, S.S</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Bahasa Indonesia • Prestasi 2</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900/20 dark:text-orange-400">
                            Proses
                        </span>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">-</p>
                    </div>
                </div>

                <div class="p-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <div>
                            <p class="font-medium">Fatimah Az-Zahra, M.Pd</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">IPA • Prestasi 1</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                            Selesai
                        </span>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Nilai: 88</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bottom Navigation -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 py-2">
        <div class="flex justify-around max-w-2xl mx-auto">
            <a href="/wakasek" class="flex flex-col items-center text-bangala">
                <i class="fas fa-home"></i>
                <span class="text-xs mt-1">Beranda</span>
            </a>
            <a href="#" class="flex flex-col items-center text-gray-400 hover:text-bangala">
                <i class="fas fa-chart-bar"></i>
                <span class="text-xs mt-1">Laporan</span>
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
        function openForm(type) {
            if (type === 'prestasi1') {
                window.location.href = '/wakasek-p1';
            } else if (type === 'prestasi2') {
                window.location.href = '/wakasek-p2';
            }
        }
    </script>
</body>

</html>