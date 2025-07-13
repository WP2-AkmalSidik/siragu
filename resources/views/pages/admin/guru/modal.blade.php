    <!-- Modal -->
    <div id="modal-data" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeEditModal()"></div>
        <!-- Modal Content -->
        <div
            class="relative z-10 bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-lg transform transition-all">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white" id="modal-title">Edit Data Guru</h3>
            </div>
            <div class="px-6 py-4">
                <form id="modal-form">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NIP</label>
                            <input type="text" name="nip" placeholder="1234567890" id="nip"
                                class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                            <small class="text-xs text-red-500 dark:text-red-400" id="errornip"></small>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama
                                Guru</label>
                            <input type="text" name="nama" placeholder="Nama Guru" id="nama"
                                class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                            <small class="text-xs text-red-500 dark:text-red-400" id="errornama"></small>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No Hp</label>
                            <input type="tel" name="no_hp" placeholder="081234567890" id="no_hp"
                                class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                            <small class="text-xs text-red-500 dark:text-red-400" id="errorno_hp"></small>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" name="email" placeholder="nama@contoh.com" id="email"
                                class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                            <small class="text-xs text-red-500 dark:text-red-400" id="erroremail"></small>
                        </div>
                        <div>
                            <label for="jabatan_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jabatan</label>
                            <select type="jabatan_id" name="jabatan_id[]" id="jabatan_id" multiple="multiple"
                                class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                            </select>
                            <small class="text-xs text-red-500 dark:text-red-400" id="errorjabatan"></small>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                            <select
                                class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala"
                                name="status" id="status">
                                <option value="1">Aktif</option>
                                <option value="0">Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('modal-data')"
                    class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    Batal
                </button>
                <button type="submit" form="modal-form"
                    class="px-4 py-2 bg-bangala text-white rounded-lg hover:bg-bangala/90 transition">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="modal-delete" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeEditModal()"></div>
        <!-- Modal Content -->
        <div
            class="relative z-10 bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-lg transform transition-all">
            <div class="px-6 py-4">

                <form id="form-delete"></form>
                <h3 class="text-xl font-bold mb-2">Hapus Guru</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Apakah Anda yakin ingin menghapus Guru ini?
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('modal-delete')"
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
