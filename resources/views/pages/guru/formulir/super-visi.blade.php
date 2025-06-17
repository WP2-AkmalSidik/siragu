<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
    <title>SIRAGU - Supervisi Kelas</title>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen pb-24 font-sans">
    <div class="bg-bangala text-white py-2 px-4 shadow-lg">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <a href="/beranda" class="text-gold hover:text-white transition-colors">
                    <i class="fas fa-arrow-left text-lg"></i>
                </a>
                <div>
                    <h1 class="text-lg font-bold">SIRAGU</h1>
                    <p class="text-xs text-gold">Sistem Rapor Guru</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div
                    class="w-8 h-8 rounded-full bg-gold flex items-center justify-center text-golspel font-bold text-sm">
                    GR
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-6">
        <!-- Compact Minimalist Form Header Card with Right-Aligned Progress -->
        <div class="bg-white dark:bg-gray-800 rounded-lg p-5 mb-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-start gap-4">
                <!-- Icon Section -->
                <div
                    class="w-12 h-12 bg-gradient-to-br from-bangala to-[#b1451e] rounded-lg flex items-center justify-center text-white shadow-md">
                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                </div>

                <!-- Content Section -->
                <div class="flex-1">
                    <!-- Title and Progress Percentage Row -->
                    <div class="flex items-start justify-between mb-1">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Formulir Supervisi Kelas
                            </h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Semester Genap 2024/2025</p>
                        </div>
                    </div>

                    <!-- Info Text -->
                    <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-2">
                        <i class="fas fa-info-circle mr-2 text-bangala dark:text-goldspel"></i>
                        <span>Isilah dengan jujur sesuai pelaksanaan pembelajaran</span>
                    </div>

                    <!-- Progress Bar with Time Estimate -->
                    <div class="flex items-center gap-3">
                        <div class="flex-1 bg-gray-100 dark:bg-gray-700 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-gradient-to-r from-bangala to-goldspel h-full rounded-full"
                                style="width: 25%"></div>
                        </div>
                        <span class="text-sm font-medium whitespace-nowrap">
                            25% Selesai
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Komponen Section -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-6 border border-gray-100 dark:border-gray-700">
            <!-- Section Header -->
            <div class="flex items-center justify-between mb-5 pb-2 border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center">
                    <div
                        class="w-8 h-8 rounded-md bg-bangala/10 dark:bg-bangala/20 text-bangala dark:text-goldspel flex items-center justify-center mr-3 font-medium">
                        A
                    </div>
                    <h3 class="text-lg font-semibold">Kegiatan Pendahuluan</h3>
                </div>
                <span class="text-xs px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded-full">Wajib</span>
            </div>

            <!-- Indikator 1 -->
            <div class="form-item mb-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                <div class="flex items-start mb-4">
                    <span
                        class="text-sm font-medium bg-bangala/10 dark:bg-bangala/20 text-bangala dark:text-goldspel w-6 h-6 rounded-full flex items-center justify-center mr-3 mt-0.5 flex-shrink-0">
                        1
                    </span>
                    <h4 class="font-medium">Melakukan apresiasi, motivasi dan penyampaian tujuan</h4>
                </div>

                <!-- Sub-indikator a -->
                <div class="ml-9 mb-5">
                    <label class="block text-sm font-medium mb-3">a. Mengecek perilaku awal (entry behavior)</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label
                                class="radio-option flex items-center space-x-3 p-3 rounded-lg border border-gray-200 dark:border-gray-600 cursor-pointer">
                                <input type="radio" name="a1_pelaksanaan" value="terlaksana"
                                    class="h-4 w-4 text-bangala">
                                <span>Terlaksana</span>
                            </label>
                            <label
                                class="radio-option flex items-center space-x-3 p-3 rounded-lg border border-gray-200 dark:border-gray-600 cursor-pointer">
                                <input type="radio" name="a1_pelaksanaan" value="tidak" class="h-4 w-4 text-red-500">
                                <span>Tidak Terlaksana</span>
                            </label>
                        </div>
                        <div>
                            <label for="a1_keterangan"
                                class="block text-xs font-medium mb-2 text-gray-500 dark:text-gray-400">Keterangan (jika
                                tidak terlaksana)</label>
                            <textarea id="a1_keterangan" rows="2"
                                class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Sub-indikator b -->
                <div class="ml-9 mb-5">
                    <label class="block text-sm font-medium mb-3">b. Mengaitkan materi pembelajaran sekarang dengan
                        pengalaman peserta didik atau pembelajaran sebelumnya</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label
                                class="radio-option flex items-center space-x-3 p-3 rounded-lg border border-gray-200 dark:border-gray-600 cursor-pointer">
                                <input type="radio" name="a2_pelaksanaan" value="terlaksana"
                                    class="h-4 w-4 text-bangala">
                                <span>Terlaksana</span>
                            </label>
                            <label
                                class="radio-option flex items-center space-x-3 p-3 rounded-lg border border-gray-200 dark:border-gray-600 cursor-pointer">
                                <input type="radio" name="a2_pelaksanaan" value="tidak" class="h-4 w-4 text-red-500">
                                <span>Tidak Terlaksana</span>
                            </label>
                        </div>
                        <div>
                            <label for="a2_keterangan"
                                class="block text-xs font-medium mb-2 text-gray-500 dark:text-gray-400">Keterangan (jika
                                tidak terlaksana)</label>
                            <textarea id="a2_keterangan" rows="2"
                                class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Sub-indikator c -->
                <div class="ml-9">
                    <label class="block text-sm font-medium mb-3">c. Menyampaikan tujuan/kompetensi yang akan dicapai
                        peserta didik</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label
                                class="radio-option flex items-center space-x-3 p-3 rounded-lg border border-gray-200 dark:border-gray-600 cursor-pointer">
                                <input type="radio" name="a3_pelaksanaan" value="terlaksana"
                                    class="h-4 w-4 text-bangala">
                                <span>Terlaksana</span>
                            </label>
                            <label
                                class="radio-option flex items-center space-x-3 p-3 rounded-lg border border-gray-200 dark:border-gray-600 cursor-pointer">
                                <input type="radio" name="a3_pelaksanaan" value="tidak"
                                    class="h-4 w-4 text-red-500">
                                <span>Tidak Terlaksana</span>
                            </label>
                        </div>
                        <div>
                            <label for="a3_keterangan"
                                class="block text-xs font-medium mb-2 text-gray-500 dark:text-gray-400">Keterangan
                                (jika tidak terlaksana)</label>
                            <textarea id="a3_keterangan" rows="2"
                                class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fixed Action Buttons -->
    <div
        class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-4 px-6 shadow-lg">
        <div class="flex space-x-3 max-w-lg mx-auto">
            <button
                class="flex-1 py-4 px-6 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-300 transform hover:scale-105 shadow-lg">
                <i class="fas fa-save mr-2"></i>
                Simpan Draft
            </button>
            <button
                class="flex-1 py-4 px-6 bg-gradient-to-r from-bangala to-goldspel text-white rounded-xl font-semibold hover:shadow-xl transform hover:scale-105 transition-all duration-300 shadow-lg">
                <i class="fas fa-arrow-right mr-2"></i>
                Lanjutkan
            </button>
        </div>
    </div>
</body>

</html>
