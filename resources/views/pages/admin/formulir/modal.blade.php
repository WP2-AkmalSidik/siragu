
    <!-- Modal Create/Edit Form -->
    <div id="formModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeFormModal()"></div>
        <div
            class="relative z-10 bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto transform transition-all">
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
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama
                                    Formulir</label>
                                <input type="text" id="formName"
                                    class="w-full px-4 py-2 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600">
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                <select id="formStatus"
                                    class="w-full px-4 py-2 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600">
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

                    <!-- Form kategori -->
                    <div class="form-section bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200">Kategori Penilaian</h4>
                            <button type="button" onclick="addCategory()"
                                class="bg-bangala hover:bg-bangala/90 text-white px-3 py-1 rounded-lg text-sm flex items-center space-x-1">
                                <i class="fas fa-plus text-xs"></i>
                                <span>Tambah Kategori</span>
                            </button>
                        </div>

                        <div id="kategoriContainer" class="space-y-4">
                            <!-- kategori will be added here dynamically -->
                        </div>
                    </div>
                </form>
            </div>

            <div
                class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3 sticky bottom-0 bg-white dark:bg-gray-800">
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
        <div
            class="relative z-10 bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-md transform transition-all">
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
