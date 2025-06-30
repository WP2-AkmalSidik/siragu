@extends('layouts.admin')
@section('title', 'Formulir Penilaian')
@section('description', 'CRUD Formulir Penilaian Guru')
@section('content')
    <!-- Header Section -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-4 space-y-4 md:space-y-0">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Formulir Penilaian Guru</h3>
            <button onclick="openCreateFormModal()"
                class="bg-bangala hover:bg-bangala/90 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition">
                <i class="fas fa-plus"></i>
                <span>Tambah Formulir</span>
            </button>
        </div>

        <!-- Search & Filter -->
        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
            <div class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" placeholder="Cari formulir..."
                    class="pl-10 pr-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-bangala">
            </div>
            <select
                class="px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                <option>Semua Status</option>
                <option>Aktif</option>
                <option>Draft</option>
                <option>Arsip</option>
            </select>
        </div>
    </div>

    <!-- Form List -->
    <div class="grid gap-6">
        <!-- Form Card 1 -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md dashboard-card">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-4 space-y-2 lg:space-y-0">
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Penilaian Kinerja Guru Semester 1</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Dibuat: 15 Januari 2025 • Status: Aktif</p>
                </div>
                <div class="flex space-x-2">
                    <button onclick="viewForm(1)"
                        class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button onclick="editForm(1)"
                        class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="deleteForm(1)"
                        class="p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded-lg">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>

            <!-- kategori Preview -->
            <div class="space-y-3">
                <div class="border-l-4 border-bangala pl-4">
                    <h5 class="font-medium text-gray-800 dark:text-gray-200">Kategori Perencanaan Pembelajaran</h5>
                    <p class="text-sm text-gray-600 dark:text-gray-400">3 Indikator • 8 Sub-indikator</p>
                </div>
                <div class="border-l-4 border-goldspel pl-4">
                    <h5 class="font-medium text-gray-800 dark:text-gray-200">Kategori Pelaksanaan Pembelajaran</h5>
                    <p class="text-sm text-gray-600 dark:text-gray-400">5 Indikator • 12 Sub-indikator</p>
                </div>
            </div>
        </div>

        <!-- Form Card 2 -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md dashboard-card">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-4 space-y-2 lg:space-y-0">
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Evaluasi Perilaku Mengajar</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Dibuat: 10 Januari 2025 • Status: Draft</p>
                </div>
                <div class="flex space-x-2">
                    <button onclick="viewForm(2)"
                        class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button onclick="editForm(2)"
                        class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="deleteForm(2)"
                        class="p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded-lg">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>

            <!-- kategori Preview -->
            <div class="space-y-3">
                <div class="border-l-4 border-bangala pl-4">
                    <h5 class="font-medium text-gray-800 dark:text-gray-200">Kategori Komunikasi</h5>
                    <p class="text-sm text-gray-600 dark:text-gray-400">2 Indikator • 5 Sub-indikator</p>
                </div>
            </div>
        </div>
    </div>

    @include('pages.admin.formulir.modal')

