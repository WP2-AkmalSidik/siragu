<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
    <title>SIRAGU - Dashboard Guru THQ</title>
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
                    MH
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-4">
        <!-- Guru THQ Profile Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl font-semibold">Ustadz Muhammad Hafidz</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Guru THQ | SMPIT Abu Bakar</p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold text-bangala">12/18</div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Guru Dinilai</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Guru</p>
                        <p class="text-2xl font-bold text-bangala">18</p>
                    </div>
                    <div
                        class="w-10 h-10 bg-bangala/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-bangala"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Sudah Dinilai</p>
                        <p class="text-2xl font-bold text-goldspel">12</p>
                    </div>
                    <div
                        class="w-10 h-10 bg-goldspel/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-goldspel"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Menunggu</p>
                        <p class="text-2xl font-bold text-orange-600">6</p>
                    </div>
                    <div
                        class="w-10 h-10 bg-orange-100 dark:bg-orange-900/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-clock text-orange-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Rata-rata</p>
                        <p class="text-2xl font-bold text-green-600">85.2</p>
                    </div>
                    <div
                        class="w-10 h-10 bg-blue-100 dark:bg-blue-900/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-chart-line text-green-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-4">Penilaian Tahfidz Al-Quran</h2>
            <div class="grid grid-cols-1 gap-4">
                <button onclick="openTHQForm()"
                    class="dashboard-card bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-lg p-6 border border-green-200 dark:border-green-700 hover:border-green-400 transition-all group text-left">
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform">
                            <i class="fas fa-quran text-2xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-lg text-green-800 dark:text-green-200">Penilaian Kemampuan THQ
                            </h3>
                            <p class="text-sm text-green-600 dark:text-green-400 mt-1">Evaluasi hafalan, bacaan, dan
                                pemahaman Al-Quran</p>
                            <div class="flex items-center space-x-4 mt-3">
                                <div class="flex items-center space-x-1 text-xs text-green-700 dark:text-green-300">
                                    <i class="fas fa-book-open"></i>
                                    <span>Hafalan</span>
                                </div>
                                <div class="flex items-center space-x-1 text-xs text-green-700 dark:text-green-300">
                                    <i class="fas fa-volume-up"></i>
                                    <span>Bacaan</span>
                                </div>
                                <div class="flex items-center space-x-1 text-xs text-green-700 dark:text-green-300">
                                    <i class="fas fa-heart"></i>
                                    <span>Adab</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-green-600 group-hover:translate-x-1 transition-transform">
                            <i class="fas fa-arrow-right text-xl"></i>
                        </div>
                    </div>
                </button>
            </div>
        </div>

        <!-- Recent Assessments -->
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700">
            <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                <h2 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-history text-bangala mr-2"></i>
                    Penilaian Terbaru
                </h2>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                <div
                    class="p-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-bangala/10 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-graduate text-bangala"></i>
                        </div>
                        <div>
                            <p class="font-medium">Ustadz Abdullah Rahman, S.Pd.I</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Guru Kelas 5A • Juz 29-30</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-bangala/10 text-bangala">
                            Selesai
                        </span>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Nilai: 88</p>
                    </div>
                </div>

                <div
                    class="p-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-blue-100 dark:bg-blue-900/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-graduate text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div>
                            <p class="font-medium">Ustadzah Khadijah, S.Pd.I</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Guru Kelas 4B • Juz 28-29</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900/20 dark:text-orange-400">
                            Proses
                        </span>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">-</p>
                    </div>
                </div>

                <div
                    class="p-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-purple-100 dark:bg-purple-900/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-graduate text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <div>
                            <p class="font-medium">Ustadz Yusuf Ahmad, M.Pd.I</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Guru Kelas 6A • Juz 1-5</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-bangala/10 text-bangala">
                            Selesai
                        </span>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Nilai: 92</p>
                    </div>
                </div>

                <div
                    class="p-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-teal-100 dark:bg-teal-900/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-graduate text-teal-600 dark:text-teal-400"></i>
                        </div>
                        <div>
                            <p class="font-medium">Ustadzah Aminah Zahra, S.Pd.I</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Guru Kelas 3C • Juz 30</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-bangala/10 text-bangala">
                            Selesai
                        </span>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Nilai: 85</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bottom Navigation -->
    <nav
        class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 py-2">
        <div class="flex justify-around max-w-2xl mx-auto">
            <a href="/thq" class="flex flex-col items-center text-bangala">
                <i class="fas fa-home"></i>
                <span class="text-xs mt-1">Beranda</span>
            </a>
            <a href="/statistik" class="flex flex-col items-center text-gray-400 hover:text-bangala">
                <i class="fas fa-chart-bar"></i>
                <span class="text-xs mt-1">Statistik</span>
            </a>
            <a href="/profile" class="flex flex-col items-center text-gray-400 hover:text-bangala">
                <i class="fas fa-user"></i>
                <span class="text-xs mt-1">Profil</span>
            </a>
        </div>
    </nav>

    <!-- THQ Form Modal -->
    <div id="thqFormModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <!-- Form Header -->
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-bangala/10 rounded-full flex items-center justify-center text-bangala">
                                <i class="fas fa-quran-open"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold">Penilaian Kemampuan THQ</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Evaluasi Tahfidz Al-Quran Guru</p>
                            </div>
                        </div>
                        <button onclick="closeTHQForm()" class="text-gray-500 hover:text-red-500">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-6">
                    <form id="thqForm" class="space-y-6">
                        <!-- Teacher Selection -->
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                            <h3 class="font-semibold mb-4 flex items-center text-bangala">
                                <i class="fas fa-user-graduate mr-2"></i>
                                Informasi Guru
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium mb-2">Nama Guru</label>
                                    <select
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700">
                                        <option value="">Pilih Guru</option>
                                        <option value="abdullah">Ustadz Abdullah Rahman, S.Pd.I</option>
                                        <option value="khadijah">Ustadzah Khadijah, S.Pd.I</option>
                                        <option value="yusuf">Ustadz Yusuf Ahmad, M.Pd.I</option>
                                        <option value="aminah">Ustadzah Aminah Zahra, S.Pd.I</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Target Hafalan</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700"
                                        placeholder="Contoh: Juz 29-30">
                                </div>
                            </div>
                        </div>

                        <!-- Assessment Items -->
                        <div class="space-y-4">
                            <!-- Aspek Hafalan -->
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-200 dark:border-gray-600">
                                <h3 class="font-semibold mb-4 text-bangala flex items-center">
                                    <i class="fas fa-book-open mr-2"></i>
                                    1. Kemampuan Hafalan Al-Quran
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian kelancaran dan
                                    ketepatan hafalan Al-Quran sesuai target yang ditetapkan.</p>
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm font-medium">Nilai:</span>
                                    <input type="number" min="1" max="100"
                                        class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center score-input"
                                        placeholder="0">
                                    <span class="text-sm text-gray-500">(1-100)</span>
                                </div>
                            </div>

                            <!-- Aspek Bacaan -->
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-200 dark:border-gray-600">
                                <h3 class="font-semibold mb-4 text-bangala flex items-center">
                                    <i class="fas fa-volume-up mr-2"></i>
                                    2. Kualitas Bacaan (Tajwid)
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian ketepatan tajwid,
                                    makhorijul huruf, dan kualitas bacaan Al-Quran.</p>
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm font-medium">Nilai:</span>
                                    <input type="number" min="1" max="100"
                                        class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center score-input"
                                        placeholder="0">
                                    <span class="text-sm text-gray-500">(1-100)</span>
                                </div>
                            </div>

                            <!-- Aspek Kelancaran -->
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-200 dark:border-gray-600">
                                <h3 class="font-semibold mb-4 text-bangala flex items-center">
                                    <i class="fas fa-tachometer-alt mr-2"></i>
                                    3. Kelancaran Membaca
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian kelancaran dan
                                    kemampuan membaca Al-Quran tanpa terputus-putus.</p>
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm font-medium">Nilai:</span>
                                    <input type="number" min="1" max="100"
                                        class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center score-input"
                                        placeholder="0">
                                    <span class="text-sm text-gray-500">(1-100)</span>
                                </div>
                            </div>

                            <!-- Aspek Pemahaman -->
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-200 dark:border-gray-600">
                                <h3 class="font-semibold mb-4 text-bangala flex items-center">
                                    <i class="fas fa-lightbulb mr-2"></i>
                                    4. Pemahaman Makna
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian pemahaman terhadap
                                    makna dan kandungan ayat-ayat yang dihafal.</p>
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm font-medium">Nilai:</span>
                                    <input type="number" min="1" max="100"
                                        class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center score-input"
                                        placeholder="0">
                                    <span class="text-sm text-gray-500">(1-100)</span>
                                </div>
                            </div>

                            <!-- Aspek Adab -->
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-200 dark:border-gray-600">
                                <h3 class="font-semibold mb-4 text-bangala flex items-center">
                                    <i class="fas fa-heart mr-2"></i>
                                    5. Adab Membaca Al-Quran
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian adab dan etika saat
                                    membaca Al-Quran (wudhu, duduk, khusyu', dll).</p>
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm font-medium">Nilai:</span>
                                    <input type="number" min="1" max="100"
                                        class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center score-input"
                                        placeholder="0">
                                    <span class="text-sm text-gray-500">(1-100)</span>
                                </div>
                            </div>

                            <!-- Aspek Kemampuan Mengajar -->
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-200 dark:border-gray-600">
                                <h3 class="font-semibold mb-4 text-bangala flex items-center">
                                    <i class="fas fa-chalkboard-teacher mr-2"></i>
                                    6. Kemampuan Mengajar THQ
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian kemampuan
                                    mengajarkan hafalan dan tajwid kepada siswa.</p>
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm font-medium">Nilai:</span>
                                    <input type="number" min="1" max="100"
                                        class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center score-input"
                                        placeholder="0">
                                    <span class="text-sm text-gray-500">(1-100)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Total Score Display -->
                        <div
                            class="bg-gradient-to-r from-bangala/10 to-goldspel/10 rounded-lg p-6 border border-bangala/20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-10 h-10 bg-bangala/10 rounded-full flex items-center justify-center text-bangala">
                                        <i class="fas fa-calculator"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg text-bangala">Total Skor
                                            THQ</h3>
                                        <p class="text-sm text-bangala/70">Rata-rata dari semua
                                            aspek penilaian</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div id="totalScoreTHQ" class="text-3xl font-bold text-bangala">0</div>
                                    <div class="text-sm text-bangala/80">dari 100</div>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-200 dark:border-gray-600">
                            <h3 class="font-semibold mb-4 text-gray-700 dark:text-gray-300 flex items-center">
                                <i class="fas fa-sticky-note mr-2"></i>
                                Catatan Tambahan
                            </h3>
                            <textarea
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 h-24"
                                placeholder="Tulis catatan, saran, atau rekomendasi untuk guru yang dinilai..."></textarea>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-3 pt-4">
                            <button type="button" onclick="calculateTHQScore()"
                                class="flex-1 bg-bangala hover:bg-bangala/90 text-white py-3 px-4 rounded-lg font-medium transition-colors flex items-center justify-center">
                                <i class="fas fa-calculator mr-2"></i>
                                Hitung Skor
                            </button>
                            <button type="submit"
                                class="flex-1 bg-goldspel hover:bg-goldspel/90 text-white py-3 px-4 rounded-lg font-medium transition-colors flex items-center justify-center">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Penilaian
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Function to open THQ Form Modal
        function openTHQForm() {
            document.getElementById('thqFormModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        // Function to close THQ Form Modal
        function closeTHQForm() {
            document.getElementById('thqFormModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Function to calculate THQ Score
        function calculateTHQScore() {
            const scoreInputs = document.querySelectorAll('.score-input');
            let total = 0;
            let count = 0;

            scoreInputs.forEach(input => {
                const value = parseFloat(input.value);
                if (!isNaN(value) && value >= 0 && value <= 100) {
                    total += value;
                    count++;
                }
            });

            if (count > 0) {
                const average = Math.round((total / count) * 10) / 10;
                document.getElementById('totalScoreTHQ').textContent = average;

                // Color coding based on score
                const totalScoreElement = document.getElementById('totalScoreTHQ');
                if (average >= 85) {
                    totalScoreElement.className = 'text-3xl font-bold text-green-600';
                } else if (average >= 70) {
                    totalScoreElement.className = 'text-3xl font-bold text-yellow-500';
                } else {
                    totalScoreElement.className = 'text-3xl font-bold text-red-500';
                }
            } else {
                document.getElementById('totalScoreTHQ').textContent = '0';
            }
        }

        // Form submission handler
        document.getElementById('thqForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Validate form
            const teacherSelect = this.querySelector('select');
            if (!teacherSelect.value) {
                alert('Silakan pilih guru yang akan dinilai');
                return;
            }

            // Calculate final score
            calculateTHQScore();
            const finalScore = document.getElementById('totalScoreTHQ').textContent;

            // Here you would typically send data to server
            alert(
                `Penilaian untuk ${teacherSelect.options[teacherSelect.selectedIndex].text} berhasil disimpan dengan skor ${finalScore}`);

            // Close modal
            closeTHQForm();

            // Reset form
            this.reset();
            document.getElementById('totalScoreTHQ').textContent = '0';
            document.getElementById('totalScoreTHQ').className = 'text-3xl font-bold text-green-600';
        });

        // Close modal when clicking outside
        document.getElementById('thqFormModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeTHQForm();
            }
        });
    </script>
</body>

</html>
