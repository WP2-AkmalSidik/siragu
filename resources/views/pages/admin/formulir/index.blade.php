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
            <select class="px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
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
                    <button onclick="viewForm(1)" class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button onclick="editForm(1)" class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="deleteForm(1)" class="p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded-lg">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            
            <!-- Categories Preview -->
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
                    <button onclick="viewForm(2)" class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button onclick="editForm(2)" class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="deleteForm(2)" class="p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded-lg">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            
            <!-- Categories Preview -->
            <div class="space-y-3">
                <div class="border-l-4 border-bangala pl-4">
                    <h5 class="font-medium text-gray-800 dark:text-gray-200">Kategori Komunikasi</h5>
                    <p class="text-sm text-gray-600 dark:text-gray-400">2 Indikator • 5 Sub-indikator</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create/Edit Form -->
    <div id="formModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeFormModal()"></div>
        <div class="relative z-10 bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto transform transition-all">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 sticky top-0 bg-white dark:bg-gray-800">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Buat Formulir Penilaian</h3>
                    <button onclick="closeFormModal()" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <div class="px-6 py-4">
                <form id="formData">
                    <!-- Form Basic Info -->
                    <div class="form-section bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 mb-6">
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-4">Informasi Dasar</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Formulir</label>
                                <input type="text" id="formName" 
                                    class="w-full px-4 py-2 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                <select id="formStatus" class="w-full px-4 py-2 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600">
                                    <option value="draft">Draft</option>
                                    <option value="active">Aktif</option>
                                    <option value="archived">Arsip</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                            <textarea id="formDescription" rows="3"
                                class="w-full px-4 py-2 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600"></textarea>
                        </div>
                    </div>

                    <!-- Form Categories -->
                    <div class="form-section bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200">Kategori Penilaian</h4>
                            <button type="button" onclick="addCategory()" 
                                class="bg-bangala hover:bg-bangala/90 text-white px-3 py-1 rounded-lg text-sm flex items-center space-x-1">
                                <i class="fas fa-plus text-xs"></i>
                                <span>Tambah Kategori</span>
                            </button>
                        </div>
                        
                        <div id="categoriesContainer" class="space-y-4">
                            <!-- Categories will be added here dynamically -->
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3 sticky bottom-0 bg-white dark:bg-gray-800">
                <button type="button" onclick="closeFormModal()"
                    class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    Batal
                </button>
                <button type="button" onclick="saveForm()"
                    class="px-4 py-2 bg-bangala text-white rounded-lg hover:bg-bangala/90 transition">
                    Simpan Formulir
                </button>
            </div>
        </div>
    </div>

    <!-- Modal View Form -->
    <div id="viewModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeViewModal()"></div>
        <div class="relative z-10 bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto transform transition-all">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 sticky top-0 bg-white dark:bg-gray-800">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Detail Formulir Penilaian</h3>
                    <button onclick="closeViewModal()" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <div id="viewContent" class="px-6 py-4">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
        <div class="relative z-10 bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-md transform transition-all">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Konfirmasi Hapus</h3>
            </div>
            
            <div class="px-6 py-4">
                <p class="text-gray-700 dark:text-gray-300">Apakah Anda yakin ingin menghapus formulir ini?</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Data yang dihapus tidak dapat dikembalikan.</p>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                <button type="button" onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    Batal
                </button>
                <button type="button" onclick="confirmDelete()"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        let categoryCounter = 0;
        let indicatorCounter = 0;
        let subIndicatorCounter = 0;
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
                    name: 'Penilaian Kinerja Guru Semester 1',
                    status: 'active',
                    description: 'Formulir penilaian kinerja guru untuk semester 1 tahun ajaran 2024/2025',
                    categories: [
                        {
                            name: 'Perencanaan Pembelajaran',
                            description: 'Penilaian terhadap kemampuan guru dalam merencanakan pembelajaran',
                            indicators: [
                                {
                                    name: 'Kelengkapan RPP',
                                    description: 'Kelengkapan Rencana Pelaksanaan Pembelajaran',
                                    sub_indicators: [
                                        { name: 'RPP sesuai dengan kurikulum', type: 'boolean' },
                                        { name: 'Kelengkapan komponen RPP', type: 'score' }
                                    ]
                                }
                            ]
                        }
                    ]
                }
            };
            
            const formData = sampleData[formId];
            if (formData) {
                document.getElementById('formName').value = formData.name;
                document.getElementById('formStatus').value = formData.status;
                document.getElementById('formDescription').value = formData.description;
                
                formData.categories.forEach(category => {
                    addCategory();
                    const lastCategory = document.querySelector(`[data-category-id="${categoryCounter}"]`);
                    
                    lastCategory.querySelector('input[name^="categories"]').value = category.name;
                    lastCategory.querySelector('textarea[name^="categories"]').value = category.description;
                    
                    category.indicators.forEach(indicator => {
                        addIndicator(categoryCounter);
                        const lastIndicator = document.querySelector(`[data-indicator-id="${indicatorCounter}"]`);
                        
                        lastIndicator.querySelector('input[name^="categories"]').value = indicator.name;
                        lastIndicator.querySelector('textarea[name^="categories"]').value = indicator.description || '';
                        
                        indicator.sub_indicators.forEach(subIndicator => {
                            addSubIndicator(categoryCounter, indicatorCounter);
                            const lastSubIndicator = document.querySelector(`[data-sub-indicator-id="${subIndicatorCounter}"]`);
                            
                            lastSubIndicator.querySelector('input[name^="categories"]').value = subIndicator.name;
                            const typeSelect = lastSubIndicator.querySelector('select[name^="categories"]');
                            typeSelect.value = subIndicator.type;
                            updateInputType(typeSelect, subIndicatorCounter);
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
            document.getElementById('categoriesContainer').innerHTML = '';
            categoryCounter = 0;
            indicatorCounter = 0;
            subIndicatorCounter = 0;
        }

        function addCategory() {
            const container = document.getElementById('categoriesContainer');
            const categoryId = ++categoryCounter;
            
            const categoryHtml = `
                <div class="category-item border border-gray-200 dark:border-gray-600 rounded-xl p-4" data-category-id="${categoryId}">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Kategori</label>
                            <input type="text" name="categories[${categoryId}][name]" 
                                class="w-full px-3 py-2 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600">
                        </div>
                        <button type="button" onclick="removeCategory(${categoryId})" 
                            class="ml-3 p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded-lg">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </div>
                    
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi Kategori</label>
                        <textarea name="categories[${categoryId}][description]" rows="2"
                            class="w-full px-3 py-2 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600"></textarea>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-3 border border-gray-100 dark:border-gray-700">
                        <div class="flex justify-between items-center mb-3">
                            <h5 class="font-medium text-gray-800 dark:text-gray-200">Indikator</h5>
                            <button type="button" onclick="addIndicator(${categoryId})" 
                                class="bg-goldspel hover:bg-goldspel/90 text-white px-2 py-1 rounded text-sm flex items-center space-x-1">
                                <i class="fas fa-plus text-xs"></i>
                                <span>Tambah Indikator</span>
                            </button>
                        </div>
                        <div class="indicators-container-${categoryId} space-y-3">
                            <!-- Indicators will be added here -->
                        </div>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', categoryHtml);
        }

        function removeCategory(categoryId) {
            const categoryElement = document.querySelector(`[data-category-id="${categoryId}"]`);
            if (categoryElement) {
                if (confirm('Hapus kategori ini? Semua indikator dan sub-indikator di dalamnya juga akan dihapus.')) {
                    categoryElement.remove();
                }
            }
        }

        function addIndicator(categoryId) {
            const container = document.querySelector(`.indicators-container-${categoryId}`);
            const indicatorId = ++indicatorCounter;
            
            const indicatorHtml = `
                <div class="indicator-item bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3" data-indicator-id="${indicatorId}">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex-1">
                            <input type="text" name="categories[${categoryId}][indicators][${indicatorId}][name]" 
                                placeholder="Nama Indikator"
                                class="w-full px-3 py-2 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600 text-sm">
                        </div>
                        <button type="button" onclick="removeIndicator(${indicatorId})" 
                            class="ml-2 p-1 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded">
                            <i class="fas fa-trash text-xs"></i>
                        </button>
                    </div>
                    
                    <div class="mb-3">
                        <textarea name="categories[${categoryId}][indicators][${indicatorId}][description]" 
                            placeholder="Deskripsi Indikator" rows="2"
                            class="w-full px-3 py-2 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600 text-sm"></textarea>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-2 border border-gray-100 dark:border-gray-700">
                        <div class="flex justify-between items-center mb-2">
                            <h6 class="text-sm font-medium text-gray-700 dark:text-gray-300">Sub-Indikator</h6>
                            <button type="button" onclick="addSubIndicator(${categoryId}, ${indicatorId})" 
                                class="bg-bangala hover:bg-bangala/90 text-white px-2 py-1 rounded text-xs flex items-center space-x-1">
                                <i class="fas fa-plus text-xs"></i>
                                <span>Tambah Sub</span>
                            </button>
                        </div>
                        <div class="sub-indicators-container-${indicatorId} space-y-2">
                            <!-- Sub-indicators will be added here -->
                        </div>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', indicatorHtml);
        }

        function removeIndicator(indicatorId) {
            const indicatorElement = document.querySelector(`[data-indicator-id="${indicatorId}"]`);
            if (indicatorElement) {
                if (confirm('Hapus indikator ini? Semua sub-indikator di dalamnya juga akan dihapus.')) {
                    indicatorElement.remove();
                }
            }
        }

        function addSubIndicator(categoryId, indicatorId) {
            const container = document.querySelector(`.sub-indicators-container-${indicatorId}`);
            const subIndicatorId = ++subIndicatorCounter;
            
            const subIndicatorHtml = `
                <div class="sub-indicator-item bg-gray-100 dark:bg-gray-600 rounded p-2" data-sub-indicator-id="${subIndicatorId}">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex-1">
                            <input type="text" name="categories[${categoryId}][indicators][${indicatorId}][sub_indicators][${subIndicatorId}][name]" 
                                placeholder="Nama Sub-Indikator"
                                class="w-full px-2 py-1 bg-white dark:bg-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600 text-sm">
                        </div>
                        <button type="button" onclick="removeSubIndicator(${subIndicatorId})" 
                            class="ml-2 p-1 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded">
                            <i class="fas fa-trash text-xs"></i>
                        </button>
                    </div>
                    
                    <div class="mb-2">
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Tipe Penilaian</label>
                        <select name="categories[${categoryId}][indicators][${indicatorId}][sub_indicators][${subIndicatorId}][type]" 
                            onchange="updateInputType(this, ${subIndicatorId})"
                            class="w-full px-2 py-1 bg-white dark:bg-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600 text-sm">
                            <option value="">Pilih Tipe Penilaian</option>
                            <option value="boolean">Terlaksana/Tidak Terlaksana</option>
                            <option value="frequency">Frekuensi Perilaku (1-4)</option>
                            <option value="score">Penilaian Kinerja (1-100)</option>
                        </select>
                    </div>
                    
                    <div id="preview-${subIndicatorId}" class="mt-2 p-2 bg-white dark:bg-gray-700 rounded border text-xs">
                        <span class="text-gray-500 dark:text-gray-400">Pilih tipe penilaian untuk melihat preview</span>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', subIndicatorHtml);
        }

        function removeSubIndicator(subIndicatorId) {
            const subIndicatorElement = document.querySelector(`[data-sub-indicator-id="${subIndicatorId}"]`);
            if (subIndicatorElement) {
                subIndicatorElement.remove();
            }
        }

        function updateInputType(select, subIndicatorId) {
            const previewContainer = document.getElementById(`preview-${subIndicatorId}`);
            const type = select.value;
            
            let previewHtml = '';
            
            switch(type) {
                case 'boolean':
                    previewHtml = `
                        <div class="space-y-1">
                            <p class="font-medium text-gray-700 dark:text-gray-300">Preview:</p>
                            <div class="flex space-x-4">
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="preview_boolean_${subIndicatorId}" class="custom-radio">
                                    <span>Terlaksana</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="preview_boolean_${subIndicatorId}" class="custom-radio">
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
                                    <input type="radio" name="preview_freq_${subIndicatorId}" class="custom-radio">
                                    <span>1 - Sangat Jarang</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="preview_freq_${subIndicatorId}" class="custom-radio">
                                    <span>2 - Jarang</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="preview_freq_${subIndicatorId}" class="custom-radio">
                                    <span>3 - Sering</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="preview_freq_${subIndicatorId}" class="custom-radio">
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
                    previewHtml = '<span class="text-gray-500 dark:text-gray-400">Pilih tipe penilaian untuk melihat preview</span>';
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
                    name: 'Penilaian Kinerja Guru Semester 1',
                    status: 'Aktif',
                    description: 'Formulir penilaian kinerja guru untuk semester 1 tahun ajaran 2024/2025',
                    created_at: '15 Januari 2025',
                    categories: [
                        {
                            name: 'Perencanaan Pembelajaran',
                            description: 'Penilaian terhadap kemampuan guru dalam merencanakan pembelajaran',
                            indicators: [
                                {
                                    name: 'Kelengkapan RPP',
                                    description: 'Kelengkapan Rencana Pelaksanaan Pembelajaran',
                                    sub_indicators: [
                                        { name: 'RPP sesuai dengan kurikulum', type: 'boolean' },
                                        { name: 'Kelengkapan komponen RPP', type: 'score' }
                                    ]
                                },
                                {
                                    name: 'Pemilihan Metode Pembelajaran',
                                    description: 'Kesesuaian metode pembelajaran dengan materi',
                                    sub_indicators: [
                                        { name: 'Metode sesuai dengan karakteristik siswa', type: 'frequency' },
                                        { name: 'Metode mendorong partisipasi aktif siswa', type: 'frequency' }
                                    ]
                                }
                            ]
                        },
                        {
                            name: 'Pelaksanaan Pembelajaran',
                            description: 'Penilaian terhadap pelaksanaan pembelajaran di kelas',
                            indicators: [
                                {
                                    name: 'Pengelolaan Kelas',
                                    description: 'Kemampuan guru dalam mengelola kelas',
                                    sub_indicators: [
                                        { name: 'Kelas kondusif untuk pembelajaran', type: 'frequency' },
                                        { name: 'Disiplin waktu dalam pembelajaran', type: 'boolean' }
                                    ]
                                }
                            ]
                        }
                    ]
                },
                2: {
                    name: 'Evaluasi Perilaku Mengajar',
                    status: 'Draft',
                    description: 'Formulir evaluasi perilaku mengajar guru dalam interaksi dengan siswa',
                    created_at: '10 Januari 2025',
                    categories: [
                        {
                            name: 'Komunikasi',
                            description: 'Kemampuan guru dalam berkomunikasi dengan siswa',
                            indicators: [
                                {
                                    name: 'Kejelasan Penyampaian',
                                    description: 'Kejelasan guru dalam menyampaikan materi',
                                    sub_indicators: [
                                        { name: 'Bahasa yang digunakan mudah dipahami', type: 'frequency' },
                                        { name: 'Volume suara jelas terdengar', type: 'boolean' }
                                    ]
                                }
                            ]
                        }
                    ]
                }
            };
            
            const data = sampleData[formId];
            if (data) {
                let html = `
                    <div class="space-y-6">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">${data.name}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">${data.description}</p>
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 ${data.status === 'Aktif' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200'} rounded-full text-sm">${data.status}</span>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Dibuat: ${data.created_at}</p>
                            </div>
                        </div>
                `;
                
                data.categories.forEach(category => {
                    html += `
                        <div class="border border-gray-200 dark:border-gray-600 rounded-xl p-4">
                            <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">${category.name}</h5>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">${category.description}</p>
                    `;
                    
                    category.indicators.forEach(indicator => {
                        html += `
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 mb-3">
                                <h6 class="font-medium text-gray-700 dark:text-gray-300 mb-2">${indicator.name}</h6>
                                ${indicator.description ? `<p class="text-sm text-gray-600 dark:text-gray-400 mb-3">${indicator.description}</p>` : ''}
                        `;
                        
                        indicator.sub_indicators.forEach(subIndicator => {
                            let typeBadge = '';
                            switch(subIndicator.type) {
                                case 'boolean':
                                    typeBadge = 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200';
                                    break;
                                case 'frequency':
                                    typeBadge = 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
                                    break;
                                case 'score':
                                    typeBadge = 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200';
                                    break;
                                default:
                                    typeBadge = 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                            }
                            
                            html += `
                                <div class="bg-white dark:bg-gray-800 rounded p-2 mb-2 border border-gray-100 dark:border-gray-700">
                                    <div class="flex justify-between items-start">
                                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">${subIndicator.name}</p>
                                        <span class="px-2 py-1 ${typeBadge} rounded-full text-xs">${getTypeLabel(subIndicator.type)}</span>
                                    </div>
                                    ${renderPreview(subIndicator.type)}
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
            switch(type) {
                case 'boolean': return 'Ya/Tidak';
                case 'frequency': return 'Frekuensi';
                case 'score': return 'Skor';
                default: return type;
            }
        }

        function renderPreview(type) {
            switch(type) {
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
                name: document.getElementById('formName').value,
                status: document.getElementById('formStatus').value,
                description: document.getElementById('formDescription').value,
                categories: []
            };
            
            // Collect categories data
            const categoryElements = document.querySelectorAll('.category-item');
            categoryElements.forEach(categoryElement => {
                const categoryId = categoryElement.dataset.categoryId;
                const category = {
                    name: categoryElement.querySelector(`input[name="categories[${categoryId}][name]"]`).value,
                    description: categoryElement.querySelector(`textarea[name="categories[${categoryId}][description]"]`).value,
                    indicators: []
                };
                
                // Collect indicators data
                const indicatorElements = categoryElement.querySelectorAll('.indicator-item');
                indicatorElements.forEach(indicatorElement => {
                    const indicatorId = indicatorElement.dataset.indicatorId;
                    const indicator = {
                        name: indicatorElement.querySelector(`input[name="categories[${categoryId}][indicators][${indicatorId}][name]"]`).value,
                        description: indicatorElement.querySelector(`textarea[name="categories[${categoryId}][indicators][${indicatorId}][description]"]`).value || '',
                        sub_indicators: []
                    };
                    
                    // Collect sub-indicators data
                    const subIndicatorElements = indicatorElement.querySelectorAll('.sub-indicator-item');
                    subIndicatorElements.forEach(subIndicatorElement => {
                        const subIndicatorId = subIndicatorElement.dataset.subIndicatorId;
                        const subIndicator = {
                            name: subIndicatorElement.querySelector(`input[name="categories[${categoryId}][indicators][${indicatorId}][sub_indicators][${subIndicatorId}][name]"]`).value,
                            type: subIndicatorElement.querySelector(`select[name="categories[${categoryId}][indicators][${indicatorId}][sub_indicators][${subIndicatorId}][type]"]`).value
                        };
                        indicator.sub_indicators.push(subIndicator);
                    });
                    
                    category.indicators.push(indicator);
                });
                
                formData.categories.push(category);
            });
            
            console.log('Form data to save:', formData);
            
            // Show success message
            alert(isEditMode ? 'Formulir berhasil diperbarui' : 'Formulir berhasil dibuat');
            
            // Close modal and reset form
            closeFormModal();
            resetForm();
            
            // In a real app, you would update the form list or refresh the page
        }
    </script>
@endsection