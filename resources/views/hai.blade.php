<!DOCTYPE html>
<html lang="id" class="bg-white text-gray-900 dark:bg-gray-900 dark:text-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRAGU Dashboard - SD IT Abu Bakar</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="min-h-screen bg-gray-50 dark:bg-gray-900 font-sans">
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden sidebar-overlay"></div>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed left-0 top-0 h-full w-64 bg-white dark:bg-gray-800 shadow-xl transform -translate-x-full lg:translate-x-0 transition-all duration-300 z-50 border-r border-gray-100 dark:border-gray-700 flex flex-col">
        <div
            class="p-3 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-white/70 dark:from-gray-800/70 to-transparent">
            <div class="flex items-center space-x-4">
                <div class="w-14 h-14 rounded-xl overflow-hidden flex-shrink-0 shadow-lg">
                    <img src="{{ asset('img/logo-yayasan.png') }}" alt="Logo SIRAGU"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-200"
                        onerror="this.onerror=null; this.src='/path/fallback-logo.png'; this.alt='Logo tidak tersedia'">
                </div>
                <div>
                    <h2 class="text-xl font-bold text-bangala dark:text-goldspel tracking-tight">SIRAGU</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">SDIT Abu Bakar</p>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 p-4 space-y-2 overflow-y-auto custom-scrollbar">
            <a href="#"
                class="group relative flex items-center space-x-3 px-4 py-3 text-white rounded-xl bg-gradient-to-r from-bangala to-bangala/90 shadow-lg hover:shadow-bangala/30 transition-all duration-300">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-goldspel/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl">
                </div>
                <i class="fas fa-tachometer-alt w-5 text-goldspel group-hover:text-white transition-colors"></i>
                <span class="relative">Dashboard</span>
            </a>

            <a href="#"
                class="group relative flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel rounded-xl transition-all duration-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm">
                <i
                    class="fas fa-users w-5 group-hover:text-bangala dark:group-hover:text-goldspel transition-colors"></i>
                <span>Data Guru</span>
            </a>

            <a href="#"
                class="group relative flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel rounded-xl transition-all duration-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm">
                <i
                    class="fas fa-chart-bar w-5 group-hover:text-bangala dark:group-hover:text-goldspel transition-colors"></i>
                <span>Penilaian</span>
            </a>

            <a href="#"
                class="group relative flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel rounded-xl transition-all duration-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm">
                <i
                    class="fas fa-file-alt w-5 group-hover:text-bangala dark:group-hover:text-goldspel transition-colors"></i>
                <span>Rapor</span>
            </a>

            <a href="#"
                class="group relative flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel rounded-xl transition-all duration-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm">
                <i class="fas fa-cog w-5 group-hover:text-bangala dark:group-hover:text-goldspel transition-colors"></i>
                <span>Pengaturan</span>
            </a>
        </nav>
        <!-- User Profile Section -->
        <div
            class="p-4 border-t border-gray-200 dark:border-gray-700 bg-gradient-to-t from-white/50 dark:from-gray-800/50 to-transparent">
            <div
                class="flex justify-between items-center bg-white dark:bg-gray-700 rounded-xl p-3 shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100 dark:border-gray-600">

                <a href="/profile" class="flex items-center space-x-3 group hover:opacity-80 transition">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-bangala to-goldspel rounded-full flex items-center justify-center shadow-inner group-hover:rotate-6 transition-transform duration-300">
                        <i class="fas fa-user text-white text-sm group-hover:text-goldspel transition-colors"></i>
                    </div>
                    <div>
                        <p class="truncate font-medium text-sm text-gray-800 dark:text-gray-100 group-hover:text-bangala dark:group-hover:text-goldspel transition-colors"
                            style="max-width: 14ch;" title="Admin SIRAGU">
                            Admin SIRAGU
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">administrator</p>
                    </div>
                </a>

                <div class="h-10 w-px bg-gray-300 dark:bg-gray-600 mx-4"></div>

                <a href="/logout"
                    class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition">
                    <i class="fas fa-sign-out-alt text-base"></i>
                </a>

            </div>
        </div>
    </aside>

    <div class="lg:ml-64 min-h-screen">
        <!-- Header -->
        <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button id="sidebarToggle"
                        class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-bars text-gray-600 dark:text-gray-300"></i>
                    </button>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Sistem Informasi Rapor Guru</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 relative">
                            <i class="fas fa-bell text-gray-600 dark:text-gray-300"></i>
                            <span
                                class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                        </button>
                    </div>

                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-bangala rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <div class="hidden md:block">
                            <p class="font-medium text-sm">Admin SIRAGU</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Kepala Sekolah</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="p-6 space-y-6">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Guru</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">24</p>
                            <p class="text-sm text-green-600 dark:text-green-400">+2 bulan ini</p>
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
                        <div
                            class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-xl flex items-center justify-center">
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
                        <div
                            class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-xl flex items-center justify-center">
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
                        Guru Terbaik Bulan Ini
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
                                        <p
                                            class="font-medium text-sm sm:text-base text-gray-800 dark:text-gray-100 truncate">
                                            Ahmad Fauzi, S.Pd</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">Bahasa Indonesia
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <span
                                        class="text-sm sm:text-base font-medium text-goldspel dark:text-yellow-400">92.8</span>
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
                                        <p
                                            class="font-medium text-sm sm:text-base text-gray-800 dark:text-gray-100 truncate">
                                            Fatimah Azzahra, S.Pd</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">Guru IPA</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <span
                                        class="text-sm sm:text-base font-medium text-goldspel dark:text-yellow-400">91.5</span>
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

            <!-- Search & Filter -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 space-y-4 md:space-y-0">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Guru</h3>
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                        <div class="relative">
                            <i
                                class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" placeholder="Cari nama guru..."
                                class="pl-10 pr-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-bangala">
                        </div>
                        <select
                            class="px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                            <option>Semua Mata Pelajaran</option>
                            <option>Matematika</option>
                            <option>Bahasa Indonesia</option>
                            <option>IPA</option>
                            <option>IPS</option>
                        </select>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Nama
                                    Guru</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Mata
                                    Pelajaran</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Nilai
                                </th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Status
                                </th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="py-4 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-10 h-10 bg-bangala rounded-full flex items-center justify-center">
                                            <span class="text-white font-medium">SA</span>
                                        </div>
                                        <div>
                                            <p class="font-medium">Siti Aminah, S.Pd</p>
                                            <p class="text-sm text-gray-500">NIP: 123456789</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4">Matematika</td>
                                <td class="py-4 px-4">
                                    <span
                                        class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-sm font-medium">95.2</span>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-sm">Aktif</span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex space-x-2">
                                        <button
                                            class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                                            <i class="fas fa-eye text-sm"></i>
                                        </button>
                                        <button
                                            class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                                            <i class="fas fa-edit text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="py-4 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-10 h-10 bg-goldspel rounded-full flex items-center justify-center">
                                            <span class="text-white font-medium">AF</span>
                                        </div>
                                        <div>
                                            <p class="font-medium">Ahmad Fauzi, S.Pd</p>
                                            <p class="text-sm text-gray-500">NIP: 123456790</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4">Bahasa Indonesia</td>
                                <td class="py-4 px-4">
                                    <span
                                        class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-sm font-medium">92.8</span>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-sm">Aktif</span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex space-x-2">
                                        <button
                                            class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                                            <i class="fas fa-eye text-sm"></i>
                                        </button>
                                        <button
                                            class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                                            <i class="fas fa-edit text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="py-4 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center">
                                            <span class="text-white font-medium">F</span>
                                        </div>
                                        <div>
                                            <p class="font-medium">Fatimah, S.Pd</p>
                                            <p class="text-sm text-gray-500">NIP: 123456791</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4">IPA</td>
                                <td class="py-4 px-4">
                                    <span
                                        class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-sm font-medium">91.5</span>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="px-3 py-1 bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded-full text-sm">Cuti</span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex space-x-2">
                                        <button
                                            class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                                            <i class="fas fa-eye text-sm"></i>
                                        </button>
                                        <button
                                            class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                                            <i class="fas fa-edit text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="py-4 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                            <span class="text-white font-medium">RH</span>
                                        </div>
                                        <div>
                                            <p class="font-medium">Rahmat Hidayat, S.Pd</p>
                                            <p class="text-sm text-gray-500">NIP: 123456792</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4">IPS</td>
                                <td class="py-4 px-4">
                                    <span
                                        class="px-3 py-1 bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded-full text-sm font-medium">88.3</span>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-sm">Aktif</span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex space-x-2">
                                        <button
                                            class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                                            <i class="fas fa-eye text-sm"></i>
                                        </button>
                                        <button
                                            class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                                            <i class="fas fa-edit text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between mt-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Menampilkan 1-4 dari 24 guru</p>
                    <div class="flex space-x-2">
                        <button
                            class="px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-2 bg-bangala text-white rounded-lg">1</button>
                        <button
                            class="px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600">2</button>
                        <button
                            class="px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600">3</button>
                        <button
                            class="px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Sidebar Toggle Functionality
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);

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

        // Responsive handling
        function handleResize() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize(); // Call on load
    </script>
</body>

</html>
