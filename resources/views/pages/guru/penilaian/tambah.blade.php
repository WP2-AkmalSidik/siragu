@extends('layouts.guru')

@section('title', 'Penilaian')
@section('description', 'Form Penilaian')

@push('styles')
    <style>
        .sticky-top {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 30;
            backdrop-filter: blur(8px);
            /* background-color: rgba(17, 24, 39, 0.8);
                    background-image: linear-gradient(to right, #913013, #f59e0b); */
        }

        .sticky-bottom {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 30;
            backdrop-filter: blur(8px);
            background-image: linear-gradient(to right, #913013, #f59e0b);
        }

        .question-container {
            display: none;
        }

        .question-container.active {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .wizard-nav {
            display: flex;
            justify-content: space-between;
            /* margin-top: 2rem; */
        }

        .question-indicator {
            display: flex;
            justify-content: center;
            /* Ini yang membuat rata tengah */
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            padding: 0.5rem;
            background-color: rgba(229, 231, 235, 0.3);
            /* Latar belakang abu-abu muda */
            border-radius: 9999px;
            /* Bentuk bulat penuh */
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }

        .indicator-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background-color: #e5e7eb;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .indicator-dot.answered {
            background-color: #913013;
            /* Hijau untuk pertanyaan terjawab */
        }

        .indicator-dot.current {
            transform: scale(1.4);
            background-color: #f59e0b;
            /* Orange untuk pertanyaan saat ini */
            box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.3);
        }

        /* Tooltip untuk nomor pertanyaan */
        .indicator-dot::after {
            content: attr(data-index);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: #1f2937;
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            opacity: 0;
            transition: opacity 0.2s;
            pointer-events: none;
            white-space: nowrap;
        }

        .indicator-dot:hover::after {
            opacity: 1;
        }

        .wizard-nav-container {
            position: sticky;
            bottom: 120px;
            /* Sesuaikan dengan tinggi summary card */
            z-index: 25;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 1rem;
            border-radius: 12px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }

        .summary-card-container {
            position: sticky;
            bottom: 0;
            z-index: 20;
        }
    </style>
