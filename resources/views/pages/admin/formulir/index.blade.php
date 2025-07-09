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
                <input type="text" placeholder="Cari formulir..." id="search"
                    class="pl-10 pr-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-bangala">
            </div>
            {{-- <select
                class="px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                <option>Semua Status</option>
                <option>Aktif</option>
                <option>Draft</option>
                <option>Arsip</option>
            </select> --}}
        </div>
    </div>

    <!-- Form List -->
    <div class="grid gap-6" id="data-form">

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

        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Remove active class from all tabs
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('border-bangala', 'text-bangala');
                button.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400');
            });

            // Show selected tab content
            document.getElementById(`content-${tabName}`).classList.remove('hidden');

            // Add active class to selected tab
            const activeTab = document.getElementById(`tab-${tabName}`);
            activeTab.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400');
            activeTab.classList.add('border-bangala', 'text-bangala');
        }

        // Initialize default tab
        document.addEventListener('DOMContentLoaded', function() {
            switchTab('kategori');
        });

        // Modal Functions
        function openCreateFormModal() {
            document.getElementById('formModal').classList.remove('hidden');
            loadSelectOptions('#tipe-penilaian', '{{ route('admin.tipe-penilaian.index') }}');
            loadSelectOptions('#pengisi', '{{ route('admin.jabatan.index') }}');
            loadSelectOptions('#target', '{{ route('admin.jabatan.index') }}');
            document.body.style.overflow = 'hidden';
            resetForm(); // Fungsi yang sudah diperbaiki di atas
            isEditMode = false;
            currentFormId = null;
            document.querySelector('#formModal h3').textContent = 'Buat Formulir Penilaian';
        }

        async function openEditFormModal(formId) {
            const modal = document.getElementById('formModal');
            if (!modal) {
                console.error('Modal element not found');
                return;
            }

            // Reset form and set edit mode
            resetForm();
            isEditMode = true;
            currentFormId = formId;

            // Update modal title
            document.querySelector('#formModal h3').textContent = 'Edit Formulir Penilaian';

            // Show modal
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            try {
                // Fetch form data
                const response = await fetch(`/admin/formulir/${formId}/edit`);
                if (!response.ok) throw new Error('Gagal mengambil data formulir');

                const result = await response.json();
                if (!result.success) throw new Error(result.message || 'Data tidak valid');

                const formData = result.data;

                console.log(formData);

                // Fill basic form data
                document.getElementById('formName').value = formData.nama || '';
                document.getElementById('formDescription').value = formData.keterangan || '';

                // Load tipe penilaian options
                await loadSelectOptions('#tipe-penilaian', '{{ route('admin.tipe-penilaian.index') }}', formData
                    .penilaian_tipe_id);

                loadSelectOptions('#pengisi', '{{ route('admin.jabatan.index') }}', formData.pengisi)
                loadSelectOptions('#target', '{{ route('admin.jabatan.index') }}', formData.target)

                // Determine which tab should be active
                let activeTab = 'kategori'; // Default to kategori tab

                // Check if there are direct penilaian (without kategori)
                if (formData.penilaian_langsung && formData.penilaian_langsung.length > 0) {
                    // If there are direct penilaian and no kategori, switch to direct tab
                    if (!formData.kategori || formData.kategori.length === 0) {
                        activeTab = 'direct';
                    }
                }

                // Switch to the appropriate tab
                switchTab(activeTab);

                // Load direct penilaian (without kategori)
                if (formData.penilaian_langsung && formData.penilaian_langsung.length > 0) {
                    formData.penilaian_langsung.forEach(penilaian => {
                        addDirectPenilaian();
                        const lastPenilaian = document.querySelector(
                            `[data-direct-penilaian-id="${penilaianCounter}"]`);
                        if (lastPenilaian) {
                            const input = lastPenilaian.querySelector('input[name^="penilaian"]');
                            if (input) input.value = penilaian.nama || '';
                        }
                    });
                }

                // Load kategori data if exists
                if (formData.kategori && formData.kategori.length > 0) {
                    formData.kategori.forEach(kategori => {
                        addCategory();
                        const lastCategory = document.querySelector(`[data-kategori-id="${kategoriCounter}"]`);
                        if (lastCategory) {
                            // Fill kategori name
                            const namaInput = lastCategory.querySelector(
                                'input[name^="kategori"][name$="[nama]"]');
                            if (namaInput) namaInput.value = kategori.kategori || '';

                            // Fill kategori description if exists
                            const deskripsiTextarea = lastCategory.querySelector(
                                'textarea[name^="kategori"][name$="[deskripsi]"]');
                            if (deskripsiTextarea) deskripsiTextarea.value = kategori.deskripsi || '';

                            // Load penilaian langsung di kategori
                            if (kategori.penilaian && kategori.penilaian.length > 0) {
                                kategori.penilaian.forEach(penilaian => {
                                    addKategoriPenilaian(kategoriCounter);
                                    const lastPenilaian = document.querySelector(
                                        `[data-kategori-penilaian-id="${penilaianCounter}"]`);
                                    if (lastPenilaian) {
                                        const input = lastPenilaian.querySelector(
                                            'input[name^="kategori"]');
                                        if (input) input.value = penilaian.nama || '';
                                    }
                                });
                            }

                            // Load sub kategori
                            if (kategori.sub_kategori && kategori.sub_kategori.length > 0) {
                                kategori.sub_kategori.forEach(subKategori => {
                                    addSubKategori(kategoriCounter);
                                    const lastSubKategori = document.querySelector(
                                        `[data-sub-kategori-id="${subKategoriCounter}"]`);
                                    if (lastSubKategori) {
                                        // Fill sub kategori name
                                        const namaInput = lastSubKategori.querySelector(
                                            'input[name^="kategori"][name*="sub_kategori"][name$="[nama]"]'
                                        );
                                        if (namaInput) namaInput.value = subKategori.sub_kategori || '';

                                        // Fill sub kategori description if exists
                                        const deskripsiTextarea = lastSubKategori.querySelector(
                                            'textarea[name^="kategori"][name*="sub_kategori"][name$="[deskripsi]"]'
                                        );
                                        if (deskripsiTextarea) deskripsiTextarea.value = subKategori
                                            .deskripsi || '';

                                        // Load penilaian di sub kategori
                                        if (subKategori.penilaian && subKategori.penilaian.length > 0) {
                                            subKategori.penilaian.forEach(penilaian => {
                                                addSubIndicator(kategoriCounter,
                                                    subKategoriCounter);
                                                const lastPenilaian = document.querySelector(
                                                    `[data-penilaian-id="${penilaianCounter}"]`
                                                );
                                                if (lastPenilaian) {
                                                    const input = lastPenilaian.querySelector(
                                                        'input[name^="kategori"]');
                                                    if (input) input.value = penilaian.nama ||
                                                        '';
                                                }
                                            });
                                        }
                                    }
                                });
                            }
                        }
                    });
                }

            } catch (error) {
                console.error('Error:', error);
                // Show error message in modal
                const modalContent = modal.querySelector('.modal-content') || modal;
                modalContent.innerHTML = `
            <div class="p-6">
                <div class="bg-red-50 dark:bg-red-900/10 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    <div class="flex">
                        <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400 mr-2 mt-0.5"></i>
                        <div>
                            <h4 class="text-sm font-medium text-red-800 dark:text-red-200">Gagal Memuat Data</h4>
                            <p class="text-sm text-red-700 dark:text-red-300">${error.message}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="button" onclick="closeFormModal()" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                        Tutup
                    </button>
                </div>
            </div>
        `;
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
            try {
                // 1. Reset form utama jika ada
                const form = document.getElementById('formData');
                if (form && typeof form.reset === 'function') {
                    form.reset();
                } else {
                    console.warn('Form element not found or reset method not available');
                }

                // 2. Reset container kategori
                const kategoriContainer = document.getElementById('kategoriContainer');
                if (kategoriContainer) {
                    kategoriContainer.innerHTML = '';
                } else {
                    console.warn('Kategori container not found');
                }

                // 3. Reset container penilaian langsung
                const directContainer = document.getElementById('directPenilaianContainer');
                if (directContainer) {
                    directContainer.innerHTML = '';
                } else {
                    console.warn('Direct penilaian container not found');
                }

                // 4. Reset counter
                kategoriCounter = 0;
                subKategoriCounter = 0;
                penilaianCounter = 0;

            } catch (error) {
                console.error('Error in resetForm:', error);
            }
        }

        // Tambahkan fungsi untuk menambah penilaian langsung tanpa kategori
        function addDirectPenilaian() {
            const container = document.getElementById('directPenilaianContainer');
            const penilaianId = ++penilaianCounter;

            const directPenilaianHtml = `
                <div class="direct-penilaian-item bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 mb-3" data-direct-penilaian-id="${penilaianId}">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <input type="text" name="penilaian[${penilaianId}][nama]"
                                placeholder="Nama Penilaian"
                                class="w-full px-3 py-2 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600">
                        </div>
                        <button type="button" onclick="removeDirectPenilaian(${penilaianId})"
                            class="ml-2 p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded-lg">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', directPenilaianHtml);
        }

        function removeDirectPenilaian(penilaianId) {
            const element = document.querySelector(`[data-direct-penilaian-id="${penilaianId}"]`);
            if (element) {
                element.remove();
            }
        }

        // Modifikasi fungsi addCategory untuk mendukung penilaian langsung di kategori
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

            <!-- Penilaian Langsung di Kategori -->
            <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-3 mb-3 border border-blue-200 dark:border-blue-800">
                <div class="flex justify-between items-center mb-3">
                    <h5 class="font-medium text-blue-800 dark:text-blue-200">Penilaian Langsung</h5>
                    <button type="button" onclick="addKategoriPenilaian(${kategoriId})"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-sm flex items-center space-x-1">
                        <i class="fas fa-plus text-xs"></i>
                        <span>Tambah Penilaian</span>
                    </button>
                </div>
                <div class="kategori-penilaian-container-${kategoriId} space-y-2">
                    <!-- Penilaian langsung di kategori akan ditambahkan di sini -->
                </div>
            </div>

            <!-- Sub Kategori -->
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
                    <!-- sub_kategori akan ditambahkan di sini -->
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

        // Fungsi untuk menambah penilaian langsung di kategori
        function addKategoriPenilaian(kategoriId) {
            const container = document.querySelector(`.kategori-penilaian-container-${kategoriId}`);
            const penilaianId = ++penilaianCounter;

            const penilaianHtml = `
        <div class="kategori-penilaian-item bg-white dark:bg-gray-800 rounded p-2" data-kategori-penilaian-id="${penilaianId}">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <input type="text" name="kategori[${kategoriId}][penilaian][${penilaianId}][nama]"
                        placeholder="Nama Penilaian"
                        class="w-full px-2 py-1 bg-white dark:bg-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600 text-sm">
                </div>
                <button type="button" onclick="removeKategoriPenilaian(${penilaianId})"
                    class="ml-2 p-1 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded">
                    <i class="fas fa-trash text-xs"></i>
                </button>
            </div>
        </div>
    `;

            container.insertAdjacentHTML('beforeend', penilaianHtml);
        }

        function removeKategoriPenilaian(penilaianId) {
            const element = document.querySelector(`[data-kategori-penilaian-id="${penilaianId}"]`);
            if (element) {
                element.remove();
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
                    <input type="text"
                           name="kategori[${kategoriId}][sub_kategori][${subKategoriId}][penilaian][${penilaianId}][nama]"
                           placeholder="Nama Penilaian"
                           class="w-full px-2 py-1 bg-white dark:bg-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600 text-sm">
                </div>
                <button type="button" onclick="removeSubIndicator(${penilaianId})"
                    class="ml-2 p-1 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded">
                    <i class="fas fa-trash text-xs"></i>
                </button>
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
            const previewContainer = document.getElementById(`preview-tipe-penilaian`);
            const type = select.value;

            const url = `/admin/tipe-penilaian/${type}`;

            const successCallback = function(res) {
                const type = res.data.tipe_input;
                const opsis = res.data.opsi || [];

                let previewHtml = '';

                switch (type) {
                    case 'radio':
                        // Buat markup label radio secara dinamis dari opsis
                        const radioOptionsHtml = opsis.map((opsi, index) => `
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="preview-radio" value="${opsi.value}" class="custom-radio" ${index === 0 ? 'checked' : ''}>
                        <span class="text-sm">${opsi.label}</span>
                    </label>
                `).join('');

                        previewHtml = `
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Preview:</p>
                        <div class="flex flex-wrap gap-4">
                            ${radioOptionsHtml}
                        </div>
                    </div>
                `;
                        break;

                    case 'select':
                        // Buat markup select secara dinamis dari opsis
                        const selectOptionsHtml = opsis.map(opsi => `
                    <option value="${opsi.value}">${opsi.label}</option>
                `).join('');

                        previewHtml = `
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Preview:</p>
                        <select class="w-full px-3 py-2 bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-bangala text-sm">
                            <option value="">Pilih opsi</option>
                            ${selectOptionsHtml}
                        </select>
                    </div>
                `;
                        break;

                    case 'number':
                        previewHtml = `
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Preview:</p>
                        <div class="flex items-center space-x-2">
                            <input type="number" min="1" max="100" placeholder="1-100"
                                class="w-20 px-3 py-2 bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-bangala">
                            <span class="text-sm text-gray-600 dark:text-gray-400">/ 100</span>
                        </div>
                    </div>
                `;
                        break;

                    case 'text':
                        previewHtml = `
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Preview:</p>
                        <input type="text" placeholder="Masukkan teks"
                            class="w-full px-3 py-2 bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-bangala text-sm">
                    </div>
                `;
                        break;

                    case 'textarea':
                        previewHtml = `
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Preview:</p>
                        <textarea rows="3" placeholder="Masukkan teks panjang"
                            class="w-full px-3 py-2 bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-bangala text-sm"></textarea>
                    </div>
                `;
                        break;

                    default:
                        previewHtml = `
                    <div class="text-gray-500 dark:text-gray-400 text-sm">
                        Pilih tipe penilaian untuk melihat preview
                    </div>
                `;
                }

                previewContainer.innerHTML = previewHtml;
            };

            const errorCallback = function(error) {
                console.error('Error:', error);
                previewContainer.innerHTML = `
            <div class="text-red-500 dark:text-red-400 text-sm">
                Gagal memuat preview tipe penilaian
            </div>
        `;
            };

            if (type) {
                ajaxCall(url, 'GET', null, successCallback, errorCallback);
            } else {
                previewContainer.innerHTML = `
            <div class="text-gray-500 dark:text-gray-400 text-sm">
                Pilih tipe penilaian untuk melihat preview
            </div>
        `;
            }
        }


        // View Functions
        async function viewForm(formId) {
            const modal = document.getElementById('viewModal');
            const content = document.getElementById('viewContent');

            if (!modal || !content) {
                console.error('Modal or content element not found');
                return;
            }

            // Show loading state
            content.innerHTML = `
        <div class="flex justify-center items-center h-32">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-bangala"></div>
        </div>
    `;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            try {
                const response = await fetch(`/admin/formulir/${formId}`);
                if (!response.ok) throw new Error('Gagal mengambil data formulir');

                const dataJson = await response.json();
                const data = dataJson.data;

                console.log(data.penilaian_langsung)

                // Format tanggal
                console.log(data.created_at);
                const createdAt = new Date(data.created_at).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });

                let html = `
            <div class="space-y-6">
                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4">
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">${data.nama}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">${data.keterangan || 'Tidak ada deskripsi'}</p>
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Dibuat: ${createdAt}</p>
                    </div>
                </div>
        `;

                // Jika ada penilaian langsung (tanpa kategori)
                if (data.penilaian_langsung && data.penilaian_langsung.length > 0) {
                    html += `
                <div class="border border-gray-200 dark:border-gray-600 rounded-xl p-4">
                    <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-4">Penilaian Langsung</h5>
                    <div class="space-y-3">
            `;

                    data.penilaian_langsung.forEach(penilaian => {
                        html += `
                    <div class="bg-white dark:bg-gray-800 rounded p-2 mb-2 border border-gray-100 dark:border-gray-700">
                        <div class="flex justify-between items-start">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">${penilaian.nama}</p>
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 rounded-full text-xs">
                                ${data.tipe_penilaian?.nama || 'Tanpa Tipe'}
                            </span>
                        </div>
                        ${renderPreview(data.tipe_penilaian?.tipe_input || 'text')}
                    </div>
                `;
                    });

                    html += `
                    </div>
                </div>
            `;
                }

                // Jika ada kategori
                if (data.kategori && data.kategori.length > 0) {
                    data.kategori.forEach(kategori => {
                        html += `
                    <div class="border border-gray-200 dark:border-gray-600 rounded-xl p-4">
                        <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">${kategori.kategori}</h5>
                        ${kategori.deskripsi ? `<p class="text-sm text-gray-600 dark:text-gray-400 mb-4">${kategori.deskripsi}</p>` : ''}
                `;

                        // Jika ada penilaian dalam kategori (bukan subkategori)
                        if (kategori.penilaian && kategori.penilaian.length > 0) {
                            html += `
                        <div class="space-y-3 mb-4">
                            <h6 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Penilaian</h6>
                    `;

                            kategori.penilaian.forEach(penilaian => {

                                html += `
                            <div class="bg-white dark:bg-gray-800 rounded p-2 border border-gray-100 dark:border-gray-700">
                                <div class="flex justify-between items-start">
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">${penilaian.nama}</p>
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 rounded-full text-xs">
                                        ${data.tipe_penilaian?.nama || 'Tanpa Tipe'}
                                    </span>
                                </div>
                                ${renderPreview(data.tipe_penilaian?.tipe_input || 'text')}
                            </div>
                        `;


                            });

                            html += `
                        </div>
                    `;
                        }

                        // Jika ada sub kategori
                        if (kategori.sub_kategori && kategori.sub_kategori.length > 0) {
                            kategori.sub_kategori.forEach(subKategori => {
                                html += `
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 mb-3">
                                <h6 class="font-medium text-gray-700 dark:text-gray-300 mb-2">${subKategori.sub_kategori}</h6>
                                ${subKategori.deskripsi ? `<p class="text-sm text-gray-600 dark:text-gray-400 mb-3">${subKategori.deskripsi}</p>` : ''}
                        `;

                                if (subKategori.penilaian && subKategori.penilaian.length > 0) {
                                    subKategori.penilaian.forEach(penilaian => {
                                        html += `
                                    <div class="bg-white dark:bg-gray-800 rounded p-2 mb-2 border border-gray-100 dark:border-gray-700">
                                        <div class="flex justify-between items-start">
                                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">${penilaian.nama}</p>
                                            <span class="px-2 py-1 bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 rounded-full text-xs">
                                                ${data.tipe_penilaian?.nama || 'Tanpa Tipe'}
                                            </span>
                                        </div>
                                        ${renderPreview(data.tipe_penilaian?.tipe_input || 'text')}
                                    </div>
                                `;
                                    });
                                }

                                html += '</div>';
                            });
                        }

                        html += '</div>';
                    });
                }

                html += '</div>';
                content.innerHTML = html;

            } catch (error) {
                console.error('Error:', error);
                content.innerHTML = `
            <div class="bg-red-50 dark:bg-red-900/10 border border-red-200 dark:border-red-800 rounded-xl p-4">
                <div class="flex">
                    <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400 mr-2 mt-0.5"></i>
                    <div>
                        <h4 class="text-sm font-medium text-red-800 dark:text-red-200">Gagal Memuat Data</h4>
                        <p class="text-sm text-red-700 dark:text-red-300">${error.message}</p>
                    </div>
                </div>
            </div>
        `;
            }
        }
        // Helper function untuk menentukan class badge berdasarkan tipe input
        function getTypeBadgeClass(type) {
            switch (type) {
                case 'boolean':
                    return 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200';
                case 'frequency':
                    return 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
                case 'score':
                    return 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200';
                default:
                    return 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
            }
        }

        // Fungsi renderPreview tetap sama
        function renderPreview(type) {
            console.log(type, 'renderPreview')
            switch (type) {
                case 'boolean':
                    return `
                <div class="mt-2 flex space-x-4">
                    <label class="flex items-center space-x-2 text-xs">
                        <input type="radio" name="boolean-preview" disabled class="custom-radio">
                        <span>Terlaksana</span>
                    </label>
                    <label class="flex items-center space-x-2 text-xs">
                        <input type="radio" name="boolean-preview" disabled class="custom-radio">
                        <span>Tidak Terlaksana</span>
                    </label>
                </div>
            `;

                case 'frequency':
                    return `
                <div class="mt-2 grid grid-cols-2 gap-2 text-xs">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="frequency-preview" disabled class="custom-radio">
                        <span>1 - Sangat Jarang</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="frequency-preview" disabled class="custom-radio">
                        <span>2 - Jarang</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="frequency-preview" disabled class="custom-radio">
                        <span>3 - Sering</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="frequency-preview" disabled class="custom-radio">
                        <span>4 - Sangat Sering</span>
                    </label>
                </div>
            `;

                case 'number':
                    return `
                <div class="mt-2 flex items-center space-x-2 text-xs">
                    <input type="number" min="1" max="100" disabled
                        class="w-20 px-2 py-1 bg-gray-100 dark:bg-gray-600 rounded border">
                    <span class="text-gray-600 dark:text-gray-400">/ 100</span>
                </div>
            `;

                case 'select':
                    return `
                <div class="mt-2">
                    <select disabled class="w-full px-3 py-2 text-xs bg-gray-100 dark:bg-gray-600 rounded border">
                        <option value="">Pilih opsi</option>
                        <option value="1">Opsi 1</option>
                        <option value="2">Opsi 2</option>
                        <option value="3">Opsi 3</option>
                    </select>
                </div>
            `;

                case 'radio':
                    return `
                <div class="mt-2 space-y-2 text-xs">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="radio-group-preview" disabled class="custom-radio">
                        <span>Pilihan A</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="radio-group-preview" disabled class="custom-radio">
                        <span>Pilihan B</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="radio-group-preview" disabled class="custom-radio">
                        <span>Pilihan C</span>
                    </label>
                </div>
            `;
                default:
                    return '';
            }
        }

        // Fungsi getTypeLabel tetap sama
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
            // currentFormId = formId;

            $('#delete-form').attr('data-id', formId)
            // $('#form-delete').attr('data-id', id);

            document.getElementById('deleteModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        let currentSearch = '';

        function loadData(search) {
            $.ajax({
                url: `/admin/formulir?search=${search}`,
                type: 'GET',
                success: function(res) {
                    $('#data-form').html(res.data.view);
                    currentSearch = search;
                },
                error: function() {
                    errorToast('Gagal memuat data.');
                }
            });
        }

        function saveForm() {
            const penilaian_tipe_id = $('#tipe-penilaian').val();

            const formData = {
                nama: document.getElementById('formName').value,
                penilaian_tipe_id: penilaian_tipe_id,
                pengisi: $('#pengisi').val(),
                target: $('#target').val(),
                self: $('#self').val(),
                keterangan: document.getElementById('formDescription').value,
                penilaian: [], // Penilaian langsung tanpa kategori
                kategori: []
            };

            // 1. Collect penilaian langsung (tanpa kategori)
            const directPenilaianElements = document.querySelectorAll('.direct-penilaian-item');
            directPenilaianElements.forEach(element => {
                const input = element.querySelector('input[name^="penilaian["]');
                if (input && input.value.trim()) {
                    formData.penilaian.push({
                        nama: input.value.trim()
                    });
                }
            });

            // 2. Collect kategori data
            const kategoriElements = document.querySelectorAll('.kategori-item');
            kategoriElements.forEach(kategoriElement => {
                const kategoriId = kategoriElement.dataset.kategoriId;
                const kategoriNamaInput = kategoriElement.querySelector(
                    `input[name="kategori[${kategoriId}][nama]"]`);

                if (!kategoriNamaInput || !kategoriNamaInput.value.trim()) return;

                const kategori = {
                    nama: kategoriNamaInput.value.trim(),
                    penilaian: [], // Penilaian langsung di kategori
                    sub_kategori: []
                };

                // 2a. Collect penilaian langsung di kategori
                const kategoriPenilaianElements = kategoriElement.querySelectorAll('.kategori-penilaian-item');
                kategoriPenilaianElements.forEach(penilaianElement => {
                    const input = penilaianElement.querySelector(
                        `input[name^="kategori[${kategoriId}][penilaian]["]`);
                    if (input && input.value.trim()) {
                        kategori.penilaian.push({
                            nama: input.value.trim()
                        });
                    }
                });

                // 2b. Collect sub kategori data
                const subKategoriElements = kategoriElement.querySelectorAll('.sub_kategori-item');
                subKategoriElements.forEach(subKategoriElement => {
                    const subKategoriId = subKategoriElement.dataset.subKategoriId;
                    const subKategoriNamaInput = subKategoriElement.querySelector(
                        `input[name="kategori[${kategoriId}][sub_kategori][${subKategoriId}][nama]"]`
                    );

                    if (!subKategoriNamaInput || !subKategoriNamaInput.value.trim()) return;

                    const sub_kategori = {
                        nama: subKategoriNamaInput.value.trim(),
                        penilaian: []
                    };

                    // Collect penilaian data di sub kategori
                    const penilaianElements = subKategoriElement.querySelectorAll('.penilaian-item');
                    penilaianElements.forEach(penilaianElement => {
                        const input = penilaianElement.querySelector(
                            `input[name^="kategori[${kategoriId}][sub_kategori][${subKategoriId}][penilaian]["]`
                        );
                        if (input && input.value.trim()) {
                            sub_kategori.penilaian.push({
                                nama: input.value.trim()
                            });
                        }
                    });

                    kategori.sub_kategori.push(sub_kategori);
                });

                formData.kategori.push(kategori);
            });

            console.log('Form data to be submitted:', formData);

            const url = '{{ route('admin.formulir.store') }}';
            const method = 'POST';

            if (currentFormId && isEditMode == true) {
                formData.append('_method', 'PUT');
                currentFormId = null;
                isEditMode = false;
            }

            const successCallback = function(response) {
                successToast(response);
                closeFormModal();
                resetForm();
                loadData(currentSearch);
            }

            const errorCallback = function(error) {
                errorToast(error);
                console.error('Error:', error);
            }

            ajaxCall(url, method, formData, successCallback, errorCallback);
        }

        $(document).ready(function() {

            let debounceTimeout;
            const debounceDelay = 500;

            $('#search').on('keyup', function() {
                clearTimeout(debounceTimeout);

                const query = $(this).val();
                currentSearch = query;

                debounceTimeout = setTimeout(() => {
                    loadData(currentSearch);
                }, debounceDelay);
            });

            $(document).on('submit', '#delete-form', function(e) {
                e.preventDefault();

                const id = $(this).data('id');
                const url = `/admin/formulir/${id}`;

                const successCallback = function(res) {
                    successToast(res);
                    closeDeleteModal()
                    loadData(currentSearch)
                }

                const errorCallback = function(err) {
                    errorToast(err)
                }

                ajaxCall(url, 'DELETE', null, successCallback, errorCallback)
            })

            loadData(currentSearch)
        })
    </script>
@endpush
