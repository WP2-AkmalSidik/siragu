    <!-- Modal -->
    <div id="modal-data-jabatan" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeEditModal()"></div>
        <!-- Modal Content -->
        <div
            class="relative z-10 bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-lg transform transition-all">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white" id="modal-title-jabatan">Tambah Jabatan</h3>
            </div>
            <div class="px-6 py-4">
                <form id="modal-form-jabatan">
                    <div class="space-y-4">
                        <div>
                            <label for="jabatan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama
                                Jabatan</label>
                            <input type="text" name="jabatan" placeholder="Nama Jabatan" id="jabatan"
                                class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                            <small class="text-xs text-red-500 dark:text-red-400" id="errorjabatan"></small>
                        </div>
                        <div>
                            <label for="keterangan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Keterangan</label>
                            <textarea name="keterangan" id="keterangan"
                                class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala"></textarea>
                            <small class="text-xs text-red-500 dark:text-red-400" id="errorketerangan"></small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('modal-data-jabatan')"
                    class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    Batal
                </button>
                <button type="submit" form="modal-form-jabatan"
                    class="px-4 py-2 bg-bangala text-white rounded-lg hover:bg-bangala/90 transition">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="modal-delete-jabatan" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModalDeleteJabatan()"></div>
        <!-- Modal Content -->
        <div
            class="relative z-10 bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-lg transform transition-all">
            <div class="px-6 py-4">

                <form id="form-delete-jabatan"></form>
                <h3 class="text-xl font-bold mb-2">Hapus Jabatan</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Apakah Anda yakin ingin menghapus Jabatan ini?
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('modal-delete-jabatan')"
                    class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    Batal
                </button>
                <button type="submit" form="form-delete-jabatan"
                    class="px-4 py-2 bg-bangala text-white rounded-lg hover:bg-bangala/90 transition">
                    Hapus
                </button>
            </div>
        </div>
    </div>
