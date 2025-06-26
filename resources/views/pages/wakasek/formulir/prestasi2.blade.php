<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
    <title>SIRAGU - Form Prestasi 2</title>
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
                <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/20 rounded-full flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">Penilaian Prestasi 2</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Mata Pelajaran, Wali Kelas & Wakasek/Koordinator</p>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <form id="prestasi2Form" class="space-y-6">
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
                        <label class="block text-sm font-medium mb-2">Periode Penilaian</label>
                        <input type="month" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700">
                    </div>
                </div>
            </div>

            <!-- Mata Pelajaran Section -->
            <div class="form-section bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                <h2 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-book text-blue-500 mr-2"></i>
                    Mata Pelajaran
                </h2>
                <div class="space-y-4">
                    <!-- Item 2 -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold mb-3 text-bangala">2. Kelengkapan Administrasi selaku Wali Kelas</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian terhadap kelengkapan berkas administrasi dan dokumen wali kelas.</p>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-medium">Nilai:</span>
                            <input type="number" min="1" max="100" class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center" placeholder="0">
                            <span class="text-sm text-gray-500">(1-100)</span>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold mb-3 text-bangala">3. Rutinitas Pelaksanaan Pengajian Kelas</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian terhadap konsistensi pelaksanaan kegiatan pengajian atau bimbingan rohani kelas.</p>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-medium">Nilai:</span>
                            <input type="number" min="1" max="100" class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center" placeholder="0">
                            <span class="text-sm text-gray-500">(1-100)</span>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold mb-3 text-bangala">4. Kepedulian dalam Membantu Kegiatan yang Diselenggarakan Sekolah</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian terhadap partisipasi aktif dalam mendukung kegiatan sekolah dan kerjasama tim.</p>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-medium">Nilai:</span>
                            <input type="number" min="1" max="100" class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center" placeholder="0">
                            <span class="text-sm text-gray-500">(1-100)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wakasek/Koordinator Section -->
            <div class="form-section bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                <h2 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-user-tie text-purple-500 mr-2"></i>
                    Wakasek/Koordinator
                </h2>
                <div class="space-y-4">
                    <!-- Item 1 -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold mb-3 text-bangala">1. Pembuatan dan Penjabaran Program Kerja</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian terhadap kualitas perencanaan dan detail program kerja yang dibuat.</p>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-medium">Nilai:</span>
                            <input type="number" min="1" max="100" class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center" placeholder="0">
                            <span class="text-sm text-gray-500">(1-100)</span>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold mb-3 text-bangala">2. Pelaksanaan Program Kerja Kesehariannya</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian terhadap konsistensi dan efektivitas pelaksanaan program kerja harian.</p>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-medium">Nilai:</span>
                            <input type="number" min="1" max="100" class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center" placeholder="0">
                            <span class="text-sm text-gray-500">(1-100)</span>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold mb-3 text-bangala">3. Pelaporan Hasil Program Kerja</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian terhadap kualitas dan ketepatan waktu pelaporan hasil pelaksanaan program kerja.</p>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-medium">Nilai:</span>
                            <input type="number" min="1" max="100" class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center" placeholder="0">
                            <span class="text-sm text-gray-500">(1-100)</span>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold mb-3 text-bangala">4. Pengarsipan Hasil Program Kerja</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Penilaian terhadap sistem dokumentasi dan pengarsipan hasil program kerja.</p>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-medium">Nilai:</span>
                            <input type="number" min="1" max="100" class="w-20 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala bg-white dark:bg-gray-700 text-center" placeholder="0">
                            <span class="text-sm text-gray-500">(1-100)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Scores Display -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Mata Pelajaran Score -->
                <div class="bg-gradient-to-r from-blue-100 to-blue-50 dark:from-blue-900/20 dark:to-blue-800/20 rounded-lg p-4 border border-blue-200 dark:border-blue-700">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center text-blue-600">
                            <i class="fas fa-book text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Mata Pelajaran</h4>
                            <div id="mataPelajaranScore" class="text-2xl font-bold text-blue-600">0</div>
                        </div>
                    </div>
                </div>

                <!-- Wali Kelas Score -->
                <div class="bg-gradient-to-r from-green-100 to-green-50 dark:from-green-900/20 dark:to-green-800/20 rounded-lg p-4 border border-green-200 dark:border-green-700">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-green-500/20 rounded-full flex items-center justify-center text-green-600">
                            <i class="fas fa-users text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Wali Kelas</h4>
                            <div id="waliKelasScore" class="text-2xl font-bold text-green-600">0</div>
                        </div>
                    </div>
                </div>

                <!-- Wakasek Score -->
                <div class="bg-gradient-to-r from-purple-100 to-purple-50 dark:from-purple-900/20 dark:to-purple-800/20 rounded-lg p-4 border border-purple-200 dark:border-purple-700">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-purple-500/20 rounded-full flex items-center justify-center text-purple-600">
                            <i class="fas fa-user-tie text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Wakasek</h4>
                            <div id="wakasekScore" class="text-2xl font-bold text-purple-600">0</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Score Display -->
            <div class="bg-gradient-to-r from-bangala/10 to-emerald-100 dark:from-bangala/20 dark:to-emerald-900/20 rounded-lg p-6 border border-bangala/20">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-bangala/20 rounded-full flex items-center justify-center text-bangala">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg">Total Skor Prestasi 2</h3>
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
            // Get all sections
            const mataPelajaranInputs = document.querySelectorAll('.form-section:nth-of-type(2) input[type="number"]');
            const waliKelasInputs = document.querySelectorAll('.form-section:nth-of-type(3) input[type="number"]');
            const wakasekInputs = document.querySelectorAll('.form-section:nth-of-type(4) input[type="number"]');
            
            // Calculate Mata Pelajaran score
            let mataPelajaranTotal = 0;
            let mataPelajaranCount = 0;
            mataPelajaranInputs.forEach(input => {
                if (input.value && input.value > 0) {
                    mataPelajaranTotal += parseInt(input.value);
                    mataPelajaranCount++;
                }
            });
            const mataPelajaranAvg = mataPelajaranCount > 0 ? Math.round(mataPelajaranTotal / mataPelajaranCount) : 0;
            document.getElementById('mataPelajaranScore').textContent = mataPelajaranAvg;
            
            // Calculate Wali Kelas score
            let waliKelasTotal = 0;
            let waliKelasCount = 0;
            waliKelasInputs.forEach(input => {
                if (input.value && input.value > 0) {
                    waliKelasTotal += parseInt(input.value);
                    waliKelasCount++;
                }
            });
            const waliKelasAvg = waliKelasCount > 0 ? Math.round(waliKelasTotal / waliKelasCount) : 0;
            document.getElementById('waliKelasScore').textContent = waliKelasAvg;
            
            // Calculate Wakasek score
            let wakasekTotal = 0;
            let wakasekCount = 0;
            wakasekInputs.forEach(input => {
                if (input.value && input.value > 0) {
                    wakasekTotal += parseInt(input.value);
                    wakasekCount++;
                }
            });
            const wakasekAvg = wakasekCount > 0 ? Math.round(wakasekTotal / wakasekCount) : 0;
            document.getElementById('wakasekScore').textContent = wakasekAvg;
            
            // Calculate overall average
            const scores = [mataPelajaranAvg, waliKelasAvg, wakasekAvg].filter(score => score > 0);
            const overallAvg = scores.length > 0 ? Math.round(scores.reduce((a, b) => a + b, 0) / scores.length) : 0;
            document.getElementById('totalScore').textContent = overallAvg;
        }

        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset semua nilai?')) {
                document.getElementById('prestasi2Form').reset();
                document.getElementById('totalScore').textContent = '0';
                document.getElementById('mataPelajaranScore').textContent = '0';
                document.getElementById('waliKelasScore').textContent = '0';
                document.getElementById('wakasekScore').textContent = '0';
            }
        }

        // Auto calculate on input change
        document.addEventListener('input', function(e) {
            if (e.target.type === 'number') {
                calculateScore();
            }
        });

        // Form submission handler
        document.getElementById('prestasi2Form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate that teacher is selected
            const teacherSelect = document.querySelector('select');
            if (!teacherSelect.value) {
                alert('Mohon pilih nama guru terlebih dahulu.');
                return;
            }
            
            // Check if at least one score is filled
            const allInputs = document.querySelectorAll('input[type="number"]');
            let hasScore = false;
            allInputs.forEach(input => {
                if (input.value && input.value > 0) {
                    hasScore = true;
                }
            });
            
            if (!hasScore) {
                alert('Mohon isi minimal satu nilai penilaian.');
                return;
            }
            
            // Simulate save process
            const submitBtn = document.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                alert('Penilaian Prestasi 2 berhasil disimpan!');
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 2000);
        });
    </script>
</body>