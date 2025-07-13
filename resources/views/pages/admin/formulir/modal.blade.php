<!-- Modal View Form -->
<div id="viewModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeViewModal()"></div>
    <div
        class="relative z-10 bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto transform transition-all">
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
            <form id="delete-form">
                <button type="button" onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<div id="formModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-2xl w-full max-w-6xl max-h-[90vh] overflow-hidden flex flex-col">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Buat Formulir Penilaian</h3>
                <button onclick="closeFormModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>

        <div class="p-6 overflow-y-auto max-h-[calc(90vh-140px)]">
            <form id="formData" class="space-y-6">
                <!-- Form Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama
                            Formulir</label>
                        <input type="text" id="formName" name="nama" required
                            class="w-full px-4 py-3 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tipe
                            Penilaian</label>
                        <select id="tipe-penilaian" name="penilaian_tipe_id" required
                            onchange="updateInputType(this, 'tipe-penilaian')"
                            class="w-full px-4 py-3 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600">
                            <option value="">Pilih Tipe Penilaian</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Penilai</label>
                        <select id="pengisi" name="pengisi" required
                            class="w-full px-4 py-3 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600">
                            <option value="">Pilih Pengisi</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Yang
                            Ditilai</label>
                        <select id="target" name="target" required
                            class="w-full px-4 py-3 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600">
                            <option value="">Pilih Target</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nilai untuk diri
                            sendiri</label>
                        <select id="self" name="self"
                            class="w-full px-4 py-3 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deskripsi</label>
                    <textarea id="formDescription" name="keterangan" rows="3"
                        class="w-full px-4 py-3 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600"></textarea>
                </div>

                <!-- Preview Tipe Penilaian -->
                <div id="preview-tipe-penilaian" class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                    <span class="text-gray-500 dark:text-gray-400">Pilih tipe penilaian untuk melihat preview</span>
                </div>

                <!-- Tab Navigation -->
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="-mb-px flex space-x-8">
                        <button type="button" id="tab-direct" onclick="switchTab('direct')"
                            class="tab-button py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap">
                            Penilaian Langsung
                        </button>
                        <button type="button" id="tab-kategori" onclick="switchTab('kategori')"
                            class="tab-button py-2 px-1 border-b-2 border-bangala text-bangala whitespace-nowrap">
                            Dengan Kategori
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div id="content-direct" class="tab-content hidden">
                    <div
                        class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4 mb-4">
                        <div class="flex">
                            <i class="fas fa-info-circle text-yellow-600 dark:text-yellow-400 mr-2 mt-0.5"></i>
                            <div>
                                <h4 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Penilaian Langsung
                                </h4>
                                <p class="text-sm text-yellow-700 dark:text-yellow-300">Tambahkan penilaian tanpa
                                    menggunakan kategori atau sub kategori.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Penilaian</h4>
                        <button type="button" onclick="addDirectPenilaian()"
                            class="bg-bangala hover:bg-bangala/90 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Penilaian</span>
                        </button>
                    </div>

                    <div id="directPenilaianContainer" class="space-y-3">
                        <!-- Penilaian langsung akan ditambahkan di sini -->
                    </div>
                </div>

                <div id="content-kategori" class="tab-content">
                    <div
                        class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-4">
                        <div class="flex">
                            <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 mr-2 mt-0.5"></i>
                            <div>
                                <h4 class="text-sm font-medium text-blue-800 dark:text-blue-200">Penilaian Dengan
                                    Kategori</h4>
                                <p class="text-sm text-blue-700 dark:text-blue-300">Anda bisa menambahkan penilaian
                                    langsung di kategori atau menggunakan sub kategori untuk organisasi yang lebih
                                    detail.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Kategori</h4>
                        <button type="button" onclick="addCategory()"
                            class="bg-bangala hover:bg-bangala/90 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Kategori</span>
                        </button>
                    </div>

                    <div id="kategoriContainer" class="space-y-4">
                        <!-- Kategori akan ditambahkan di sini -->
                    </div>
                </div>
            </form>
        </div>

        <div class="p-6 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
            <div class="flex flex-col sm:flex-row justify-end gap-3">
                <button type="button" onclick="closeFormModal()"
                    class="px-8 py-3 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors flex-1 sm:flex-none">
                    Batal
                </button>
                <button type="button" onclick="saveForm()"
                    class="px-8 py-3 bg-bangala hover:bg-bangala/90 text-white rounded-lg transition-colors flex-1 sm:flex-none">
                    Simpan Formulir
                </button>
            </div>
        </div>
    </div>
</div>
