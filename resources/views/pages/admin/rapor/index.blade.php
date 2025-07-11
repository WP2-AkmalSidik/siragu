@extends('layouts.admin')
@section('title', 'Penilaian Guru')
@section('description', 'Form Penilaian Kinerja Guru')
@section('content')
    <div class="max-w-6xl mx-auto space-y-6">

        <!-- Teacher Search & Info Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
            <!-- Compact Search Bar -->
            <div class="relative">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex-1 relative">
                        <select id="guru"
                            class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-lg focus:ring-2 focus:ring-bangala focus:bg-white dark:focus:bg-gray-600 transition-all duration-200 text-sm">
                        </select>
                        {{-- <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i> --}}
                    </div>
                    <div class="flex-1 relative">
                        <select id="tahun_ajaran"
                            class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-lg focus:ring-2 focus:ring-bangala focus:bg-white dark:focus:bg-gray-600 transition-all duration-200 text-sm">
                            @foreach (tahunAjaranTerakhir() as $tahun)
                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @endforeach
                        </select>
                        {{-- <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i> --}}
                    </div>
                    <div class="flex-1 relative">
                        <select id="semester"
                            class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-lg focus:ring-2 focus:ring-bangala focus:bg-white dark:focus:bg-gray-600 transition-all duration-200 text-sm">
                            <option value="ganjil" @if (semesterSekarang() == 'ganjil') selected @endif>Ganjil</option>
                            <option value="genap" @if (semesterSekarang() == 'genap') selected @endif>Genap</option>
                        </select>
                        {{-- <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i> --}}
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
                                    id="nama">-</span>
                            </div>
                            <div class="truncate">
                                <span class="text-gray-500 dark:text-gray-400">NIP :</span>
                                <span class="font-medium text-gray-700 dark:text-gray-300 ml-1 truncate"
                                    id="nip">-</span>
                            </div>
                            <div class="truncate">
                                <span class="text-gray-500 dark:text-gray-400">Jabatan :</span>
                                <span class="font-medium text-gray-700 dark:text-gray-300 ml-1 truncate"
                                    id="jabatan">-</span>
                            </div>
                            <div class="truncate">
                                <span class="text-gray-500 dark:text-gray-400">Status : </span>
                                <span class="px-2 py-1 rounded-full text-xs" id="status">-</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rating Guide -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700">
            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Panduan Penilaian</h4>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-5 sm:gap-3">
                <!-- Kurang Sekali -->
                <div class="flex items-center gap-2 p-3 bg-red-50 dark:bg-red-900/20 rounded-lg">
                    <div
                        class="text-xs sm:text-sm font-bold bg-red-500 text-white px-2 py-1 rounded sm:rounded-lg sm:w-10 sm:h-10 sm:flex sm:items-center sm:justify-center">
                        ≤50
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm sm:text-base font-semibold text-red-700 dark:text-red-400 truncate">Kurang
                            Sekali</div>
                        <div class="text-xs text-red-600/80 dark:text-red-400/80 truncate">Perlu peningkatan</div>
                    </div>
                </div>

                <!-- Kurang -->
                <div class="flex items-center gap-2 p-3 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                    <div
                        class="text-xs sm:text-sm font-bold bg-orange-500 text-white px-2 py-1 rounded sm:rounded-lg sm:w-10 sm:h-10 sm:flex sm:items-center sm:justify-center">
                        51-68
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm sm:text-base font-semibold text-orange-700 dark:text-orange-400 truncate">Kurang
                        </div>
                        <div class="text-xs text-orange-600/80 dark:text-orange-400/80 truncate">Sudah memadai</div>
                    </div>
                </div>

                <!-- Cukup -->
                <div class="flex items-center gap-2 p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                    <div
                        class="text-xs sm:text-sm font-bold bg-yellow-500 text-white px-2 py-1 rounded sm:rounded-lg sm:w-10 sm:h-10 sm:flex sm:items-center sm:justify-center">
                        69-78
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm sm:text-base font-semibold text-yellow-700 dark:text-yellow-400 truncate">Cukup
                        </div>
                        <div class="text-xs text-yellow-600/80 dark:text-yellow-400/80 truncate">Memadai</div>
                    </div>
                </div>

                <!-- Baik -->
                <div class="flex items-center gap-2 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <div
                        class="text-xs sm:text-sm font-bold bg-blue-500 text-white px-2 py-1 rounded sm:rounded-lg sm:w-10 sm:h-10 sm:flex sm:items-center sm:justify-center">
                        79-88
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm sm:text-base font-semibold text-blue-700 dark:text-blue-400 truncate">Baik</div>
                        <div class="text-xs text-blue-600/80 dark:text-blue-400/80 truncate">Di atas rata-rata</div>
                    </div>
                </div>

                <!-- Sangat Baik -->
                <div class="flex items-center gap-2 p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                    <div
                        class="text-xs sm:text-sm font-bold bg-green-500 text-white px-2 py-1 rounded sm:rounded-lg sm:w-10 sm:h-10 sm:flex sm:items-center sm:justify-center">
                        ≥89
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm sm:text-base font-semibold text-green-700 dark:text-green-400 truncate">Sangat
                            Baik</div>
                        <div class="text-xs text-green-600/80 dark:text-green-400/80 truncate">Luar biasa</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6" id="data-form">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function loadData(guru, semester, tahun_ajaran) {

                const tahunAjar = tahun_ajaran.replace(/\//g, '-');

                $.ajax({
                    url: `/admin/rapor/${guru}/${semester}/${tahunAjar}`,
                    type: 'GET',
                    success: function(res) {
                        $('#data-form').html(res.data.view);
                    },
                    error: function() {
                        errorToast('Gagal memuat data.');
                    }
                });
            }


            loadSelectOptions('#guru', '{{ route('admin.guru.index') }}');

            $(document).on('change', '#guru', function(e) {
                e.preventDefault();
                const id = $(this).val();
                const semester = $('#semester').val();
                const tahun_ajaran = $('#tahun_ajaran').val();

                const url = `/admin/guru/${id}`;

                const successCallback = function(res) {
                    console.log(res)

                    res = res.data;

                    let jabatans = res.jabatans.map(j => formatJabatan(j.jabatan.jabatan)).join(', ');

                    $('#nama').text(res.nama);
                    $('#nip').text(res.nip);
                    $('#jabatan').text(jabatans);

                    let status;

                    if (res.status == 1) {
                        $('#status')
                            .removeClass('bg-red-100 bg-red-900/30 text-red-800 text-red-300')
                            .addClass('bg-green-100 bg-green-900/30 text-green-800 text-green-300');
                        status = 'Aktif';
                    } else {
                        $('#status')
                            .removeClass('bg-green-100 bg-green-900/30 text-green-800 text-green-300')
                            .addClass('bg-red-100 bg-red-900/30 text-red-800 text-red-300');
                        status = 'Tidak Aktif';
                    }

                    $('#status').text(status);
                    loadData(id, semester, tahun_ajaran);
                }

                const errorCallback = function(err) {
                    console.error(err);
                }

                ajaxCall(url, 'GET', null, successCallback, errorCallback);

            })

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
        });
    </script>
@endsection
