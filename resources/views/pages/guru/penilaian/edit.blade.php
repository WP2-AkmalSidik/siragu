@extends('layouts.guru')

@section('title', 'Edit Penilaian')
@section('description', 'Edit Form Penilaian')

@push('styles')
    <style>
        .sticky-top {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 30;
            backdrop-filter: blur(8px);
            /* background-image: linear-gradient(to right, #913013, #f59e0b); */
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
        }

        .question-indicator {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            padding: 0.5rem;
            background-color: rgba(229, 231, 235, 0.3);
            border-radius: 9999px;
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
        }

        .indicator-dot.current {
            transform: scale(1.4);
            background-color: #f59e0b;
            box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.3);
        }

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
        <!-- Progress Indicator -->
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

        <!-- Form Header -->
        <form id="penilaian-form" action="{{ route('guru.penilaian.update.save') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="tahun_ajaran" value="{{ $nilais->first()->tahun_ajaran ?? '' }}">
            <input type="hidden" name="semester" value="{{ $nilais->first()->semester ?? '' }}">
            <input type="hidden" name="form_id" value="{{ $nilais->first()->penilaian->form->id ?? '' }}">
            <input type="hidden" name="user_id" value="{{ $nilais->first()->target_id ?? '' }}">

            <div
                class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 mb-6 shadow-sm border border-gray-100 dark:border-gray-600 relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-bangala/10 to-goldspel/10 rounded-full -translate-y-16 translate-x-16">
                </div>
                <div class="relative">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Formulir</label>
                            <div class="p-2 bg-gray-100 dark:bg-gray-600 rounded-lg">
                                <p class="text-gray-800 dark:text-gray-200">
                                    {{ $nilais->first()->penilaian->form->nama ?? '' }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Guru</label>
                            <div class="p-2 bg-gray-100 dark:bg-gray-600 rounded-lg">
                                <p class="text-gray-800 dark:text-gray-200">{{ $nilais->first()->target->nama ?? '' }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tahun
                                Ajaran</label>
                            <div class="p-2 bg-gray-100 dark:bg-gray-600 rounded-lg">
                                <p class="text-gray-800 dark:text-gray-200">{{ $nilais->first()->tahun_ajaran ?? '' }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Semester</label>
                            <div class="p-2 bg-gray-100 dark:bg-gray-600 rounded-lg">
                                <p class="text-gray-800 dark:text-gray-200">{{ ucfirst($nilais->first()->semester ?? '') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    @if ($nilais->first()->penilaian->form->keterangan ?? false)
                        <div id="keterangan-form-container"
                            class="bg-gradient-to-r from-bangala/5 to-goldspel/5 dark:from-bangala/10 dark:to-goldspel/10 rounded-xl p-4 border border-bangala/20 mt-5">
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-bangala/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fas fa-info text-bangala text-xs"></i>
                                </div>
                                <p id="keterangan-form" class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                    {{ $nilais->first()->penilaian->form->keterangan ?? '' }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Question Indicator Dots -->
            <div class="w-full flex justify-center mb-6">
                <div id="question-indicator" class="question-indicator"></div>
            </div>

            <!-- Form Penilaian -->
            <div class="space-y-6" id="form-penilaian">
                @php
                    $groupedNilai = $nilais->groupBy(function ($item) {
                        if ($item->penilaian->kategori_id) {
                            return 'kategori_' . $item->penilaian->kategori_id;
                        } elseif ($item->penilaian->sub_kategori_id) {
                            return 'subkategori_' . $item->penilaian->sub_kategori_id;
                        } else {
                            return 'langsung';
                        }
                    });
                @endphp

                @if ($groupedNilai->has('langsung'))
                    <!-- Penilaian Langsung -->
                    <div class="border border-gray-200 dark:border-gray-600 rounded-xl p-6 shadow-sm">
                        <h5 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Penilaian Langsung</h5>
                        <div class="space-y-6">
                            @foreach ($groupedNilai['langsung'] as $index => $nilai)
                                <div
                                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden question-container {{ $index === 0 ? 'active' : '' }}">
                                    <div class="p-6">
                                        <div class="flex items-start space-x-4 mb-4">
                                            <div
                                                class="w-8 h-8 rounded-full bg-gradient-to-br from-bangala to-goldspel text-white text-sm font-bold flex items-center justify-center shadow-md">
                                                {{ $index + 1 }}
                                            </div>
                                            <div class="flex-1">
                                                <h3
                                                    class="text-lg font-bold text-gray-900 dark:text-white mb-2 leading-tight">
                                                    {{ $nilai->penilaian->nama }}
                                                </h3>
                                                @if ($nilai->penilaian->deskripsi)
                                                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                                        {{ $nilai->penilaian->deskripsi }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="space-y-3">
                                            {!! renderEditInputOptions(
                                                $nilai->penilaian->form->tipe->tipe_input,
                                                $nilai->penilaian->form->tipe->opsi,
                                                $nilai->penilaian->id,
                                                $nilai->nilai,
                                            ) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @foreach ($groupedNilai as $key => $group)
                    @if (str_starts_with($key, 'kategori_'))
                        @php
                            $kategori = $group->first()->penilaian->kategori;
                            $kategoriIndex = substr($key, strlen('kategori_'));
                        @endphp
                        <!-- Kategori Penilaian -->
                        <div class="border border-gray-200 dark:border-gray-600 rounded-xl p-6 shadow-sm">
                            <div class="flex items-start space-x-4 mb-4">
                                <div
                                    class="w-8 h-8 rounded-full bg-gradient-to-br from-bangala to-goldspel text-white text-sm font-bold flex items-center justify-center shadow-md">
                                    {{ $kategoriIndex }}
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 leading-tight">
                                        {{ $kategori->kategori }}
                                    </h3>
                                    @if ($kategori->deskripsi)
                                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                            {{ $kategori->deskripsi }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="space-y-6">
                                @foreach ($group as $index => $nilai)
                                    <div
                                        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden question-container">
                                        <div class="p-6">
                                            <div class="mb-4">
                                                <h4 class="font-medium text-gray-800 dark:text-gray-200 mb-2">
                                                    {{ $nilai->penilaian->nama }}</h4>
                                                @if ($nilai->penilaian->deskripsi)
                                                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                                        {{ $nilai->penilaian->deskripsi }}</p>
                                                @endif
                                            </div>
                                            <div class="space-y-3">
                                                {!! renderEditInputOptions(
                                                    $nilai->penilaian->form->tipe->tipe_input,
                                                    $nilai->penilaian->form->tipe->opsi,
                                                    $nilai->penilaian->id,
                                                    $nilai->nilai,
                                                ) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if (str_starts_with($key, 'subkategori_'))
                        @php
                            $subKategori = $group->first()->penilaian->subKategori;
                            $subIndex = substr($key, strlen('subkategori_'));
                        @endphp
                        <!-- Subkategori Penilaian -->
                        <div
                            class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6 border border-gray-200 dark:border-gray-600">
                            <div class="flex items-start space-x-4 mb-4">
                                <div
                                    class="w-6 h-6 rounded-full bg-gradient-to-br from-bangala/80 to-goldspel/80 text-white text-xs font-bold flex items-center justify-center shadow-md">
                                    {{ $subIndex }}
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-800 dark:text-gray-200 mb-2">
                                        {{ $subKategori->sub_kategori }}</h4>
                                    @if ($subKategori->deskripsi)
                                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                            {{ $subKategori->deskripsi }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="space-y-6">
                                @foreach ($group as $itemIndex => $nilai)
                                    <div
                                        class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden question-container">
                                        <div class="p-4">
                                            <div class="mb-3">
                                                <h5 class="font-medium text-gray-800 dark:text-gray-200 mb-1">
                                                    {{ $nilai->penilaian->nama }}</h5>
                                                @if ($nilai->penilaian->deskripsi)
                                                    <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                                                        {{ $nilai->penilaian->deskripsi }}</p>
                                                @endif
                                            </div>
                                            <div class="space-y-3">
                                                {!! renderEditInputOptions(
                                                    $nilai->penilaian->form->tipe->tipe_input,
                                                    $nilai->penilaian->form->tipe->opsi,
                                                    $nilai->penilaian->id,
                                                    $nilai->nilai,
                                                ) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

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
                class="bg-gradient-to-br from-bangala via-red-900 to-goldspel rounded-2xl p-6 text-white shadow-xl relative overflow-hidden animate-fade-in-up mt-6 sticky bottom-0 z-20">
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

            <!-- Submit Button -->
            <div class="mt-8 text-center" id="submit-container">
                <button type="submit" id="continue-btn"
                    class="py-3 px-8 bg-gradient-to-r from-bangala to-goldspel text-white rounded-lg font-semibold hover:shadow-lg hover:scale-[1.02] transition-all">
                    <i class="fas fa-save mr-2"></i>
                    Update Penilaian
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

            function initWizard() {
                questions = $('.question-container');
                answeredQuestions = Array(questions.length).fill(false);

                // Create indicator dots
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
                } else {
                    $('#next-btn').removeClass('hidden');
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

                    // Selalu tampilkan summary card
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

            initWizard();
            initProgressTracking();

            $('#penilaian-form').on('submit', function(e) {
                e.preventDefault();

                const url = $(this).attr('action');
                const method = 'POST';
                let formData = new FormData(this);

                const successCallback = function(res) {
                    successToast(res);
                    window.location.href = '{{ route('guru.penilaian.index') }}';
                }

                const errorCallback = function(err) {
                    errorToast(err);
                }

                ajaxCall(url, method, formData, successCallback, errorCallback);
            });
        });
    </script>
@endpush

<?php
// Helper function to render input options with existing value
function renderEditInputOptions($tipe_input, $opsi = [], $id = '', $currentValue = '')
{
    switch ($tipe_input) {
        case 'radio':
        case 'boolean':
            if (empty($opsi)) {
                $opsi = [['value' => '4', 'label' => 'Sangat Sering'], ['value' => '3', 'label' => 'Sering'], ['value' => '2', 'label' => 'Jarang'], ['value' => '1', 'label' => 'Sangat Jarang']];
            }

            $html = '';
            foreach ($opsi as $opt) {
                $checked = $currentValue == $opt['value'] ? 'checked' : '';
                $activeClass = $currentValue == $opt['value'] ? 'border-bangala/50 bg-bangala/5' : 'border-gray-100 dark:border-gray-600';
                $textColor = $currentValue == $opt['value'] ? 'text-bangala' : 'text-gray-900 dark:text-white';

                $html .=
                    '
                <label class="frequency-option flex items-center space-x-4 p-4 rounded-xl border-2 ' .
                    $activeClass .
                    ' hover:border-bangala/30 cursor-pointer transition-all duration-300 group">
                    <input type="radio" name="nilai[' .
                    $id .
                    ']" value="' .
                    $opt['value'] .
                    '" class="custom-radio" ' .
                    $checked .
                    '>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-semibold ' .
                    $textColor .
                    ' group-hover:text-bangala transition-colors">
                                ' .
                    $opt['label'] .
                    '
                            </span>
                            <div class="frequency-indicator flex space-x-1">
                                ' .
                    ($currentValue == $opt['value'] ? '<i class="fas fa-check-circle ' . 'getColorClass(' . $opt['value'] . ')' . ' text-base"></i>' : '') .
                    '
                            </div>
                        </div>
                    </div>
                </label>';
            }
            return $html;

        case 'number':
            return '
            <div class="mt-2 flex items-center space-x-2 text-sm">
                <input type="number" name="nilai[' .
                $id .
                ']" min="0" max="100" value="' .
                $currentValue .
                '"
                    class="w-24 px-3 py-2 bg-gray-100 dark:bg-gray-600 rounded-lg border border-gray-200 dark:border-gray-500 focus:ring-bangala focus:border-bangala">
                <span class="text-gray-600 dark:text-gray-400">/ 100</span>
            </div>';

        case 'select':
        default:
            if (empty($opsi)) {
                $opsi = [['value' => '4', 'label' => 'Sangat Baik'], ['value' => '3', 'label' => 'Baik'], ['value' => '2', 'label' => 'Cukup'], ['value' => '1', 'label' => 'Buruk']];
            }

            $options = '<option value="">Pilih opsi</option>';
            foreach ($opsi as $opt) {
                $selected = $currentValue == $opt['value'] ? 'selected' : '';
                $options .= '<option value="' . $opt['value'] . '" ' . $selected . '>' . $opt['label'] . '</option>';
            }

            return '
            <select name="nilai[' .
                $id .
                ']"
                class="mt-2 w-full px-3 py-2 text-sm bg-gray-100 dark:bg-gray-600 rounded-lg border border-gray-200 dark:border-gray-500 focus:outline-none focus:ring-2 focus:ring-bangala">
                ' .
                $options .
                '
            </select>';
    }
}
?>
