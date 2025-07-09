<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <title>SIRAGU - Formulir Penilaian</title>
</head>

<body
    class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 text-gray-900 dark:text-gray-100 min-h-screen font-inter">
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

    <!-- Minimalist Progress Indicator -->
    <div class="bg-white dark:bg-gray-800 p-3 rounded-lg shadow-xs border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center space-x-1.5">
                <i class="fas fa-chart-line text-bangala text-xs"></i>
                <span class="text-xs font-medium text-gray-600 dark:text-gray-300">Progress</span>
            </div>
            <div class="text-sm">
                <span class="font-semibold text-bangala">3</span>
                <span class="text-gray-400 mx-0.5">/</span>
                <span class="font-medium text-gray-500 dark:text-gray-400">8</span>
            </div>
        </div>

        <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
            <div class="bg-gradient-to-r from-bangala to-goldspel h-2 rounded-full" style="width: 37.5%">
            </div>
        </div>

        <div class="flex justify-between text-2xs text-gray-400 dark:text-gray-500 mt-1">
            <span>Start</span>
            <span class="font-medium">38%</span>
            <span>Done</span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container px-4 pt-6 pb-24 mx-auto max-w-lg">
        <!-- Enhanced Form Header -->
        <div class="mb-8 animate-fade-in-up">
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-100 dark:border-gray-700 relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-bangala/10 to-goldspel/10 rounded-full -translate-y-16 translate-x-16">
                </div>
                <div class="relative">
                    <div class="flex items-center space-x-4 mb-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-bangala to-goldspel flex items-center justify-center shadow-lg">
                            <i class="fas fa-user-graduate text-white text-xl"></i>
                        </div>
                        <div class="flex justify-center items-start gap-6 w-full">
                            <div class="w-[45%]">
                                <label for="formulir"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih
                                    formulir</label>
                                <select id="formulir" name="form_id"
                                    class="block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala"></select>
                            </div>
                            <div class="w-[45%]">
                                <label for="jabatan"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih
                                    Jabatan</label>
                                <select id="jabatan" name="jabatan_id"
                                    class="block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala"></select>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-r from-bangala/5 to-goldspel/5 dark:from-bangala/10 dark:to-goldspel/10 rounded-xl p-4 border border-bangala/20 mb-4">
                        <div class="flex items-start space-x-3">
                            <div
                                class="w-6 h-6 rounded-full bg-bangala/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-info text-bangala text-xs"></i>
                            </div>
                            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                Berikan penilaian yang <span class="font-semibold text-bangala">objektif</span> dan
                                <span class="font-semibold text-bangala">konstruktif</span> berdasarkan observasi
                                langsung
                            </p>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-r from-bangala/5 to-goldspel/5 dark:from-bangala/10 dark:to-goldspel/10 rounded-xl p-4 border border-bangala/20">
                        <div class="flex justify-center items-start gap-4 w-full">
                            <div class="w-[30%]">
                                <label for="guru"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama
                                    Guru</label>
                                <select id="guru" name="user_id"
                                    class="block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala"></select>
                            </div>
                            <div class="w-[30%]">
                                <label for="tahun_ajaran"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tahun
                                    Ajaran</label>
                                <select id="tahun_ajaran" name="tahun_ajaran"
                                    class="block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala">
                                    @foreach (tahunAjaranTerakhir() as $tahun)
                                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-[30%]">
                                <label for="semester"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Semester</label>
                                <select id="semester" name="semester"
                                    class="block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala">
                                    <option value="genap">Genap</option>
                                    <option value="ganjil">Ganjil</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Assessment Form -->
        <div class="space-y-8">
            <!-- Question 1 with frequency options -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden animate-fade-in-up">
                <div class="p-6">
                    <div class="mb-6">
                        <div class="flex items-start space-x-4 mb-4">
                            <div
                                class="w-8 h-8 rounded-full bg-gradient-to-br from-bangala to-goldspel text-white text-sm font-bold flex items-center justify-center shadow-md">
                                1
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 leading-tight">
                                    Saya mendirikan sholat fardhu (wajib) berjamaah di masjid (laki-laki)
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                    Seberapa sering anda menunaikan sholat fardhu (wajib) berjamaah di masjid?
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Frequency Rating Scale -->
                    <div class="space-y-3">
                        <!-- Sangat Sering -->
                        <label
                            class="frequency-option flex items-center space-x-4 p-4 rounded-xl border-2 border-gray-100 dark:border-gray-600 hover:border-green-500/30 cursor-pointer transition-all duration-300 group">
                            <input type="radio" name="q1" value="4" class="custom-radio">
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white group-hover:text-green-600 transition-colors">Sangat
                                        Sering</span>
                                    <div class="frequency-indicator flex space-x-1">
                                        <i class="fas fa-check-circle text-green-500 text-base"></i>
                                        <i class="fas fa-check-circle text-green-500 text-base"></i>
                                        <i class="fas fa-check-circle text-green-500 text-base"></i>
                                        <i class="fas fa-check-circle text-green-500 text-base"></i>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                                    Selalu sholat berjamaah di masjid untuk semua sholat fardhu
                                </p>
                            </div>
                        </label>

                        <!-- Sering -->
                        <label
                            class="frequency-option flex items-center space-x-4 p-4 rounded-xl border-2 border-gray-100 dark:border-gray-600 hover:border-blue-500/30 cursor-pointer transition-all duration-300 group">
                            <input type="radio" name="q1" value="3" class="custom-radio">
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 transition-colors">Sering</span>
                                    <div class="frequency-indicator flex space-x-1">
                                        <i class="fas fa-check-circle text-blue-500 text-base"></i>
                                        <i class="fas fa-check-circle text-blue-500 text-base"></i>
                                        <i class="fas fa-check-circle text-blue-500 text-base"></i>
                                        <i class="far fa-check-circle text-gray-300 dark:text-gray-500 text-base"></i>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                                    Sholat berjamaah di masjid untuk sebagian besar sholat fardhu (3-4 kali sehari)
                                </p>
                            </div>
                        </label>

                        <!-- Jarang -->
                        <label
                            class="frequency-option flex items-center space-x-4 p-4 rounded-xl border-2 border-gray-100 dark:border-gray-600 hover:border-yellow-500/30 cursor-pointer transition-all duration-300 group">
                            <input type="radio" name="q1" value="2" class="custom-radio">
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white group-hover:text-yellow-600 transition-colors">Jarang</span>
                                    <div class="frequency-indicator flex space-x-1">
                                        <i class="fas fa-check-circle text-yellow-500 text-base"></i>
                                        <i class="fas fa-check-circle text-yellow-500 text-base"></i>
                                        <i class="far fa-check-circle text-gray-300 dark:text-gray-500 text-base"></i>
                                        <i class="far fa-check-circle text-gray-300 dark:text-gray-500 text-base"></i>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                                    Kadang-kadang sholat berjamaah di masjid (1-2 kali sehari)
                                </p>
                            </div>
                        </label>

                        <!-- Sangat Jarang -->
                        <label
                            class="frequency-option flex items-center space-x-4 p-4 rounded-xl border-2 border-gray-100 dark:border-gray-600 hover:border-red-500/30 cursor-pointer transition-all duration-300 group">
                            <input type="radio" name="q1" value="1" class="custom-radio">
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white group-hover:text-red-600 transition-colors">Sangat
                                        Jarang</span>
                                    <div class="frequency-indicator flex space-x-1">
                                        <i class="fas fa-check-circle text-red-500 text-base"></i>
                                        <i class="far fa-check-circle text-gray-300 dark:text-gray-500 text-base"></i>
                                        <i class="far fa-check-circle text-gray-300 dark:text-gray-500 text-base"></i>
                                        <i class="far fa-check-circle text-gray-300 dark:text-gray-500 text-base"></i>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                                    Hampir tidak pernah sholat berjamaah di masjid
                                </p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Untuk tampilan Di akhir formulir -->
            <div
                class="bg-gradient-to-br from-bangala via-red-900 to-goldspel rounded-2xl p-6 text-white shadow-xl relative overflow-hidden animate-fade-in-up">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -translate-y-8 translate-x-8">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-32 h-32 bg-black/10 rounded-full translate-y-16 -translate-x-16">
                </div>
                <div class="relative">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <i class="fas fa-chart-pie text-goldspel"></i>
                                <h3 class="text-lg font-bold">Ringkasan Penilaian</h3>
                            </div>
                            <p class="text-sm opacity-90 mb-3">2 dari 8 aspek telah dinilai</p>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold mb-1">3.5</div>
                            <div class="text-xs opacity-90 mb-2">Rata-rata skor</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Action Buttons -->
    <div
        class="fixed bottom-0 left-0 right-0 bg-white/90 dark:bg-gray-800/90 backdrop-blur-lg border-t border-gray-200/50 dark:border-gray-700/50 p-4 shadow-2xl">
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

    <script>
        // Add interactive feedback
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // Add ripple effect
                const label = this.closest('label');
                label.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    label.style.transform = 'scale(1)';
                }, 150);

                // Update selection state
                document.querySelectorAll(`input[name="${this.name}"]`).forEach(r => {
                    r.closest('label').classList.remove('border-bangala', 'dark:border-goldspel',
                        'bg-bangala/5', 'dark:bg-goldspel/5');
                });

                label.classList.add('border-bangala', 'dark:border-goldspel', 'bg-bangala/5',
                    'dark:bg-goldspel/5');
            });
        });

        // Dark mode toggle (optional)
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
        }
    </script>
</body>

</html>
