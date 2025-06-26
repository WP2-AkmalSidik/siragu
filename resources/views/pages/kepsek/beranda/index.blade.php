<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
    <title>SIRAGU - Dashboard Kepala Sekolah</title>
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
            .mobile-space-y-2 > * + * {
                margin-top: 0.5rem !important;
            }
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
                <div class="w-8 h-8 rounded-full bg-bangala/10 flex items-center justify-center text-bangala font-medium text-sm">
                    KS
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-4">
        <!-- Kepsek Profile Header -->
        <div class="flex items-center justify-between mb-6 mobile-stack mobile-space-y-2">
            <div class="mobile-full-width mobile-text-center sm:text-left">
                <h1 class="text-xl font-semibold">Selamat Datang, Drs. H. Suryadi, M.Pd</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Kepala Sekolah | SMPIT Abu Bakar</p>
            </div>
            <div class="text-right mobile-full-width mobile-text-center sm:text-right">
                <div class="text-2xl font-bold text-bangala">18/21</div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Guru Dinilai</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Guru</p>
                        <p class="text-2xl font-bold text-bangala">21</p>
                    </div>
                    <div class="w-10 h-10 bg-bangala/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-chalkboard-teacher text-bangala"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Sudah Dinilai</p>
                        <p class="text-2xl font-bold text-green-600">18</p>
                    </div>
                    <div class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Belum Dinilai</p>
                        <p class="text-2xl font-bold text-red-600">3</p>
                    </div>
                    <div class="w-10 h-10 bg-red-100 dark:bg-red-900/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Rata-rata</p>
                        <p class="text-2xl font-bold text-goldspel">91.2</p>
                    </div>
                    <div class="w-10 h-10 bg-goldspel/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-star text-goldspel"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-4">Penilaian Guru</h2>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 sm:p-6 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4 mobile-flex-col mobile-space-y-4">
                    <div class="flex items-center space-x-3 mobile-full-width">
                        <div class="w-10 sm:w-12 h-10 sm:h-12 bg-bangala/10 rounded-full flex items-center justify-center text-bangala">
                            <i class="fas fa-clipboard-list text-lg sm:text-xl"></i>
                        </div>
                        <div class="mobile-full-width">
                            <h3 class="font-semibold text-sm sm:text-base">Form Penilaian Kinerja Guru</h3>
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Tanggung Jawab, Ketaatan, Kerjasama, dan Prakarsa</p>
                        </div>
                    </div>
                    <button onclick="openAssessmentForm()" 
                            class="mt-2 bg-bangala hover:bg-bangala/90 text-white px-4 sm:px-6 py-2 rounded-lg font-medium transition-all duration-200 flex items-center justify-center space-x-2 hover:shadow-lg mobile-full-width">
                        <i class="fas fa-plus"></i>
                        <span class="text-sm sm:text-base">Buat Penilaian</span>
                    </button>
                </div>
                
                <!-- Progress Overview -->
                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 sm:p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs sm:text-sm font-medium">Progress Penilaian</span>
                        <span class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">18/21 Selesai</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                        <div class="bg-bangala h-2 rounded-full transition-all duration-700" style="width: 85.7%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Assessments -->
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700">
            <div class="p-3 sm:p-4 border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between mobile-flex-col mobile-space-y-2 mobile-items-start">
                    <h2 class="text-lg font-semibold">Penilaian Terbaru</h2>
                </div>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                <!-- Assessment 1 -->
                <div class="p-3 sm:p-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors mobile-flex-col mobile-space-y-3 mobile-items-start">
                    <div class="flex items-center space-x-3 mobile-full-width">
                        <div class="w-8 sm:w-10 h-8 sm:h-10 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-tie text-sm sm:text-base text-green-600 dark:text-green-400"></i>
                        </div>
                        <div class="mobile-full-width">
                            <p class="font-medium text-sm sm:text-base">Dr. Andi Setiawan, M.Pd</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Fisika • Penilaian Kinerja</p>
                        </div>
                    </div>
                    <div class="text-right mobile-full-width mobile-text-left sm:text-right">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                            Selesai
                        </span>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Nilai: 95</p>
                    </div>
                </div>

                <!-- Assessment 2 -->
                <div class="p-3 sm:p-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors mobile-flex-col mobile-space-y-3 mobile-items-start">
                    <div class="flex items-center space-x-3 mobile-full-width">
                        <div class="w-8 sm:w-10 h-8 sm:h-10 bg-blue-100 dark:bg-blue-900/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-tie text-sm sm:text-base text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div class="mobile-full-width">
                            <p class="font-medium text-sm sm:text-base">Sari Wulandari, S.Pd</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Bahasa Inggris • Penilaian Kinerja</p>
                        </div>
                    </div>
                    <div class="text-right mobile-full-width mobile-text-left sm:text-right">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                            Selesai
                        </span>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Nilai: 89</p>
                    </div>
                </div>

                <!-- Assessment 3 -->
                <div class="p-3 sm:p-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors mobile-flex-col mobile-space-y-3 mobile-items-start">
                    <div class="flex items-center space-x-3 mobile-full-width">
                        <div class="w-8 sm:w-10 h-8 sm:h-10 bg-orange-100 dark:bg-orange-900/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-tie text-sm sm:text-base text-orange-600 dark:text-orange-400"></i>
                        </div>
                        <div class="mobile-full-width">
                            <p class="font-medium text-sm sm:text-base">Muhammad Rizki, S.Kom</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">TIK • Penilaian Kinerja</p>
                        </div>
                    </div>
                    <div class="text-right mobile-full-width mobile-text-left sm:text-right">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900/20 dark:text-orange-400">
                            Draft
                        </span>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">-</p>
                    </div>
                </div>

                <!-- Assessment 4 -->
                <div class="p-3 sm:p-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors mobile-flex-col mobile-space-y-3 mobile-items-start">
                    <div class="flex items-center space-x-3 mobile-full-width">
                        <div class="w-8 sm:w-10 h-8 sm:h-10 bg-purple-100 dark:bg-purple-900/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-tie text-sm sm:text-base text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <div class="mobile-full-width">
                            <p class="font-medium text-sm sm:text-base">Nurul Hidayah, S.Ag</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PAI • Penilaian Kinerja</p>
                        </div>
                    </div>
                    <div class="text-right mobile-full-width mobile-text-left sm:text-right">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                            Selesai
                        </span>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Nilai: 92</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bottom Navigation -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 py-2">
        <div class="flex justify-around max-w-2xl mx-auto">
            <a href="/kepsek" class="flex flex-col items-center text-bangala">
                <i class="fas fa-home text-sm sm:text-base"></i>
                <span class="text-xs mt-1">Beranda</span>
            </a>
            <a href="/statistik" class="flex flex-col items-center text-gray-400 hover:text-bangala">
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
        function openAssessmentForm() {
            // Redirect to assessment form
            window.location.href = '/kepsek-pengisian';
        }
    </script>
</body>

</html>