@endpush

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md">
        <!-- Minimalist Progress Indicator -->
        <div id="progress-container"
            class="bg-gray-50 dark:bg-gray-700 rounded-xl p-3 mb-6 shadow-sm border border-gray-100 dark:border-gray-600 sticky top-0 z-50 backdrop-blur-md">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center space-x-1.5">
                    <i class="fas fa-chart-line text-bangala text-xs"></i>
                    <span class="text-xs font-medium text-gray-600 dark:text-gray-300">Progress</span>
                </div>
                <div class="text-sm">
                    <span class="font-semibold text-bangala" id="answered-count">0</span>
                    <span class="text-gray-400 mx-0.5">/</span>
                    <span class="font-medium text-gray-500 dark:text-gray-400" id="total-questions">0</span>
                </div>
            </div>

            <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                <div id="progress-bar" class="bg-gradient-to-r from-bangala to-goldspel h-2 rounded-full" style="width: 0%">
                </div>
            </div>

            <div class="flex justify-between text-2xs text-gray-400 dark:text-gray-500 mt-1">
                <span>Start</span>
                <span class="font-medium" id="progress-percentage">0%</span>
                <span>Done</span>
            </div>
        </div>

        <!-- Enhanced Form Header -->
        <form id="penilaian-form">
            <div
                class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 mb-6 shadow-sm border border-gray-100 dark:border-gray-600 relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-bangala/10 to-goldspel/10 rounded-full -translate-y-16 translate-x-16">
                </div>
                <div class="relative">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="jabatan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih
                                Jabatan</label>
                            <select id="jabatan" name="jabatan_id"
                                class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala h-12"></select>
                        </div>

                        <div>
                            <label for="formulir"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Formulir</label>
                            <select id="formulir" name="form_id" disabled
                                class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala h-12"></select>
                        </div>

                        <div>
                            <label for="guru"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Guru</label>
                            <select id="guru" name="user_id" disabled
                                class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala h-12"></select>
                        </div>

                        <div>
                            <label for="tahun_ajaran"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tahun Ajaran</label>
                            <select id="tahun_ajaran" name="tahun_ajaran"
                                class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala h-12">
                                @foreach (tahunAjaranTerakhir() as $tahun)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="semester"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Semester</label>
                            <select id="semester" name="semester"
                                class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala h-12">
                                <option value="genap">Genap</option>
                                <option value="ganjil">Ganjil</option>
                            </select>
                        </div>
                    </div>

                    <div id="keterangan-form-container"
                        class="hidden bg-gradient-to-r from-bangala/5 to-goldspel/5 dark:from-bangala/10 dark:to-goldspel/10 rounded-xl p-4 border border-bangala/20 mt-5">
                        <div class="flex items-start space-x-3">
                            <div
                                class="w-6 h-6 rounded-full bg-bangala/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-info text-bangala text-xs"></i>
                            </div>
                            <p id="keterangan-form" class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question Indicator Dots -->
            <div class="w-full flex justify-center mb-6">
                <div id="question-indicator" class="question-indicator"></div>
            </div>

            <!-- Form Penilaian -->
            <div class="space-y-6" id="form-penilaian"></div>

            <!-- Wizard Navigation -->
            <div
                class="wizard-nav-container bg-gradient-to-br from-bangala via-red-900 to-goldspel rounded-2xl p-6 text-white shadow-xl">
                <div class="wizard-nav">
                    <button type="button" id="prev-btn"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors hidden">
                        <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                    </button>
                    <button type="button" id="next-btn"
                        class="px-4 py-2 bg-gradient-to-r from-bangala to-goldspel text-white rounded-lg hover:shadow-lg transition-all">
                        Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>

            <!-- Summary Card -->
            <div id="summary-card"
                class="bg-gradient-to-br from-bangala via-red-900 to-goldspel rounded-2xl p-6 text-white shadow-xl relative overflow-hidden animate-fade-in-up hidden mt-6 sticky bottom-0 z-20">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -translate-y-8 translate-x-8"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-black/10 rounded-full translate-y-16 -translate-x-16">
                </div>
                <div class="relative">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <i class="fas fa-chart-pie text-goldspel"></i>
                                <h3 class="text-lg font-bold">Ringkasan Penilaian</h3>
                            </div>
                            <p class="text-sm opacity-90 mb-3"><span id="answered-summary">0</span> dari <span
                                    id="total-summary">0</span> aspek telah dinilai</p>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold mb-1" id="average-score">0</div>
                            <div class="text-xs opacity-90 mb-2">Rata-rata skor</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button (shown only when all questions answered) -->
            <div class="mt-8 text-center hidden" id="submit-container">
                <button type="submit" id="continue-btn"
                    class="py-3 px-8 bg-gradient-to-r from-bangala to-goldspel text-white rounded-lg font-semibold hover:shadow-lg hover:scale-[1.02] transition-all">
                    <i class="fas fa-check mr-2"></i>
                    Simpan Penilaian
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let currentQuestion = 0;
            let questions = [];
            let answeredQuestions = [];

            const progress = document.getElementById('progress-container');
            const summary = document.getElementById('summary-card');
            const progressOffset = progress.offsetTop;
            const summaryOffset = summary.offsetTop;

            window.addEventListener('scroll', function() {
                if (window.scrollY > progressOffset + 20) {
                    progress.classList.add('sticky-top');
                } else {
                    progress.classList.remove('sticky-top');
                }

                if (window.scrollY + window.innerHeight < document.body.scrollHeight - 200) {
                    if (!summary.classList.contains('hidden')) {
                        summary.classList.add('sticky-bottom');
                    }
                } else {
                    summary.classList.remove('sticky-bottom');
                }
            });

            loadSelectOptions('#jabatan', '{{ route('guru.jabatan.target') }}');

            $('#jabatan').on('change', function(e) {
                e.preventDefault();
                const jabatan_id = $(this).val();
                $('#formulir').prop('disabled', false);
                loadSelectOptions('#formulir', `/guru/jabatan/${jabatan_id}/form`);
            });

            $('#formulir').on('change', function(e) {
                e.preventDefault();
                const formId = $(this).val();
                const jabatan_id = $('#jabatan').val();
                $('#guru').prop('disabled', false);
                loadSelectOptions('#guru', `/guru/jabatan/${jabatan_id}/guru/${formId}`);
            });

            $('#formulir').on('change', function(e) {
                e.preventDefault();
                const id = $(this).val();
                fetch(`/guru/form/${id}`)
                    .then(res => res.json())
                    .then(response => {
                        if (response && response.data) {
                            renderFormPenilaian(response.data);
                            initProgressTracking();
                            initWizard();
                        } else {
                            $('#form-penilaian').html(
                                '<p class="text-red-500">Data formulir tidak valid.</p>');
                        }
                    })
                    .catch(() => {
                        $('#form-penilaian').html('<p class="text-red-500">Gagal memuat formulir.</p>');
                    });
            });

            function initWizard() {
                questions = $('.question-container');
                answeredQuestions = Array(questions.length).fill(false);

                // Create indicator dots - sekarang dengan nomor urut
                const indicator = $('#question-indicator');
                indicator.empty();

                for (let i = 0; i < questions.length; i++) {
                    indicator.append(`<div class="indicator-dot" data-index="${i}" data-index="${i + 1}"></div>`);
                }

                // Show first question
                showQuestion(0);

                // Navigation handlers
                $('#next-btn').on('click', function() {
                    if (currentQuestion < questions.length - 1) {
                        showQuestion(currentQuestion + 1);
                    }
                });

                $('#prev-btn').on('click', function() {
                    if (currentQuestion > 0) {
                        showQuestion(currentQuestion - 1);
                    }
                });

                // Dot click handlers
                $('.indicator-dot').on('click', function() {
                    const index = $(this).data('index');
                    showQuestion(index);
                });
            }

            function showQuestion(index) {
                // Hide all questions
                questions.removeClass('active');

                // Show selected question
                $(questions[index]).addClass('active');

                // Update current question
                currentQuestion = index;

                // Update navigation buttons
                $('#prev-btn').toggle(index > 0);

                if (index === questions.length - 1) {
                    $('#next-btn').addClass('hidden');
                    if (answeredQuestions.every(val => val)) {
                        $('#submit-container').removeClass('hidden');
                    }
                } else {
                    $('#next-btn').removeClass('hidden');
                    $('#submit-container').addClass('hidden');
                }

                // Update indicator dots
                $('.indicator-dot').removeClass('current');
                $(`.indicator-dot[data-index="${index}"]`).addClass('current');

                // Scroll to top of question
                $('html, body').animate({
                    scrollTop: $(questions[index]).offset().top - 100
                }, 300);
            }

            function updateAnsweredStatus(index, isAnswered) {
                answeredQuestions[index] = isAnswered;
                const dot = $(`.indicator-dot[data-index="${index}"]`);

                if (isAnswered) {
                    dot.addClass('answered');
                } else {
                    dot.removeClass('answered');
                }

                // If last question is answered, show submit button
                if (currentQuestion === questions.length - 1 && answeredQuestions.every(val => val)) {
                    $('#submit-container').removeClass('hidden');
                }
            }

            function initProgressTracking() {
                function updateProgress() {
                    const totalQuestions = $('.question-container').length;
                    let answeredCount = 0;
                    let totalScore = 0;

                    $('.question-container').each(function(index) {
                        const input = $(this).find(
                            'input[type="radio"]:checked, select[name^="penilaian"], input[type="number"][name^="penilaian"]'
                        );

                        const isAnswered = input.length && input.val() !== '';
                        if (isAnswered) {
                            answeredCount++;
                            updateAnsweredStatus(index, true);

                            // Hitung skor untuk rata-rata
                            const val = parseFloat(input.val());
                            if (!isNaN(val)) {
                                totalScore += val;
                            }
                        } else {
                            updateAnsweredStatus(index, false);
                        }
                    });

                    const progressPercentage = Math.round((answeredCount / totalQuestions) * 100);
                    const averageScore = answeredCount > 0 ? (totalScore / answeredCount).toFixed(1) : 0;

                    // Update UI
                    $('#answered-count').text(answeredCount);
                    $('#total-questions').text(totalQuestions);
                    $('#progress-percentage').text(progressPercentage + '%');
                    $('#progress-bar').css('width', progressPercentage + '%');

                    $('#answered-summary').text(answeredCount);
                    $('#total-summary').text(totalQuestions);
                    $('#average-score').text(averageScore);

                    // Selalu tampilkan summary card setelah form diubah
                    $('#summary-card').removeClass('hidden');
                }

                // Panggil updateProgress saat ada perubahan nilai
                $('body').on('change',
                    'input[type="radio"], select[name^="penilaian"], input[type="number"][name^="penilaian"]',
                    function() {
                        updateProgress();
                    });

                // Inisialisasi pertama kali
                updateProgress();
            }

            $('#save-draft-btn').on('click', function() {
                alert('Draft penilaian berhasil disimpan!');
            });

            $('#penilaian-form').on('submit', function(e) {
                e.preventDefault();

                const url = '{{ route('guru.penilaian.store') }}';
                const method = 'POST';
                let formData = new FormData(this);

                const successCallback = function(res) {
                    successToast(res);
                    window.location.reload();
                }

                const errorCallback = function(err) {
                    errorToast(err);
                }

                ajaxCall(url, method, formData, successCallback, errorCallback);
            });
        });

        function renderFormPenilaian(data) {
            console.log(data, 'renderFormPenilaian');

            $('#keterangan-form-container').removeClass('hidden');
            $('#keterangan-form').html(data.keterangan);

            const container = document.getElementById('form-penilaian');
            container.innerHTML = '';

            if (!data) {
                container.innerHTML = `<p class="text-gray-500">Data penilaian tidak tersedia.</p>`;
                return;
            }

            const tipe_input = data.tipe_penilaian?.tipe_input || 'select';
            const opsi = Array.isArray(data.opsi) ? data.opsi : [];

            let html = `<div class="space-y-6">`;

            // ==== PENILAIAN LANGSUNG ====
            if (Array.isArray(data.penilaian_langsung) && data.penilaian_langsung.length > 0) {
                html += `
                    <div class="border border-gray-200 dark:border-gray-600 rounded-xl p-6 shadow-sm">
                        <h5 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Penilaian Langsung</h5>
                        <div class="space-y-6">
                `;

                data.penilaian_langsung.forEach((penilaian, index) => {
                    html += `
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden question-container">
                            <div class="p-6">
                                <div class="flex items-start space-x-4 mb-4">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-bangala to-goldspel text-white text-sm font-bold flex items-center justify-center shadow-md">
                                        ${index + 1}
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 leading-tight">
                                            ${penilaian.nama}
                                        </h3>
                                        ${penilaian.deskripsi ? `<p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">${penilaian.deskripsi}</p>` : ''}
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    ${renderInputOptions(tipe_input, opsi, penilaian.id)}
                                </div>
                            </div>
                        </div>
                    `;
                });

                html += `</div></div>`;
            }
            // ==== KATEGORI PENILAIAN ====
            else if (Array.isArray(data.kategori) && data.kategori.length > 0) {
                data.kategori.forEach((kategori, kategoriIndex) => {
                    html += `
                        <div class="border border-gray-200 dark:border-gray-600 rounded-xl p-6 shadow-sm">
                            <div class="flex items-start space-x-4 mb-4">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-bangala to-goldspel text-white text-sm font-bold flex items-center justify-center shadow-md">
                                    ${kategoriIndex + 1}
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 leading-tight">
                                        ${kategori.kategori}
                                    </h3>
                                    ${kategori.deskripsi ? `<p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">${kategori.deskripsi}</p>` : ''}
                                </div>
                            </div>
                            <div class="space-y-6">
                    `;

                    // Penilaian di kategori
                    if (Array.isArray(kategori.penilaian) && kategori.penilaian.length > 0) {
                        kategori.penilaian.forEach((penilaian, index) => {
                            html += `
                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden question-container">
                                    <div class="p-6">
                                        <div class="mb-4">
                                            <h4 class="font-medium text-gray-800 dark:text-gray-200 mb-2">${penilaian.nama}</h4>
                                            ${penilaian.deskripsi ? `<p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">${penilaian.deskripsi}</p>` : ''}
                                        </div>
                                        <div class="space-y-3">
                                            ${renderInputOptions(tipe_input, opsi, penilaian.id)}
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                    }

                    // Subkategori
                    if (Array.isArray(kategori.sub_kategori) && kategori.sub_kategori.length > 0) {
                        kategori.sub_kategori.forEach((subKategori, subIndex) => {
                            html += `
                                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6 border border-gray-200 dark:border-gray-600">
                                    <div class="flex items-start space-x-4 mb-4">
                                        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-bangala/80 to-goldspel/80 text-white text-xs font-bold flex items-center justify-center shadow-md">
                                            ${subIndex + 1}
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-800 dark:text-gray-200 mb-2">${subKategori.sub_kategori}</h4>
                                            ${subKategori.deskripsi ? `<p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">${subKategori.deskripsi}</p>` : ''}
                                        </div>
                                    </div>
                                    <div class="space-y-6">
                            `;

                            if (Array.isArray(subKategori.penilaian) && subKategori.penilaian.length > 0) {
                                subKategori.penilaian.forEach((penilaian, itemIndex) => {
                                    html += `
                                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden question-container">
                                            <div class="p-4">
                                                <div class="mb-3">
                                                    <h5 class="font-medium text-gray-800 dark:text-gray-200 mb-1">${penilaian.nama}</h5>
                                                    ${penilaian.deskripsi ? `<p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">${penilaian.deskripsi}</p>` : ''}
                                                </div>
                                                <div class="space-y-3">
                                                    ${renderInputOptions(tipe_input, opsi, penilaian.id)}
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                });
                            }

                            html += `</div></div>`; // end subKategori
                        });
                    }

                    html += `</div></div>`; // end kategori
                });
            } else {
                html += `<p class="text-gray-500">Tidak ada kategori penilaian yang tersedia.</p>`;
            }

            html += `</div>`;
            container.innerHTML = html;
        }

        function renderInputOptions(tipe_input, opsi = [], id = '') {
            switch (tipe_input) {
                case 'radio':
                case 'boolean':
                    if (!opsi.length) opsi = [{
                            value: '4',
                            label: 'Sangat Sering'
                        },
                        {
                            value: '3',
                            label: 'Sering'
                        },
                        {
                            value: '2',
                            label: 'Jarang'
                        },
                        {
                            value: '1',
                            label: 'Sangat Jarang'
                        }
                    ];

                    return opsi.map(opt => `
                <label class="frequency-option flex items-center space-x-4 p-4 rounded-xl border-2 border-gray-100 dark:border-gray-600 hover:border-bangala/30 cursor-pointer transition-all duration-300 group">
                    <input type="radio" name="penilaian[${id}]" value="${opt.value}" class="custom-radio">
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-semibold text-gray-900 dark:text-white group-hover:text-bangala transition-colors">
                                ${opt.label}
                            </span>
                            <div class="frequency-indicator flex space-x-1">
                                    ${[1].map(i => {
                                        const isActive = i < parseInt(opt.value);
                                        const iconClass = isActive ? 'fas' : 'far';
                                        return `<i class="${iconClass} fa-check-circle ${getColorClass(opt.value)} text-base"></i>`;
                                    }).join('')}
                            </div>
                        </div>
                    </div>
                </label>
            `).join('');
                case 'number':
                    return ` <div class = "mt-2 flex items-center space-x-2 text-sm">
            <input type = "number" name = "penilaian[${id}]" min = "0" max = "100" class="w-24 px-3 py-2 bg-gray-100 dark:bg-gray-600 rounded-lg border border-gray-200 dark:border-gray-500 focus:ring-bangala focus:border-bangala" >
        <span class = "text-gray-600 dark:text-gray-400"> / 100</span>
        </div>
        `;
                case 'select':
                default:
                    if (!opsi.length) opsi = [{
                            value: '4',
                            label: 'Sangat Baik'
                        },
                        {
                            value: '3',
                            label: 'Baik'
                        },
                        {
                            value: '2',
                            label: 'Cukup'
                        },
                        {
                            value: '1',
                            label: 'Buruk'
                        }
                    ];
                    return `<select name = "penilaian[${id}]"
        class="mt-2 w-full px-3 py-2 text-sm bg-gray-100 dark:bg-gray-600 rounded-lg border border-gray-200 dark:border-gray-500 focus:outline-none focus:ring-2 focus:ring-bangala" >
        <option value = "" > Pilih opsi </option>
        ${opsi.map(opt => `<option value="${opt.value}">${opt.label}</option>`).join('')}</select>
        `;
            }
        }

        function getColorClass(value) {
            const val = parseInt(value);
            if (val === 4) return 'text-green-500';
            if (val === 3) return 'text-blue-500';
            if (val === 2) return 'text-yellow-500';
            if (val === 1) return 'text-red-500';
            return 'text-gray-400';
        }
    </script>
@endpush
