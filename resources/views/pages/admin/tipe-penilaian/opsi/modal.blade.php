    <!-- Modal -->
    <div id="modal-data-opsi" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('modal-data-opsi')"></div>
        <!-- Modal Content -->
        <div
            class="relative z-10 bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-lg transform transition-all">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white" id="modal-title-opsi">Edit Data Guru</h3>
            </div>
            <div class="px-6 py-4">
                <form id="modal-form-opsi">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Tipe
                                Penilaian</label>
                            <select type="text" name="penilaian_tipe_id" placeholder="Nama Tipe Penilaian"
                                id="penilaian_tipe_id"
                                class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala"></select>
                            <small class="text-xs text-red-500 dark:text-red-400" id="errorpenilaian_tipe_id"></small>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama
                                Label</label>
                            <input type="text" name="label" placeholder="Nama Tipe Penilaian" id="label"
                                class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                            <small class="text-xs text-red-500 dark:text-red-400" id="errorlabel"></small>
                        </div>
                        <div>
                            <label for="value"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nilai</label>
                            <input type="text" name="value" placeholder="Nama Tipe Penilaian" id="value"
                                class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                            <small class="text-xs text-red-500 dark:text-red-400" id="errorvalue"></small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('modal-data-opsi')"
                    class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    Batal
                </button>
                <button type="submit" form="modal-form-opsi"
                    class="px-4 py-2 bg-bangala text-white rounded-lg hover:bg-bangala/90 transition">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="modal-delete-opsi" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('modal-delete-opsi')"></div>
        <!-- Modal Content -->
        <div
            class="relative z-10 bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-lg transform transition-all">
            <div class="px-6 py-4">

                <form id="form-delete"></form>
                <h3 class="text-xl font-bold mb-2">Hapus Tipe Penilaian</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Apakah Anda yakin ingin menghapus Tipe Penilaian ini?
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('modal-delete-opsi')"
                    class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    Batal
                </button>
                <button type="submit" form="form-delete"
                    class="px-4 py-2 bg-bangala text-white rounded-lg hover:bg-bangala/90 transition">
                    Hapus
                </button>
            </div>
        </div>
    </div>
