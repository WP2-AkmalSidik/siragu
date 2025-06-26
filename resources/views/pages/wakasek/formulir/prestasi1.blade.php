<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
    <title>SIRAGU - Form Prestasi 1</title>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen pb-16 font-sans">

    <!-- App Header -->
    <header class="bg-white dark:bg-gray-800 shadow-sm py-3 px-4 border-b border-gray-100 dark:border-gray-700">
        <div class="flex justify-between items-center max-w-6xl mx-auto">
            <div class="flex items-center space-x-3">
                <button onclick="goBack()" class="text-gray-500 hover:text-bangala">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <div class="w-8 h-8 bg-bangala rounded-md flex items-center justify-center text-white font-bold">S</div>
                <h1 class="font-semibold text-lg">SIRAGU</h1>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-full bg-bangala/10 flex items-center justify-center text-bangala font-medium text-sm">
                    WK
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 py-6">
        <!-- Form Header -->
        <div class="mb-6">
            <div class="flex items-center space-x-3 mb-2">
                <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900/20 rounded-full flex items-center justify-center text-amber-600 dark:text-amber-400">
                    <i class="fas fa-trophy"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">Penilaian Prestasi 1</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Administrasi Pembelajaran</p>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <form id="prestasi1Form" class="space-y-6">
            <!-- Teacher Selection -->
            <div class="form-section bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                <h2 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-user-graduate text-bangala mr-2"></i>
                    Informasi Guru
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Nama Guru</label>
                        <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700">
                            <option value="">Pilih Guru</option>
                            <option value="siti">Siti Nurhaliza, S.Pd</option>
                            <option value="ahmad">Ahmad Fauzi, S.S</option>
                            <option value="fatimah">Fatimah Az-Zahra, M.Pd</option>
                            <option value="kurniadi">Kurniadi Gusti, S.Pd</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Mata Pelajaran</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700" placeholder="Contoh: Matematika">
                    </div>
                </div>
            </div>

            <!-- Assessment Items -->
            <div class="space-y-4">
                <!-- Item 1 -->
                <div class="form-section bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                    <h3 class="font-semibold mb-4 text-bangala">1. Program Tahunan dan Program Semester</h3>
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian terhadap kelengkapan dan kualitas program tahunan serta program semester yang dibuat guru.</p>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm font-medium">Nilai:</span>
                                <input type="number" min="1" max="100" class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center" placeholder="0">
                                <span class="text-sm text-gray-500">(1-100)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="form-section bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                    <h3 class="font-semibold mb-4 text-bangala">2. Rencana Pelaksanaan Pembelajaran (RPP) / Modul Ajar</h3>
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian terhadap kelengkapan dan kualitas RPP atau Modul Ajar yang dibuat guru.</p>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm font-medium">Nilai:</span>
                                <input type="number" min="1" max="100" class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center" placeholder="0">
                                <span class="text-sm text-gray-500">(1-100)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="form-section bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                    <h3 class="font-semibold mb-4 text-bangala">3. Penentuan KKM</h3>
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian terhadap penetapan Kriteria Ketuntasan Minimal yang sesuai dengan standar dan karakteristik siswa.</p>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm font-medium">Nilai:</span>
                                <input type="number" min="1" max="100" class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center" placeholder="0">
                                <span class="text-sm text-gray-500">(1-100)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="form-section bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                    <h3 class="font-semibold mb-4 text-bangala">4. Penyerahan Daftar Nilai</h3>
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian terhadap ketepatan waktu dan kelengkapan penyerahan daftar nilai siswa.</p>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm font-medium">Nilai:</span>
                                <input type="number" min="1" max="100" class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center" placeholder="0">
                                <span class="text-sm text-gray-500">(1-100)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 5 -->
                <div class="form-section bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                    <h3 class="font-semibold mb-4 text-bangala">5. Pelaksanaan Ulangan Harian</h3>
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian terhadap konsistensi dan kualitas pelaksanaan ulangan harian sesuai jadwal.</p>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm font-medium">Nilai:</span>
                                <input type="number" min="1" max="100" class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center" placeholder="0">
                                <span class="text-sm text-gray-500">(1-100)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 6 -->
                <div class="form-section bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                    <h3 class="font-semibold mb-4 text-bangala">6. Penyerahan Soal Ulangan / Ujian</h3>
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian terhadap ketepatan waktu penyerahan soal ulangan atau ujian kepada koordinator.</p>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm font-medium">Nilai:</span>
                                <input type="number" min="1" max="100" class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center" placeholder="0">
                                <span class="text-sm text-gray-500">(1-100)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 7 -->
                <div class="form-section bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                    <h3 class="font-semibold mb-4 text-bangala">7. Pembuatan Analisis Hasil Ulangan / Ujian</h3>
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian terhadap kelengkapan dan kualitas analisis hasil ulangan atau ujian yang dibuat.</p>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm font-medium">Nilai:</span>
                                <input type="number" min="1" max="100" class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center" placeholder="0">
                                <span class="text-sm text-gray-500">(1-100)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 8 -->
                <div class="form-section bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                    <h3 class="font-semibold mb-4 text-bangala">8. Pembuatan dan Pelaksanaan Remedial / Pengayaan</h3>
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian terhadap program remedial dan pengayaan yang dibuat serta pelaksanaannya.</p>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm font-medium">Nilai:</span>
                                <input type="number" min="1" max="100" class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center" placeholder="0">
                                <span class="text-sm text-gray-500">(1-100)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 9 -->
                <div class="form-section bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                    <h3 class="font-semibold mb-4 text-bangala">9. Pelaporan dalam Suatu Kepanitiaan yang Diberikan</h3>
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian terhadap partisipasi dan kontribusi dalam kepanitiaan serta kualitas laporan yang dibuat.</p>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm font-medium">Nilai:</span>
                                <input type="number" min="1" max="100" class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center" placeholder="0">
                                <span class="text-sm text-gray-500">(1-100)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Score Display -->
            <div class="bg-gradient-to-r from-bangala/10 to-blue-100 dark:from-bangala/20 dark:to-blue-900/20 rounded-lg p-6 border border-bangala/20">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-bangala/20 rounded-full flex items-center justify-center text-bangala">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg">Total Skor</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Rata-rata dari semua aspek penilaian</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div id="totalScore" class="text-3xl font-bold text-bangala">0</div>
                        <div class="text-sm text-gray-500">dari 100</div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-4">
                <button type="button" onclick="calculateScore()" class="flex-1 bg-bangala hover:bg-bangala/90 text-white py-3 px-6 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                    <i class="fas fa-calculator"></i>
                    <span>Hitung Skor</span>
                </button>
                <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 px-6 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                    <i class="fas fa-save"></i>
                    <span>Simpan Penilaian</span>
                </button>
                <button type="button" onclick="resetForm()" class="sm:w-auto bg-gray-500 hover:bg-gray-600 text-white py-3 px-6 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                    <i class="fas fa-undo"></i>
                    <span>Reset</span>
                </button>
            </div>
        </form>
    </main>

    <script>
        function goBack() {
            window.history.back();
        }

        function calculateScore() {
            const inputs = document.querySelectorAll('input[type="number"]');
            let total = 0;
            let count = 0;
            
            inputs.forEach(input => {
                if (input.value && input.value > 0) {
                    total += parseInt(input.value);
                    count++;
                }
            });
            
            const average = count > 0 ? Math.round(total / count) : 0;
            document.getElementById('totalScore').textContent = average;
        }

        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset semua nilai?')) {
                document.getElementById('prestasi1Form').reset();
                document.getElementById('totalScore').textContent = '0';
            }
        }

        // Auto calculate on input change
        document.addEventListener('input', function(e) {
            if (e.target.type === 'number') {
                calculateScore();
            }
        });
    </script>
</body>

</html>