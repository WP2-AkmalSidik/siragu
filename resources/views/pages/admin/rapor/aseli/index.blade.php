@extends('layouts.admin')
@section('title', 'Penilaian Guru')
@section('description', 'Form Penilaian Kinerja Guru')
@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <!-- Header Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-xs border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between gap-4">
                <!-- Left Side - Title -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-bangala rounded-lg flex items-center justify-center text-white">
                        <i class="fas fa-chalkboard-teacher text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-semibold text-gray-800 dark:text-white">Penilaian Guru</h1>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Semester 1 • 2023/2024</p>
                    </div>
                </div>

                <!-- Right Side - Score -->
                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <div class="text-2xl font-bold text-bangala dark:text-goldspel" id="total-score">0</div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Total</p>
                    </div>
                    <div class="h-10 w-px bg-gray-200 dark:bg-gray-600"></div>
                    <div>
                        <span
                            class="text-xs font-medium px-2 py-1 rounded-full 
                    bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300"
                            id="performance-level">
                            Belum dinilai
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teacher Search & Info Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
            <!-- Compact Search Bar -->
            <div class="relative">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex-1 relative">
                        <input type="text" placeholder="Cari guru..." id="teacher-search"
                            class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-lg focus:ring-2 focus:ring-bangala focus:bg-white dark:focus:bg-gray-600 transition-all duration-200 text-sm">
                        <i
                            class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                    </div>
                    <div class="text-xs text-gray-400 dark:text-gray-500">
                        <span id="teacher-count">0</span> guru ditemukan
                    </div>
                </div>
            </div>

            <!-- Minimalist Teacher Info -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 transition-all duration-300" id="teacher-info">
                <div class="flex items-start gap-4">

                    <!-- Teacher Details -->
                    <div class="flex-1 min-w-0">
                        <div class="mt-1.5 grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
                            <div class="truncate">
                                <span class="text-gray-500 dark:text-gray-400">Nama :</span>
                                <span class="font-medium text-gray-700 dark:text-gray-300 ml-1 truncate"
                                    id="teacher-name">-</span>
                            </div>
                            <div class="truncate">
                                <span class="text-gray-500 dark:text-gray-400">NIP :</span>
                                <span class="font-medium text-gray-700 dark:text-gray-300 ml-1 truncate"
                                    id="teacher-nip">-</span>
                            </div>
                            <div class="truncate">
                                <span class="text-gray-500 dark:text-gray-400">Mapel :</span>
                                <span class="font-medium text-gray-700 dark:text-gray-300 ml-1 truncate"
                                    id="teacher-subject">-</span>
                            </div>
                            <div class="truncate">
                                <span class="text-gray-500 dark:text-gray-400">Jabatan :</span>
                                <span class="font-medium text-gray-700 dark:text-gray-300 ml-1 truncate"
                                    id="teacher-position">-</span>
                            </div>
                            <div class="truncate">
                                <span class="text-gray-500 dark:text-gray-400">Tugas :</span>
                                <span class="font-medium text-gray-700 dark:text-gray-300 ml-1 truncate"
                                    id="teacher-role">-</span>
                            </div>
                            <div class="truncate">
                                <span class="text-gray-500 dark:text-gray-400">Status : </span>
                                <span
                                    class="px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 rounded-full text-xs">Aktif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rating Guide -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Panduan Penilaian</h4>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div class="flex items-center space-x-3 p-4 bg-red-50 dark:bg-red-900/20 rounded-xl">
                    <div
                        class="w-10 h-10 bg-red-500 text-white rounded-lg flex items-center justify-center text-sm font-bold">
                        ≤50</div>
                    <div>
                        <div class="font-semibold text-red-700 dark:text-red-400">Kurang Sekali</div>
                        <div class="text-xs text-red-600 dark:text-red-500">Perlu peningkatan</div>
                    </div>
                </div>
                <div class="flex items-center space-x-3 p-4 bg-orange-50 dark:bg-orange-900/20 rounded-xl">
                    <div
                        class="w-10 h-10 bg-orange-500 text-white rounded-lg flex items-center justify-center text-sm font-bold">
                        51-68</div>
                    <div>
                        <div class="font-semibold text-orange-700 dark:text-orange-400">Kurang</div>
                        <div class="text-xs text-orange-600 dark:text-orange-500">Sudah memadai</div>
                    </div>
                </div>
                <div class="flex items-center space-x-3 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl">
                    <div
                        class="w-10 h-10 bg-yellow-500 text-white rounded-lg flex items-center justify-center text-sm font-bold">
                        69-78</div>
                    <div>
                        <div class="font-semibold text-yellow-700 dark:text-yellow-400">Cukup</div>
                        <div class="text-xs text-yellow-600 dark:text-yellow-500">Sudah memadai</div>
                    </div>
                </div>
                <div class="flex items-center space-x-3 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                    <div
                        class="w-10 h-10 bg-blue-500 text-white rounded-lg flex items-center justify-center text-sm font-bold">
                        79-88</div>
                    <div>
                        <div class="font-semibold text-blue-700 dark:text-blue-400">Baik</div>
                        <div class="text-xs text-blue-600 dark:text-blue-500">Di atas rata-rata</div>
                    </div>
                </div>
                <div class="flex items-center space-x-3 p-4 bg-green-50 dark:bg-green-900/20 rounded-xl">
                    <div
                        class="w-10 h-10 bg-green-500 text-white rounded-lg flex items-center justify-center text-sm font-bold">
                        ≥89</div>
                    <div>
                        <div class="font-semibold text-green-700 dark:text-green-400">Sangat Baik</div>
                        <div class="text-xs text-green-600 dark:text-green-500">Luar biasa</div>
                    </div>
                </div>
            </div>
        </div>

        <form id="teacher-evaluation-form" class="space-y-6">
            <!-- Row 1: Kedisiplinan, Loyalitas, Supervisi Adm -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kedisiplinan -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl flex items-center justify-center">
                            <i class="fas fa-clock text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Kedisiplinan</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Ketepatan waktu & kepatuhan</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="relative">
                            <input type="number" min="0" max="100" placeholder="0" name="kedisiplinan"
                                id="kedisiplinan"
                                class="w-full px-4 py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-center text-2xl font-bold transition-all duration-200">
                            <span
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 font-medium">/100</span>
                        </div>

                        <div class="text-center">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-full h-2 transition-all duration-300"
                                    id="kedisiplinan-bar" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Loyalitas -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl flex items-center justify-center">
                            <i class="fas fa-heart text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Loyalitas</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Komitmen & dedikasi</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="relative">
                            <input type="number" min="0" max="100" placeholder="0" name="loyalitas"
                                id="loyalitas"
                                class="w-full px-4 py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-center text-2xl font-bold transition-all duration-200">
                            <span
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 font-medium">/100</span>
                        </div>

                        <div class="text-center">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-full h-2 transition-all duration-300"
                                    id="loyalitas-bar" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Row 2: Supervisi Adm & Supervisi Kelas -->
            <div class="grid grid-cols-2 gap-6">
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-xl flex items-center justify-center">
                            <i class="fas fa-file-alt text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Supervisi Adm</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Administrasi pendidik</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="relative">
                            <input type="number" min="0" max="100" placeholder="0" name="supervisi_adm"
                                id="supervisi_adm"
                                class="w-full px-4 py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-center text-2xl font-bold transition-all duration-200">
                            <span
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 font-medium">/100</span>
                        </div>

                        <div class="text-center">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-full h-2 transition-all duration-300"
                                    id="supervisi_adm-bar" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 text-white rounded-xl flex items-center justify-center">
                            <i class="fas fa-chalkboard-teacher text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Supervisi Kelas</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Pengawasan pembelajaran</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="relative max-w-md">
                            <input type="number" min="0" max="100" placeholder="0" name="supervisi_kelas"
                                id="supervisi_kelas"
                                class="w-full px-4 py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-center text-2xl font-bold transition-all duration-200">
                            <span
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 font-medium">/100</span>
                        </div>

                        <div class="text-center max-w-md">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full h-2 transition-all duration-300"
                                    id="supervisi_kelas-bar" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Prestasi Kerja Tugas Tambahan -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Prestasi Kerja Tugas Tambahan</h3>

                <!-- Checkbox Options -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <label
                        class="flex items-center space-x-3 p-4 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer transition-all duration-200">
                        <input type="checkbox" value="wali_kelas"
                            class="tugas-tambahan-checkbox w-5 h-5 text-bangala bg-gray-100 border-gray-300 rounded focus:ring-bangala dark:focus:ring-bangala dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="text-gray-900 dark:text-white font-medium">Wali Kelas/Pendamping</span>
                    </label>

                    <label
                        class="flex items-center space-x-3 p-4 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer transition-all duration-200">
                        <input type="checkbox" value="pembina_ekskul"
                            class="tugas-tambahan-checkbox w-5 h-5 text-bangala bg-gray-100 border-gray-300 rounded focus:ring-bangala dark:focus:ring-bangala dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="text-gray-900 dark:text-white font-medium">Pembina Ekstrakurikuler</span>
                    </label>

                    <label
                        class="flex items-center space-x-3 p-4 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer transition-all duration-200">
                        <input type="checkbox" value="wakasek"
                            class="tugas-tambahan-checkbox w-5 h-5 text-bangala bg-gray-100 border-gray-300 rounded focus:ring-bangala dark:focus:ring-bangala dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="text-gray-900 dark:text-white font-medium">Wakasek/Koordinator</span>
                    </label>

                    <label
                        class="flex items-center space-x-3 p-4 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer transition-all duration-200">
                        <input type="checkbox" value="guru_thq"
                            class="tugas-tambahan-checkbox w-5 h-5 text-bangala bg-gray-100 border-gray-300 rounded focus:ring-bangala dark:focus:ring-bangala dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="text-gray-900 dark:text-white font-medium">Guru THQ</span>
                    </label>
                </div>

                <!-- Dynamic Input Forms -->
                <div id="tugas-tambahan-forms" class="space-y-4">
                    <!-- Forms will be dynamically added here -->
                </div>
            </div>

            <!-- Row 3: Tanggungjawab, Ketaatan, Kerjasama -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Tanggungjawab -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 text-white rounded-xl flex items-center justify-center">
                            <i class="fas fa-shield-alt text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tanggungjawab</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Konsistensi & keandalan</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="relative">
                            <input type="number" min="0" max="100" placeholder="0" name="tanggungjawab"
                                id="tanggungjawab"
                                class="w-full px-4 py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-center text-2xl font-bold transition-all duration-200">
                            <span
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 font-medium">/100</span>
                        </div>

                        <div class="text-center">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-full h-2 transition-all duration-300"
                                    id="tanggungjawab-bar" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ketaatan -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-600 text-white rounded-xl flex items-center justify-center">
                            <i class="fas fa-hand-holding-heart text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Ketaatan</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Kepatuhan & penghormatan</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="relative">
                            <input type="number" min="0" max="100" placeholder="0" name="ketaatan"
                                id="ketaatan"
                                class="w-full px-4 py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent text-center text-2xl font-bold transition-all duration-200">
                            <span
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 font-medium">/100</span>
                        </div>

                        <div class="text-center">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-teal-500 to-teal-600 rounded-full h-2 transition-all duration-300"
                                    id="ketaatan-bar" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kerjasama -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-xl flex items-center justify-center">
                            <i class="fas fa-users text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Kerjasama</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Kolaborasi & komunikasi</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="relative">
                            <input type="number" min="0" max="100" placeholder="0" name="kerjasama"
                                id="kerjasama"
                                class="w-full px-4 py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent text-center text-2xl font-bold transition-all duration-200">
                            <span
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 font-medium">/100</span>
                        </div>

                        <div class="text-center">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-full h-2 transition-all duration-300"
                                    id="kerjasama-bar" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 4: Prakarsa, Kesalehan, Tahsin Dan Tahfidz -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Prakarsa -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-pink-500 to-pink-600 text-white rounded-xl flex items-center justify-center">
                            <i class="fas fa-lightbulb text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Prakarsa</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Inisiatif & kreativitas</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="relative">
                            <input type="number" min="0" max="100" placeholder="0" name="prakarsa"
                                id="prakarsa"
                                class="w-full px-4 py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent text-center text-2xl font-bold transition-all duration-200">
                            <span
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 font-medium">/100</span>
                        </div>

                        <div class="text-center">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-pink-500 to-pink-600 rounded-full h-2 transition-all duration-300"
                                    id="prakarsa-bar" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kesalehan -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-cyan-600 text-white rounded-xl flex items-center justify-center">
                            <i class="fas fa-pray text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Kesalehan</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Akhlak & spiritualitas</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="relative">
                            <input type="number" min="0" max="100" placeholder="0" name="kesalehan"
                                id="kesalehan"
                                class="w-full px-4 py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent text-center text-2xl font-bold transition-all duration-200">
                            <span
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 font-medium">/100</span>
                        </div>

                        <div class="text-center">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 rounded-full h-2 transition-all duration-300"
                                    id="kesalehan-bar" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tahsin Dan Tahfidz -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-xl flex items-center justify-center">
                            <i class="fas fa-quran text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tahsin & Tahfidz</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Kemampuan Al-Quran</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="relative">
                            <input type="number" min="0" max="100" placeholder="0" name="tahsin_tahfidz"
                                id="tahsin_tahfidz"
                                class="w-full px-4 py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-center text-2xl font-bold transition-all duration-200">
                            <span
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 font-medium">/100</span>
                        </div>

                        <div class="text-center">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full h-2 transition-all duration-300"
                                    id="tahsin_tahfidz-bar" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes and Submit -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Catatan Evaluasi</label>
                <textarea rows="4" placeholder="Masukkan catatan, saran, atau rekomendasi untuk guru..."
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent resize-none transition-all duration-200"></textarea>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="px-8 py-3 bg-gradient-to-r from-bangala to-goldspel text-white rounded-xl hover:shadow-lg transform hover:scale-105 transition-all duration-200 font-semibold flex items-center space-x-2">
                        <i class="fas fa-save"></i>
                        <span>Simpan Penilaian</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[type="number"]');
            const tugasTambahanCheckboxes = document.querySelectorAll('.tugas-tambahan-checkbox');
            const tugasTambahanFormsContainer = document.getElementById('tugas-tambahan-forms');

            const categories = [
                'kedisiplinan',
                'loyalitas',
                'supervisi_adm',
                'supervisi_kelas',
                'tanggungjawab',
                'ketaatan',
                'kerjasama',
                'prakarsa',
                'kesalehan',
                'tahsin_tahfidz'
            ];

            const tugasTambahanLabels = {
                'wali_kelas': 'Wali Kelas/Pendamping',
                'pembina_ekskul': 'Pembina Ekstrakurikuler',
                'wakasek': 'Wakasek/Koordinator',
                'guru_thq': 'Guru THQ'
            };

            const tugasTambahanIcons = {
                'wali_kelas': 'fas fa-user-graduate',
                'pembina_ekskul': 'fas fa-futbol',
                'wakasek': 'fas fa-user-cog',
                'guru_thq': 'fas fa-book-quran'
            };

            const tugasTambahanColors = {
                'wali_kelas': 'from-violet-500 to-violet-600',
                'pembina_ekskul': 'from-rose-500 to-rose-600',
                'wakasek': 'from-amber-500 to-amber-600',
                'guru_thq': 'from-lime-500 to-lime-600'
            };

            function updateTugasTambahanForms() {
                const selectedTugas = [];
                tugasTambahanCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        selectedTugas.push(checkbox.value);
                    }
                });

                // Clear existing forms
                tugasTambahanFormsContainer.innerHTML = '';

                // Create forms for selected tugas
                selectedTugas.forEach((tugas, index) => {
                    const formHtml = `
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600">
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br ${tugasTambahanColors[tugas]} text-white rounded-xl flex items-center justify-center">
                                    <i class="${tugasTambahanIcons[tugas]} text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">${tugasTambahanLabels[tugas]}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Nilai prestasi kerja</p>
                                </div>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="relative max-w-md">
                                    <input type="number" min="0" max="100" placeholder="0" 
                                           name="tugas_tambahan_${tugas}" 
                                           id="tugas_tambahan_${tugas}"
                                           class="tugas-tambahan-input w-full px-4 py-4 bg-white dark:bg-gray-600 border border-gray-200 dark:border-gray-500 rounded-xl focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent text-center text-2xl font-bold transition-all duration-200">
                                    <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 font-medium">/100</span>
                                </div>
                                
                                <div class="text-center max-w-md">
                                    <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-bangala to-goldspel rounded-full h-2 transition-all duration-300" 
                                             id="tugas_tambahan_${tugas}-bar" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    tugasTambahanFormsContainer.insertAdjacentHTML('beforeend', formHtml);
                });

                // Re-bind event listeners for new inputs
                bindTugasTambahanInputs();
            }

            function bindTugasTambahanInputs() {
                const tugasTambahanInputs = document.querySelectorAll('.tugas-tambahan-input');
                tugasTambahanInputs.forEach(input => {
                    input.addEventListener('input', updateScores);
                });
            }

            function updateScores() {
                let totalScore = 0;

                // Calculate scores for main categories
                categories.forEach(category => {
                    const input = document.getElementById(category);
                    const value = parseInt(input.value) || 0;
                    const percentage = (value / 100) * 100;

                    // Update progress bar
                    const bar = document.getElementById(category + '-bar');
                    if (bar) {
                        bar.style.width = percentage + '%';
                    }

                    totalScore += value;
                });

                // Calculate scores for tugas tambahan
                const tugasTambahanInputs = document.querySelectorAll('.tugas-tambahan-input');
                tugasTambahanInputs.forEach(input => {
                    const value = parseInt(input.value) || 0;
                    const percentage = (value / 100) * 100;

                    // Update progress bar for tugas tambahan
                    const barId = input.id + '-bar';
                    const bar = document.getElementById(barId);
                    if (bar) {
                        bar.style.width = percentage + '%';
                    }

                    totalScore += value;
                });

                // Update total displays
                document.getElementById('total-score').textContent = totalScore;

                // Update performance level
                let performanceLevel = 'Belum Dinilai';

                if (totalScore > 0) {
                    const totalFields = categories.length + tugasTambahanInputs.length;
                    const averageScore = totalFields > 0 ? totalScore / totalFields : 0;

                    if (averageScore >= 90) {
                        performanceLevel = 'Sangat Baik';
                    } else if (averageScore >= 70) {
                        performanceLevel = 'Baik';
                    } else if (averageScore >= 50) {
                        performanceLevel = 'Cukup';
                    } else {
                        performanceLevel = 'Perlu Perbaikan';
                    }
                }

                document.getElementById('performance-level').textContent = performanceLevel;
            }

            // Bind event listeners
            inputs.forEach(input => {
                input.addEventListener('input', updateScores);
            });

            tugasTambahanCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateTugasTambahanForms);
            });

            // Teacher search functionality placeholder
            const teacherSearch = document.getElementById('teacher-search');
            const teacherDropdown = document.getElementById('teacher-dropdown');

            teacherSearch.addEventListener('focus', function() {
                teacherDropdown.classList.remove('hidden');
            });

            teacherSearch.addEventListener('blur', function() {
                setTimeout(() => {
                    teacherDropdown.classList.add('hidden');
                }, 200);
            });

            // Form submission
            document.getElementById('teacher-evaluation-form').addEventListener('submit', function(e) {
                e.preventDefault();

                // Collect all form data
                const formData = new FormData();

                // Main categories
                categories.forEach(category => {
                    const input = document.getElementById(category);
                    formData.append(category, input.value || 0);
                });

                // Tugas tambahan
                const tugasTambahanInputs = document.querySelectorAll('.tugas-tambahan-input');
                tugasTambahanInputs.forEach(input => {
                    formData.append(input.name, input.value || 0);
                });

                // Notes
                const notes = document.querySelector('textarea');
                formData.append('notes', notes.value);

                // Teacher name
                const teacherName = document.getElementById('teacher-search');
                formData.append('teacher_name', teacherName.value);

                console.log('Form data collected:', Object.fromEntries(formData));
                alert('Penilaian berhasil disimpan!');
            });
        });
    </script>
@endsection
