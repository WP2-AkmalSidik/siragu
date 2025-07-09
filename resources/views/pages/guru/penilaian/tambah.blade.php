@extends('layouts.guru')

@section('title', 'Penilaian')
@section('description', 'Form Penilaian')

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md">
        <!-- Minimalist Progress Indicator -->
        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-3 mb-6 shadow-sm border border-gray-100 dark:border-gray-600">
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
                                class="block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala"></select>
                        </div>

                        <div>
                            <label for="guru"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Guru</label>
                            <select id="guru" name="user_id"
                                class="block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala"></select>
                        </div>

                        <div>
                            <label for="formulir"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Formulir</label>
                            <select id="formulir" name="form_id"
                                class="block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala"></select>
                        </div>

                        <div>
                            <label for="tahun_ajaran"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tahun Ajaran</label>
                            <select id="tahun_ajaran" name="tahun_ajaran"
                                class="block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala">
                                @foreach (tahunAjaranTerakhir() as $tahun)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="semester"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Semester</label>
                            <select id="semester" name="semester"
                                class="block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala">
                                <option value="genap">Genap</option>
                                <option value="ganjil">Ganjil</option>
                            </select>
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-r from-bangala/5 to-goldspel/5 dark:from-bangala/10 dark:to-goldspel/10 rounded-xl p-4 border border-bangala/20 mt-4">
                        <div class="flex items-start space-x-3">
                            <div
                                class="w-6 h-6 rounded-full bg-bangala/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-info text-bangala text-xs"></i>
                            </div>
                            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                Berikan penilaian yang <span class="font-semibold text-bangala">objektif</span> dan
                                <span class="font-semibold text-bangala">konstruktif</span> berdasarkan observasi langsung
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Penilaian -->
            <div class="space-y-6" id="form-penilaian"></div>

            <!-- Summary Card -->
            <div id="summary-card"
                class="bg-gradient-to-br from-bangala via-red-900 to-goldspel rounded-2xl p-6 text-white shadow-xl relative overflow-hidden animate-fade-in-up hidden mt-6">
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

            <!-- Action Buttons -->
            <div class="mt-8 flex space-x-3">
                <button type="button" id="save-draft-btn"
                    class="flex-1 py-3 px-6 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-300">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Draft
                </button>
                <button type="submit" id="continue-btn" disabled
                    class="flex-1 py-3 px-6 bg-gradient-to-r from-bangala/50 to-goldspel/50 text-white rounded-lg font-semibold transition-all duration-300 cursor-not-allowed">
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
            loadSelectOptions('#jabatan', '{{ route('guru.jabatan.target') }}');

            // when jabatan changes, load guru options
            $('#jabatan').on('change', function(e) {
                e.preventDefault();
                const jabatan_id = $(this).val();
                loadSelectOptions('#formulir', `/guru/jabatan/${jabatan_id}/form`);
            });

            $('#formulir').on('change', function(e) {
                e.preventDefault();

                const formId = $(this).val();
                const jabatan_id = $('#jabatan').val();

                loadSelectOptions('#guru', `/guru/jabatan/${jabatan_id}/guru/${formId}`);
            })

            // when formulir changes, load and render penilaian form
            $('#formulir').on('change', function(e) {
                e.preventDefault();
                const id = $(this).val();
                fetch(`/guru/form/${id}`)
                    .then(res => res.json())
                    .then(response => {
                        if (response && response.data) {
                            renderFormPenilaian(response.data);
                            initProgressTracking();
                        } else {
                            $('#form-penilaian').html(
                                '<p class="text-red-500">Data formulir tidak valid.</p>');
                        }
                    })
                    .catch(() => {
                        $('#form-penilaian').html('<p class="text-red-500">Gagal memuat formulir.</p>');
                    });
            });

            // Initialize progress tracking
            function initProgressTracking() {
                // Function to update progress
                function updateProgress() {
                    const totalQuestions = $('.question-container').length;
                    const answeredQuestions = $('input[type="radio"]:checked').length;
                    const progressPercentage = Math.round((answeredQuestions / totalQuestions) * 100);
                    const averageScore = calculateAverageScore();

                    // Update progress indicators
                    $('#answered-count').text(answeredQuestions);
                    $('#total-questions').text(totalQuestions);
                    $('#progress-percentage').text(progressPercentage + '%');
                    $('#progress-bar').css('width', progressPercentage + '%');

                    // Update summary card
                    $('#answered-summary').text(answeredQuestions);
                    $('#total-summary').text(totalQuestions);
                    $('#average-score').text(averageScore.toFixed(1));

                    // Show/hide summary card
                    if (answeredQuestions > 0) {
                        $('#summary-card').removeClass('hidden');
                    } else {
                        $('#summary-card').addClass('hidden');
                    }

                    // Enable/disable continue button
                    if (answeredQuestions === totalQuestions) {
                        $('#continue-btn').prop('disabled', false);
                        $('#continue-btn').removeClass('from-bangala/50 to-goldspel/50 cursor-not-allowed');
                        $('#continue-btn').addClass('from-bangala to-goldspel hover:shadow-lg hover:scale-[1.02]');
                    } else {
                        $('#continue-btn').prop('disabled', true);
                        $('#continue-btn').addClass('from-bangala/50 to-goldspel/50 cursor-not-allowed');
                        $('#continue-btn').removeClass(
                            'from-bangala to-goldspel hover:shadow-lg hover:scale-[1.02]');
                    }
                }

                // Function to calculate average score
                function calculateAverageScore() {
                    const checkedRadios = $('input[type="radio"]:checked');
                    if (checkedRadios.length === 0) return 0;

                    let totalScore = 0;
                    checkedRadios.each(function() {
                        totalScore += parseInt($(this).val());
                    });

                    return totalScore / checkedRadios.length;
                }

                // Add interactive feedback for radio buttons
                $('body').on('change', 'input[type="radio"]', function() {
                    // Add selection state
                    $(`input[name="${this.name}"]`).closest('label').removeClass(
                        'border-bangala dark:border-goldspel bg-bangala/5 dark:bg-goldspel/5');
                    $(this).closest('label').addClass(
                        'border-bangala dark:border-goldspel bg-bangala/5 dark:bg-goldspel/5');

                    // Update progress
                    updateProgress();
                });

                // Initialize progress
                updateProgress();
            }

            // Save draft button
            $('#save-draft-btn').on('click', function() {
                alert('Draft penilaian berhasil disimpan!');
                // Add your save draft logic here
            });

            // Form submission
            $('#penilaian-form').on('submit', function(e) {
                e.preventDefault();

                const url = '{{ route('admin.pengisi.store') }}';
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
                    <div class="border border-gray-200 dark:border-gray-600 rounded-xl p-6 shadow-sm question-container">
                        <h5 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Penilaian Langsung</h5>
                        <div class="space-y-6">
                `;

                data.penilaian_langsung.forEach((penilaian, index) => {
                    html += `
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
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
                        <div class="border border-gray-200 dark:border-gray-600 rounded-xl p-6 shadow-sm question-container">
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
                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
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
                                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
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
                case 'boolean':
                case 'radio':
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
                                    <span class="font-semibold text-gray-900 dark:text-white group-hover:text-bangala transition-colors">${opt.label}</span>
                                    <div class="frequency-indicator flex space-x-1">
                                        ${Array.from({length: 4}).map((_, i) =>
                                            ` < i class = "${i < parseInt(opt.value) ? 'fas' : 'far'} fa-check-circle
                        $ {
                            getColorClass(opt.value, i)
                        }
                        text - base "></i>`
                ).join('')
        } <
        /div> < /
        div > <
            /div> < /
            label >
            `).join('');

                        case 'number':
                            return ` <
            div class = "mt-2 flex items-center space-x-2 text-sm" >
            <
            input type = "number"
        name = "penilaian[${id}]"
        min = "0"
        max = "100"
        class =
        "w-24 px-3 py-2 bg-gray-100 dark:bg-gray-600 rounded-lg border border-gray-200 dark:border-gray-500 focus:ring-bangala focus:border-bangala" >
        <
        span class = "text-gray-600 dark:text-gray-400" > / 100</span >
        <
        /div>
        `;

                        case 'select':
                        default:
                            if (!opsi.length) opsi = [
                                { value: '4', label: 'Sangat Baik' },
                                { value: '3', label: 'Baik' },
                                { value: '2', label: 'Cukup' },
                                { value: '1', label: 'Buruk' }
                            ];
                            return `<
        select name = "penilaian[${id}]"
        class="mt-2 w-full px-3 py-2 text-sm bg-gray-100 dark:bg-gray-600 rounded-lg border border-gray-200 dark:border-gray-500 focus:outline-none focus:ring-2 focus:ring-bangala" >
        <option value = "" > Pilih opsi < /option>
        ${opsi.map(opt => `<option value="${opt.value}">${opt.label}</option>`).join('')}</select>
        `;
                    }
                }

                function getColorClass(value, index) {
                    const val = parseInt(value);
                    if (val === 4) return 'text-green-500';
                    if (val === 3) return 'text-blue-500';
                    if (val === 2) return 'text-yellow-500';
                    if (val === 1) return 'text-red-500';
                    return 'text-gray-300 dark:text-gray-500';
                }
    </script>
@endpush