@endsection
@push('scripts')
    <script>
        let kategoriCounter = 0;
        let subKategoriCounter = 0;
        let penilaianCounter = 0;
        let currentFormId = null;
        let isEditMode = false;

        // Modal Functions
        function openCreateFormModal() {
            document.getElementById('formModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            resetForm();
            isEditMode = false;
            currentFormId = null;
            document.querySelector('#formModal h3').textContent = 'Buat Formulir Penilaian';
        }

        function openEditFormModal(formId) {
            document.getElementById('formModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            resetForm();
            isEditMode = true;
            currentFormId = formId;
            document.querySelector('#formModal h3').textContent = 'Edit Formulir Penilaian';

            // Load form data (example - replace with actual data fetching)
            const sampleData = {
                1: {
                    nama: 'Penilaian Kinerja Guru Semester 1',
                    status: 'active',
                    deskripsi: 'Formulir penilaian kinerja guru untuk semester 1 tahun ajaran 2024/2025',
                    kategori: [{
                        nama: 'Perencanaan Pembelajaran',
                        deskripsi: 'Penilaian terhadap kemampuan guru dalam merencanakan pembelajaran',
                        sub_kategori: [{
                            nama: 'Kelengkapan RPP',
                            deskripsi: 'Kelengkapan Rencana Pelaksanaan Pembelajaran',
                            penilaian: [{
                                    nama: 'RPP sesuai dengan kurikulum',
                                    type: 'boolean'
                                },
                                {
                                    nama: 'Kelengkapan komponen RPP',
                                    type: 'score'
                                }
                            ]
                        }]
                    }]
                }
            };

            const formData = sampleData[formId];
            if (formData) {
                document.getElementById('formName').value = formData.name;
                document.getElementById('formStatus').value = formData.status;
                document.getElementById('formDescription').value = formData.deskripsi;

                formData.kategori.forEach(kategori => {
                    addCategory();
                    const lastCategory = document.querySelector(`[data-kategori-id="${kategoriCounter}"]`);

                    lastCategory.querySelector('input[name^="kategori"]').value = kategori.name;
                    lastCategory.querySelector('textarea[name^="kategori"]').value = kategori.deskripsi;

                    kategori.sub_kategori.forEach(sub_kategori => {
                        addSubKategori(kategoriCounter);
                        const lastIndicator = document.querySelector(
                            `[data-sub-kategori-id="${subKategoriCounter}"]`);

                        lastIndicator.querySelector('input[name^="kategori"]').value = sub_kategori.name;
                        lastIndicator.querySelector('textarea[name^="kategori"]').value = sub_kategori
                            .deskripsi || '';

                        sub_kategori.penilaian.forEach(penilaian => {
                            addPenilaian(kategoriCounter, subKategoriCounter);
                            const lastSubIndicator = document.querySelector(
                                `[data-penilaian-id="${penilaianCounter}"]`);

                            lastSubIndicator.querySelector('input[name^="kategori"]').value =
                                penilaian.name;
                            const typeSelect = lastSubIndicator.querySelector(
                                'select[name^="kategori"]');
                            typeSelect.value = penilaian.type;
                            updateInputType(typeSelect, penilaianCounter);
                        });
                    });
                });
            }
        }

        function closeFormModal() {
            document.getElementById('formModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function closeViewModal() {
            document.getElementById('viewModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Form Functions
        function resetForm() {
            document.getElementById('formData').reset();
            document.getElementById('kategoriContainer').innerHTML = '';
            kategoriCounter = 0;
            subKategoriCounter = 0;
            penilaianCounter = 0;
        }

        function addCategory() {
            const container = document.getElementById('kategoriContainer');
            const kategoriId = ++kategoriCounter;

            const categoryHtml = `
                <div class="kategori-item border border-gray-200 dark:border-gray-600 rounded-xl p-4" data-kategori-id="${kategoriId}">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Kategori</label>
                            <input type="text" name="kategori[${kategoriId}][nama]"
                                class="w-full px-3 py-2 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600">
                        </div>
                        <button type="button" onclick="removeCategory(${kategoriId})"
                            class="ml-3 p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded-lg">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi Kategori</label>
                        <textarea name="kategori[${kategoriId}][deskripsi]" rows="2"
                            class="w-full px-3 py-2 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600"></textarea>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg p-3 border border-gray-100 dark:border-gray-700">
                        <div class="flex justify-between items-center mb-3">
                            <h5 class="font-medium text-gray-800 dark:text-gray-200">Sub Kategori</h5>
                            <button type="button" onclick="addSubKategori(${kategoriId})"
                                class="bg-goldspel hover:bg-goldspel/90 text-white px-2 py-1 rounded text-sm flex items-center space-x-1">
                                <i class="fas fa-plus text-xs"></i>
                                <span>Tambah Sub Kategori</span>
                            </button>
                        </div>
                        <div class="sub_kategori-container-${kategoriId} space-y-3">
                            <!-- sub_kategori will be added here -->
                        </div>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', categoryHtml);
        }

        function removeCategory(kategoriId) {
            const elementKategori = document.querySelector(`[data-kategori-id="${kategoriId}"]`);
            if (elementKategori) {
                if (confirm('Hapus kategori ini? Semua Sub-Kategori dan Penilaian di dalamnya juga akan dihapus.')) {
                    elementKategori.remove();
                }
            }
        }

        function addSubKategori(kategoriId) {
            const container = document.querySelector(`.sub_kategori-container-${kategoriId}`);
            const subKategoriId = ++subKategoriCounter;

            const indicatorHtml = `
                <div class="sub_kategori-item bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3" data-sub-kategori-id="${subKategoriId}">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex-1">
                            <input type="text" name="kategori[${kategoriId}][sub_kategori][${subKategoriId}][nama]"
                                placeholder="Nama Sub Kategori"
                                class="w-full px-3 py-2 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600 text-sm">
                        </div>
                        <button type="button" onclick="removeIndicator(${subKategoriId})"
                            class="ml-2 p-1 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded">
                            <i class="fas fa-trash text-xs"></i>
                        </button>
                    </div>

                    <div class="mb-3">
                        <textarea name="kategori[${kategoriId}][sub_kategori][${subKategoriId}][deskripsi]"
                            placeholder="Deskripsi Sub Kategori" rows="2"
                            class="w-full px-3 py-2 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600 text-sm"></textarea>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg p-2 border border-gray-100 dark:border-gray-700">
                        <div class="flex justify-between items-center mb-2">
                            <h6 class="text-sm font-medium text-gray-700 dark:text-gray-300">Penilaian</h6>
                            <button type="button" onclick="addSubIndicator(${kategoriId}, ${subKategoriId})"
                                class="bg-bangala hover:bg-bangala/90 text-white px-2 py-1 rounded text-xs flex items-center space-x-1">
                                <i class="fas fa-plus text-xs"></i>
                                <span>Tambah Penilaian</span>
                            </button>
                        </div>
                        <div class="penilaian-container-${subKategoriId} space-y-2">
                            <!-- penilaian will be added here -->
                        </div>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', indicatorHtml);
        }

        function removeIndicator(subKategoriId) {
            const elementSubKategori = document.querySelector(`[data-sub-kategori-id="${subKategoriId}"]`);
            if (elementSubKategori) {
                if (confirm('Hapus indikator ini? Semua sub-indikator di dalamnya juga akan dihapus.')) {
                    elementSubKategori.remove();
                }
            }
        }

        function addSubIndicator(kategoriId, subKategoriId) {
            const container = document.querySelector(`.penilaian-container-${subKategoriId}`);
            const penilaianId = ++penilaianCounter;

            const subIndicatorHtml = `
                <div class="penilaian-item bg-gray-100 dark:bg-gray-600 rounded p-2" data-penilaian-id="${penilaianId}">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex-1">
                            <input type="text" name="kategori[${kategoriId}][sub_kategori][${penilaianId}][penilaian][${penilaianId}][nama]"
                                placeholder="Nama Penilaian"
                                class="w-full px-2 py-1 bg-white dark:bg-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600 text-sm">
                        </div>
                        <button type="button" onclick="removeSubIndicator(${penilaianId})"
                            class="ml-2 p-1 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded">
                            <i class="fas fa-trash text-xs"></i>
                        </button>
                    </div>

                    <div class="mb-2">
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Tipe Penilaian</label>
                        <select name="kategori[${kategoriId}][sub_kategori][${penilaianId}][penilaian][${penilaianId}][type]"
                            onchange="updateInputType(this, ${penilaianId})"
                            class="w-full px-2 py-1 bg-white dark:bg-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600 text-sm">
                            <option value="">Pilih Tipe Penilaian</option>
                            <option value="boolean">Terlaksana/Tidak Terlaksana</option>
                            <option value="frequency">Frekuensi Perilaku (1-4)</option>
                            <option value="score">Penilaian Kinerja (1-100)</option>
                        </select>
                    </div>

                    <div id="preview-${penilaianId}" class="mt-2 p-2 bg-white dark:bg-gray-700 rounded border text-xs">
                        <span class="text-gray-500 dark:text-gray-400">Pilih tipe penilaian untuk melihat preview</span>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', subIndicatorHtml);
        }

        function removeSubIndicator(penilaianId) {
            const elementPenilaian = document.querySelector(`[data-penilaian-id="${penilaianId}"]`);
            if (elementPenilaian) {
                elementPenilaian.remove();
            }
        }

        function updateInputType(select, penilaianId) {
            const previewContainer = document.getElementById(`preview-${penilaianId}`);
            const type = select.value;

            let previewHtml = '';

            switch (type) {
                case 'boolean':
                    previewHtml = `
                        <div class="space-y-1">
                            <p class="font-medium text-gray-700 dark:text-gray-300">Preview:</p>
                            <div class="flex space-x-4">
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="preview_boolean_${penilaianId}" class="custom-radio">
                                    <span>Terlaksana</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="preview_boolean_${penilaianId}" class="custom-radio">
                                    <span>Tidak Terlaksana</span>
                                </label>
                            </div>
                        </div>
                    `;
                    break;
                case 'frequency':
                    previewHtml = `
                        <div class="space-y-1">
                            <p class="font-medium text-gray-700 dark:text-gray-300">Preview:</p>
                            <div class="grid grid-cols-2 gap-2">
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="preview_freq_${penilaianId}" class="custom-radio">
                                    <span>1 - Sangat Jarang</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="preview_freq_${penilaianId}" class="custom-radio">
                                    <span>2 - Jarang</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="preview_freq_${penilaianId}" class="custom-radio">
                                    <span>3 - Sering</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="preview_freq_${penilaianId}" class="custom-radio">
                                    <span>4 - Sangat Sering</span>
                                </label>
                            </div>
                        </div>
                    `;
                    break;
                case 'score':
                    previewHtml = `
                        <div class="space-y-1">
                            <p class="font-medium text-gray-700 dark:text-gray-300">Preview:</p>
                            <div class="flex items-center space-x-2">
                                <input type="number" min="1" max="100" placeholder="1-100"
                                    class="w-20 px-2 py-1 bg-gray-100 dark:bg-gray-600 rounded border focus:outline-none focus:ring-2 focus:ring-bangala">
                                <span class="text-gray-600 dark:text-gray-400">/ 100</span>
                            </div>
                        </div>
                    `;
                    break;
                default:
                    previewHtml =
                        '<span class="text-gray-500 dark:text-gray-400">Pilih tipe penilaian untuk melihat preview</span>';
            }

            previewContainer.innerHTML = previewHtml;
        }

        // View Functions
        function viewForm(formId) {
            const modal = document.getElementById('viewModal');
            const content = document.getElementById('viewContent');

            // Sample data - replace with actual data fetching
            const sampleData = {
                1: {
                    nama: 'Penilaian Kinerja Guru Semester 1',
                    status: 'Aktif',
                    deskripsi: 'Formulir penilaian kinerja guru untuk semester 1 tahun ajaran 2024/2025',
                    created_at: '15 Januari 2025',
                    kategori: [{
                            nama: 'Perencanaan Pembelajaran',
                            deskripsi: 'Penilaian terhadap kemampuan guru dalam merencanakan pembelajaran',
                            sub_kategori: [{
                                    nama: 'Kelengkapan RPP',
                                    deskripsi: 'Kelengkapan Rencana Pelaksanaan Pembelajaran',
                                    penilaian: [{
                                            nama: 'RPP sesuai dengan kurikulum',
                                            type: 'boolean'
                                        },
                                        {
                                            nama: 'Kelengkapan komponen RPP',
                                            type: 'score'
                                        }
                                    ]
                                },
                                {
                                    nama: 'Pemilihan Metode Pembelajaran',
                                    deskripsi: 'Kesesuaian metode pembelajaran dengan materi',
                                    penilaian: [{
                                            nama: 'Metode sesuai dengan karakteristik siswa',
                                            type: 'frequency'
                                        },
                                        {
                                            nama: 'Metode mendorong partisipasi aktif siswa',
                                            type: 'frequency'
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            nama: 'Pelaksanaan Pembelajaran',
                            deskripsi: 'Penilaian terhadap pelaksanaan pembelajaran di kelas',
                            sub_kategori: [{
                                nama: 'Pengelolaan Kelas',
                                deskripsi: 'Kemampuan guru dalam mengelola kelas',
                                penilaian: [{
                                        nama: 'Kelas kondusif untuk pembelajaran',
                                        type: 'frequency'
                                    },
                                    {
                                        nama: 'Disiplin waktu dalam pembelajaran',
                                        type: 'boolean'
                                    }
                                ]
                            }]
                        }
                    ]
                },
                2: {
                    nama: 'Evaluasi Perilaku Mengajar',
                    status: 'Draft',
                    deskripsi: 'Formulir evaluasi perilaku mengajar guru dalam interaksi dengan siswa',
                    created_at: '10 Januari 2025',
                    kategori: [{
                        nama: 'Komunikasi',
                        deskripsi: 'Kemampuan guru dalam berkomunikasi dengan siswa',
                        sub_kategori: [{
                            nama: 'Kejelasan Penyampaian',
                            deskripsi: 'Kejelasan guru dalam menyampaikan materi',
                            penilaian: [{
                                    nama: 'Bahasa yang digunakan mudah dipahami',
                                    type: 'frequency'
                                },
                                {
                                    nama: 'Volume suara jelas terdengar',
                                    type: 'boolean'
                                }
                            ]
                        }]
                    }]
                }
            };

            const data = sampleData[formId];
            if (data) {
                let html = `
                    <div class="space-y-6">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">${data.name}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">${data.deskripsi}</p>
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 ${data.status === 'Aktif' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200'} rounded-full text-sm">${data.status}</span>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Dibuat: ${data.created_at}</p>
                            </div>
                        </div>
                `;

                data.kategori.forEach(kategori => {
                    html += `
                        <div class="border border-gray-200 dark:border-gray-600 rounded-xl p-4">
                            <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">${kategori.name}</h5>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">${kategori.deskripsi}</p>
                    `;

                    kategori.sub_kategori.forEach(sub_kategori => {
                        html += `
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 mb-3">
                                <h6 class="font-medium text-gray-700 dark:text-gray-300 mb-2">${sub_kategori.name}</h6>
                                ${sub_kategori.deskripsi ? `<p class="text-sm text-gray-600 dark:text-gray-400 mb-3">${sub_kategori.deskripsi}</p>` : ''}
                        `;

                        sub_kategori.penilaian.forEach(penilaian => {
                            let typeBadge = '';
                            switch (penilaian.type) {
                                case 'boolean':
                                    typeBadge =
                                        'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200';
                                    break;
                                case 'frequency':
                                    typeBadge =
                                        'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
                                    break;
                                case 'score':
                                    typeBadge =
                                        'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200';
                                    break;
                                default:
                                    typeBadge =
                                        'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                            }

                            html += `
                                <div class="bg-white dark:bg-gray-800 rounded p-2 mb-2 border border-gray-100 dark:border-gray-700">
                                    <div class="flex justify-between items-start">
                                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">${penilaian.name}</p>
                                        <span class="px-2 py-1 ${typeBadge} rounded-full text-xs">${getTypeLabel(penilaian.type)}</span>
                                    </div>
                                    ${renderPreview(penilaian.type)}
                                </div>
                            `;
                        });

                        html += '</div>';
                    });

                    html += '</div>';
                });

                html += '</div>';
                content.innerHTML = html;
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function getTypeLabel(type) {
            switch (type) {
                case 'boolean':
                    return 'Ya/Tidak';
                case 'frequency':
                    return 'Frekuensi';
                case 'score':
                    return 'Skor';
                default:
                    return type;
            }
        }

        function renderPreview(type) {
            switch (type) {
                case 'boolean':
                    return `
                        <div class="mt-2 flex space-x-4">
                            <label class="flex items-center space-x-2 text-xs">
                                <input type="radio" disabled class="custom-radio">
                                <span>Terlaksana</span>
                            </label>
                            <label class="flex items-center space-x-2 text-xs">
                                <input type="radio" disabled class="custom-radio">
                                <span>Tidak Terlaksana</span>
                            </label>
                        </div>
                    `;
                case 'frequency':
                    return `
                        <div class="mt-2 grid grid-cols-2 gap-2 text-xs">
                            <label class="flex items-center space-x-2">
                                <input type="radio" disabled class="custom-radio">
                                <span>1 - Sangat Jarang</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" disabled class="custom-radio">
                                <span>2 - Jarang</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" disabled class="custom-radio">
                                <span>3 - Sering</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" disabled class="custom-radio">
                                <span>4 - Sangat Sering</span>
                            </label>
                        </div>
                    `;
                case 'score':
                    return `
                        <div class="mt-2 flex items-center space-x-2 text-xs">
                            <input type="number" min="1" max="100" disabled
                                class="w-20 px-2 py-1 bg-gray-100 dark:bg-gray-600 rounded border">
                            <span class="text-gray-600 dark:text-gray-400">/ 100</span>
                        </div>
                    `;
                default:
                    return '';
            }
        }

        function editForm(formId) {
            openEditFormModal(formId);
        }

        function deleteForm(formId) {
            currentFormId = formId;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function confirmDelete() {
            // Here you would typically make an AJAX call to delete the form
            console.log('Deleting form with ID:', currentFormId);

            // Show success message
            alert('Formulir berhasil dihapus');

            // Close modal and refresh the list (in a real app, you would update the UI)
            closeDeleteModal();
            // In a real app, you would remove the deleted form from the list or refresh the page
        }

        function saveForm() {
            // Here you would typically collect the form data and send it to the server
            const formData = {
                nama: document.getElementById('formName').value,
                status: document.getElementById('formStatus').value,
                deskripsi: document.getElementById('formDescription').value,
                kategori: []
            };

            // Collect kategori data
            const elementKategoris = document.querySelectorAll('.kategori-item');
            elementKategoris.forEach(elementKategori => {
                const kategoriId = elementKategori.dataset.kategoriId;
                const kategori = {
                    nama: elementKategori.querySelector(`input[name="kategori[${kategoriId}][nama]"]`).value,
                    description: elementKategori.querySelector(
                        `textarea[name="kategori[${kategoriId}][deskripsi]"]`).value,
                    sub_kategori: []
                };

                // Collect sub_kategori data
                const elementSubKategoris = elementKategori.querySelectorAll('.sub_kategori-item');
                elementSubKategoris.forEach(elementSubKategori => {
                    const subKategoriId = elementSubKategori.dataset.subKategoriId;
                    const sub_kategori = {
                        nama: elementSubKategori.querySelector(
                            `input[name="kategori[${kategoriId}][sub_kategori][${subKategoriId}][nama]"]`
                        ).value,
                        description: elementSubKategori.querySelector(
                            `textarea[name="kategori[${kategoriId}][sub_kategori][${subKategoriId}][deskripsi]"]`
                        ).value || '',
                        penilaian: []
                    };

                    // Collect penilaian data
                    const elementPenilaians = elementSubKategori.querySelectorAll('.penilaian-item');
                    elementPenilaians.forEach(elementPenilaian => {
                        const penilaianId = elementPenilaian.dataset.penilaianId;
                        const penilaian = {
                            nama: elementPenilaian.querySelector(
                                `input[name="kategori[${kategoriId}][sub_kategori][${subKategoriId}][penilaian][${penilaianId}][nama]"]`
                            ).value,
                            type: elementPenilaian.querySelector(
                                `select[name="kategori[${kategoriId}][sub_kategori][${subKategoriId}][penilaian][${penilaianId}][type]"]`
                            ).value
                        };
                        sub_kategori.penilaian.push(penilaian);
                    });

                    kategori.sub_kategori.push(sub_kategori);
                });

                formData.kategori.push(kategori);
            });

            const url = '{{ route('formulir.store') }}';

            const method = 'POST';

            const successCallback = function(response) {
                successToast(response, '{{ route('formulir.index') }}')
                console.log(response)
            }

            const errorCallback = function(error) {
                errorToast(error)
                console.log(error)
            }

            ajaxCall(url, method, formData, successCallback, errorCallback);

            // Close modal and reset form
            closeFormModal();
            resetForm();

            // In a real app, you would update the form list or refresh the page
        }

        $(document).ready(function() {
            

        })
    </script>
@endpush
