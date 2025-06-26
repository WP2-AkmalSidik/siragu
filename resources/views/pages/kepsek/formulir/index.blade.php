<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
    <title>SIRAGU - Form Penilaian Kinerja Guru</title>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen font-sans transition-colors duration-200">

    <!-- App Header -->
    <header class="bg-white dark:bg-gray-800 shadow-sm py-4 px-6 border-b border-gray-100 dark:border-gray-700 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <button onclick="history.back()" class="text-gray-500 hover:text-bangala transition-colors">
                    <i class="fas fa-arrow-left text-lg"></i>
                </button>
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 bg-bangala rounded-lg flex items-center justify-center text-white font-bold text-lg">S</div>
                    <h1 class="font-semibold text-lg">SIRAGU</h1>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm font-medium">Form Penilaian Kinerja</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Kepala Sekolah</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-6 py-8">
        <!-- Form Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 mb-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">Penilaian Kinerja Guru</h1>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">Evaluasi komprehensif kinerja dan profesionalitas guru</p>
                </div>
                <div class="w-full md:w-64">
                    <label for="teacher-select" class="block text-sm font-medium mb-2">Pilih Guru</label>
                    <select id="teacher-select" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-bangala focus:border-transparent transition-all">
                        <option value="">-- Pilih Guru --</option>
                        <option value="1">Dr. Siti Nurhaliza, S.Pd - Matematika</option>
                        <option value="2">Ahmad Fauzi, S.S - Bahasa Indonesia</option>
                        <option value="3">Fatimah Az-Zahra, M.Pd - IPA</option>
                        <option value="4">Muhammad Rizki, S.Kom - TIK</option>
                        <option value="5">Nurul Hidayah, S.Ag - PAI</option>
                        <option value="6">Dr. Andi Setiawan, M.Pd - Fisika</option>
                        <option value="7">Sari Wulandari, S.Pd - Bahasa Inggris</option>
                    </select>
                </div>
            </div>

            <!-- Rating Scale -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-info-circle text-indigo-600 dark:text-indigo-400"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Skala Penilaian</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Gunakan skala berikut sebagai panduan</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                    <div class="p-3 bg-gray-50 dark:bg-gray-700/30 rounded-lg border border-gray-200 dark:border-gray-700 flex items-center gap-3">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0">1</div>
                        <div>
                            <h4 class="font-medium text-sm text-red-700 dark:text-red-400">Kurang Sekali</h4>
                            <p class="text-xs text-red-600 dark:text-red-400">0-50</p>
                        </div>
                    </div>
                    <div class="p-3 bg-gray-50 dark:bg-gray-700/30 rounded-lg border border-gray-200 dark:border-gray-700 flex items-center gap-3">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0">2</div>
                        <div>
                            <h4 class="font-medium text-sm text-orange-700 dark:text-orange-400">Kurang</h4>
                            <p class="text-xs text-orange-600 dark:text-orange-400">51-68</p>
                        </div>
                    </div>
                    <div class="p-3 bg-gray-50 dark:bg-gray-700/30 rounded-lg border border-gray-200 dark:border-gray-700 flex items-center gap-3">
                        <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0">3</div>
                        <div>
                            <h4 class="font-medium text-sm text-yellow-700 dark:text-yellow-400">Cukup</h4>
                            <p class="text-xs text-yellow-600 dark:text-yellow-400">69-78</p>
                        </div>
                    </div>
                    <div class="p-3 bg-gray-50 dark:bg-gray-700/30 rounded-lg border border-gray-200 dark:border-gray-700 flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0">4</div>
                        <div>
                            <h4 class="font-medium text-sm text-blue-700 dark:text-blue-400">Baik</h4>
                            <p class="text-xs text-blue-600 dark:text-blue-400">79-88</p>
                        </div>
                    </div>
                    <div class="p-3 bg-gray-50 dark:bg-gray-700/30 rounded-lg border border-gray-200 dark:border-gray-700 flex items-center gap-3">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0">5</div>
                        <div>
                            <h4 class="font-medium text-sm text-green-700 dark:text-green-400">Sangat Baik</h4>
                            <p class="text-xs text-green-600 dark:text-green-400">89-100</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assessment Form -->
        <form id="assessment-form" class="space-y-6">
            <!-- Assessment Categories -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Tanggung Jawab -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-check text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Tanggung Jawab</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Evaluasi tingkat tanggung jawab</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">Nilai (1-100)</label>
                            <input type="number" id="responsibility" name="responsibility" min="1" max="100"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-bangala focus:border-transparent transition-all"
                                placeholder="Masukkan nilai">
                            <div id="responsibility-category" class="text-xs mt-1 text-gray-500 dark:text-gray-400"></div>
                        </div>
                    </div>
                </div>

                <!-- Ketaatan -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-handshake text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Ketaatan</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Evaluasi kepatuhan terhadap aturan</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">Nilai (1-100)</label>
                            <input type="number" id="obedience" name="obedience" min="1" max="100"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-bangala focus:border-transparent transition-all"
                                placeholder="Masukkan nilai">
                            <div id="obedience-category" class="text-xs mt-1 text-gray-500 dark:text-gray-400"></div>
                        </div>
                    </div>
                </div>

                <!-- Kerjasama -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Kerjasama</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Evaluasi kemampuan bekerjasama</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">Nilai (1-100)</label>
                            <input type="number" id="cooperation" name="cooperation" min="1" max="100"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-bangala focus:border-transparent transition-all"
                                placeholder="Masukkan nilai">
                            <div id="cooperation-category" class="text-xs mt-1 text-gray-500 dark:text-gray-400"></div>
                        </div>
                    </div>
                </div>

                <!-- Prakarsa -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-lightbulb text-orange-600 dark:text-orange-400"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Prakarsa</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Evaluasi inisiatif dan kreativitas</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">Nilai (1-100)</label>
                            <input type="number" id="initiative" name="initiative" min="1" max="100"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-bangala focus:border-transparent transition-all"
                                placeholder="Masukkan nilai">
                            <div id="initiative-category" class="text-xs mt-1 text-gray-500 dark:text-gray-400"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Section -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-10 h-10 bg-bangala/10 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calculator text-bangala"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Ringkasan Penilaian</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nilai rata-rata dan kesimpulan</p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <div class="bg-gradient-to-br from-bangala to-goldspel text-white rounded-xl p-6 mb-6">
                            <div class="text-4xl font-bold mb-1" id="average-score">0</div>
                            <p class="text-sm opacity-90">Nilai Rata-rata</p>
                            <div id="overall-category" class="text-xs font-medium mt-2 bg-white/20 rounded-full px-3 py-1 inline-block"></div>
                        </div>

                        <div class="space-y-3" id="score-breakdown">
                            <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700/30 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <div class="w-2.5 h-2.5 bg-blue-500 rounded-full"></div>
                                    <span class="text-sm">Tanggung Jawab:</span>
                                </div>
                                <span id="resp-display" class="font-semibold">-</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700/30 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <div class="w-2.5 h-2.5 bg-green-500 rounded-full"></div>
                                    <span class="text-sm">Ketaatan:</span>
                                </div>
                                <span id="obed-display" class="font-semibold">-</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700/30 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <div class="w-2.5 h-2.5 bg-purple-500 rounded-full"></div>
                                    <span class="text-sm">Kerjasama:</span>
                                </div>
                                <span id="coop-display" class="font-semibold">-</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700/30 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <div class="w-2.5 h-2.5 bg-orange-500 rounded-full"></div>
                                    <span class="text-sm">Prakarsa:</span>
                                </div>
                                <span id="init-display" class="font-semibold">-</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Catatan Umum</label>
                        <textarea name="general_note" rows="8"
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-bangala focus:border-transparent transition-all"
                            placeholder="Berikan kesimpulan umum dan rekomendasi untuk guru yang dinilai..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                <button type="button" onclick="saveDraft()"
                    class="flex-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-6 py-3 rounded-lg font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-all flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i>
                    <span>Simpan Draft</span>
                </button>
                <button type="submit"
                    class="flex-1 bg-bangala hover:bg-bangala/90 text-white px-6 py-3 rounded-lg font-medium transition-all flex items-center justify-center gap-2 hover:shadow-md">
                    <i class="fas fa-paper-plane"></i>
                    <span>Submit Penilaian</span>
                </button>
            </div>
        </form>
    </main>

    <script>
        // Function to get score category
        function getScoreCategory(score) {
            if (score >= 89) return { text: 'Sangat Baik', color: 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' };
            if (score >= 79) return { text: 'Baik', color: 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400' };
            if (score >= 69) return { text: 'Cukup', color: 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400' };
            if (score >= 51) return { text: 'Kurang', color: 'bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400' };
            if (score > 0) return { text: 'Kurang Sekali', color: 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400' };
            return null;
        }

        // Update category display
        function updateCategoryDisplay(fieldId, score) {
            const displayElement = document.getElementById(`${fieldId}-category`);
            const category = getScoreCategory(parseInt(score) || 0);
            
            if (category) {
                displayElement.textContent = `${category.text} (${score})`;
                displayElement.className = `text-xs mt-1 ${category.color} px-2 py-1 rounded-full inline-block`;
            } else {
                displayElement.textContent = '';
                displayElement.className = 'text-xs mt-1 text-gray-500 dark:text-gray-400';
            }
        }

        // Function to calculate average score
        function calculateAverage() {
            const fields = ['responsibility', 'obedience', 'cooperation', 'initiative'];
            let total = 0;
            let count = 0;

            fields.forEach(field => {
                const value = parseInt(document.getElementById(field).value) || 0;
                if (value > 0) {
                    total += value;
                    count++;
                    // Update display for each field
                    document.getElementById(`${field.substring(0, 4)}-display`).textContent = value;
                    updateCategoryDisplay(field, value);
                }
            });

            const average = count > 0 ? Math.round(total / count) : 0;
            document.getElementById('average-score').textContent = average;

            // Update overall category
            const overallCategory = document.getElementById('overall-category');
            const category = getScoreCategory(average);
            if (category) {
                overallCategory.textContent = category.text;
                overallCategory.className = `text-xs font-medium mt-2 rounded-full px-3 py-1 inline-block ${category.color}`;
            } else {
                overallCategory.textContent = '';
            }
        }

        // Save draft function
        function saveDraft() {
            const formData = new FormData(document.getElementById('assessment-form'));
            const data = Object.fromEntries(formData.entries());

            // Save to localStorage
            localStorage.setItem('teacherAssessmentDraft', JSON.stringify(data));

            // Show notification
            showNotification('Draft berhasil disimpan', 'success');
        }

        // Form submission handler
        document.getElementById('assessment-form').addEventListener('submit', function(e) {
            e.preventDefault();

            // Validate form
            const teacherSelect = document.getElementById('teacher-select');
            if (!teacherSelect.value) {
                showNotification('Silakan pilih guru yang akan dinilai', 'error');
                teacherSelect.focus();
                return;
            }

            const fields = ['responsibility', 'obedience', 'cooperation', 'initiative'];
            let isValid = true;

            fields.forEach(field => {
                const input = document.getElementById(field);
                const value = parseInt(input.value) || 0;
                if (value < 1 || value > 100) {
                    input.classList.add('border-red-500');
                    isValid = false;
                } else {
                    input.classList.remove('border-red-500');
                }
            });

            if (!isValid) {
                showNotification('Semua nilai harus diisi antara 1-100', 'error');
                return;
            }

            // Submit form (simulate)
            showNotification('Penilaian berhasil dikirim', 'success');
            setTimeout(() => {
                window.location.href = 'assessment-success.html';
            }, 1500);
        });

        // Show notification function
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white font-medium z-50 animate-fade-in-up ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.classList.add('animate-fade-out');
                setTimeout(() => {
                    notification.remove();
                }, 500);
            }, 3000);
        }

        // Input validation and calculation
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                const value = parseInt(this.value) || 0;
                if (value < 0) this.value = 0;
                if (value > 100) this.value = 100;

                calculateAverage();
            });
        });

        // Load draft if exists
        window.addEventListener('DOMContentLoaded', function() {
            const draft = localStorage.getItem('teacherAssessmentDraft');
            if (draft) {
                const data = JSON.parse(draft);

                // Populate form fields
                for (const key in data) {
                    const element = document.querySelector(`[name="${key}"]`);
                    if (element) element.value = data[key];
                }

                // Calculate initial average
                calculateAverage();
            }
        });
    </script>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.3s ease-out forwards;
        }
        
        .animate-fade-out {
            animation: fadeOut 0.5s ease-out forwards;
        }
        
        /* Remove number input arrows */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
</body>

</html>