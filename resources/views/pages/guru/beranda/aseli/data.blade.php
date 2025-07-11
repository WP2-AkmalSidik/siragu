        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-6 overflow-hidden">
            <div class="border-b border-gray-100 dark:border-gray-700 px-4 py-3 flex justify-between items-center">
                <h2 class="font-semibold flex items-center">
                    <i class="fas fa-file-contract text-bangala mr-2"></i>
                    Rapot Kinerja Guru
                </h2>
                <button
                    class="text-sm bg-bangala text-white px-3 py-1 rounded-lg hover:bg-bangala/90 transition flex items-center">
                    <i class="fas fa-file-export mr-2"></i> Unduh
                </button>
            </div>

            <div class="p-4">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-medium">Semester {{ $semester }} {{ $tahun_ajaran }}</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Nama Guru: {{ $guru_nama }}
                        </p>
                    </div>
                    {{-- <div class="text-right">
                        <span class="text-xs text-gray-500 dark:text-gray-400">Tanggal Penilaian:</span>
                        <p class="text-sm font-medium">28 Mei 2024</p>
                    </div> --}}
                </div>

                <!-- Assessment Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left border-b border-gray-200 dark:border-gray-700">
                                <th class="pb-2 font-medium">No</th>
                                <th class="pb-2 font-medium">Aspek Penilaian</th>
                                <th class="pb-2 font-medium text-center">Nilai</th>
                                <th class="pb-2 font-medium text-center">Kategori</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            <!-- 1. Kedisiplinan -->
                            <tr>
                                <td class="py-3 font-medium">1</td>
                                <td class="py-3">Kedisiplinan</td>
                                <td class="py-3 text-center font-bold">37</td>
                                <td class="py-3 text-center">
                                    <span
                                        class="px-2 py-1 bg-red-100 dark:bg-red-900/20 text-red-800 dark:text-red-300 rounded-full text-xs">KURANG</span>
                                </td>
                            </tr>

                            <!-- 2. Loyalitas -->
                            <tr>
                                <td class="py-3 font-medium">2</td>
                                <td class="py-3">Loyalitas</td>
                                <td class="py-3 text-center font-bold">83</td>
                                <td class="py-3 text-center">
                                    <span
                                        class="px-2 py-1 bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-300 rounded-full text-xs">BAIK</span>
                                </td>
                            </tr>

                            <!-- 3. Supervisi Adm -->
                            <tr>
                                <td class="py-3 font-medium">3</td>
                                <td class="py-3">Supervisi Adm Pendidik/Tenaga Pendidik</td>
                                <td class="py-3 text-center font-bold">78</td>
                                <td class="py-3 text-center">
                                    <span
                                        class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-300 rounded-full text-xs">CUKUP</span>
                                </td>
                            </tr>

                            <!-- 4. Supervisi Kelas -->
                            <tr>
                                <td class="py-3 font-medium">4</td>
                                <td class="py-3">Supervisi Kelas</td>
                                <td class="py-3 text-center font-bold">10</td>
                                <td class="py-3 text-center">
                                    <span
                                        class="px-2 py-1 bg-red-100 dark:bg-red-900/20 text-red-800 dark:text-red-300 rounded-full text-xs">KURANG</span>
                                </td>
                            </tr>

                            <!-- 5. Prestasi Kerja -->
                            <tr>
                                <td class="py-3 font-medium">5</td>
                                <td class="py-3">Prestasi Kerja Tugas Tambahan</td>
                                <td class="py-3 text-center font-bold">-</td>
                                <td class="py-3 text-center">-</td>
                            </tr>

                            <!-- 5a. Wali Kelas -->
                            <tr>
                                <td class="pl-8 py-2 text-gray-500">a.</td>
                                <td class="py-2">Wali Kelas/Pendamping</td>
                                <td class="py-2 text-center">-</td>
                                <td class="py-2 text-center">-</td>
                            </tr>

                            <!-- 5b. Pembina Ekstra -->
                            <tr>
                                <td class="pl-8 py-2 text-gray-500">b.</td>
                                <td class="py-2">Pembina Ekstrakurikuler</td>
                                <td class="py-2 text-center font-bold">78</td>
                                <td class="py-2 text-center">
                                    <span
                                        class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-300 rounded-full text-xs">CUKUP</span>
                                </td>
                            </tr>

                            <!-- 5c. Wakasek -->
                            <tr>
                                <td class="pl-8 py-2 text-gray-500">c.</td>
                                <td class="py-2">Wakasek/Koordinator</td>
                                <td class="py-2 text-center">-</td>
                                <td class="py-2 text-center">-</td>
                            </tr>

                            <!-- 5d. Guru THQ -->
                            <tr>
                                <td class="pl-8 py-2 text-gray-500">d.</td>
                                <td class="py-2">Guru THQ</td>
                                <td class="py-2 text-center">-</td>
                                <td class="py-2 text-center">-</td>
                            </tr>

                            <!-- 6. Tanggungjawab -->
                            <tr>
                                <td class="py-3 font-medium">6</td>
                                <td class="py-3">Tanggungjawab</td>
                                <td class="py-3 text-center font-bold">80</td>
                                <td class="py-3 text-center">
                                    <span
                                        class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-300 rounded-full text-xs">CUKUP</span>
                                </td>
                            </tr>

                            <!-- 7. Ketaatan -->
                            <tr>
                                <td class="py-3 font-medium">7</td>
                                <td class="py-3">Ketaatan</td>
                                <td class="py-3 text-center font-bold">70</td>
                                <td class="py-3 text-center">
                                    <span
                                        class="px-2 py-1 bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-300 rounded-full text-xs">BAIK</span>
                                </td>
                            </tr>

                            <!-- 8. Kerjasama -->
                            <tr>
                                <td class="py-3 font-medium">8</td>
                                <td class="py-3">Kerjasama</td>
                                <td class="py-3 text-center font-bold">80</td>
                                <td class="py-3 text-center">
                                    <span
                                        class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-300 rounded-full text-xs">CUKUP</span>
                                </td>
                            </tr>

                            <!-- 9. Prakarsa -->
                            <tr>
                                <td class="py-3 font-medium">9</td>
                                <td class="py-3">Prakarsa</td>
                                <td class="py-3 text-center font-bold">80</td>
                                <td class="py-3 text-center">
                                    <span
                                        class="px-2 py-1 bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-300 rounded-full text-xs">BAIK</span>
                                </td>
                            </tr>

                            <!-- 10. Kesalehan -->
                            <tr>
                                <td class="py-3 font-medium">10</td>
                                <td class="py-3">Kesalehan</td>
                                <td class="py-3 text-center font-bold">70</td>
                                <td class="py-3 text-center">
                                    <span
                                        class="px-2 py-1 bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-300 rounded-full text-xs">BAIK</span>
                                </td>
                            </tr>

                            <!-- 11. Tahsin -->
                            <tr>
                                <td class="py-3 font-medium">11</td>
                                <td class="py-3">Tahsin Dan Tahfidz</td>
                                <td class="py-3 text-center font-bold">77</td>
                                <td class="py-3 text-center">
                                    <span
                                        class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-300 rounded-full text-xs">CUKUP</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-xs border border-gray-100 dark:border-gray-700 p-4">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <!-- Left Section - Title -->
                        <div>
                            <h3 class="font-medium text-gray-800 dark:text-white">Ringkasan Penilaian</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Total nilai seluruh aspek</p>
                        </div>

                        <!-- Right Section - Metrics -->
                        <div class="flex divide-x divide-gray-200 dark:divide-gray-700">
                            <!-- Total Score -->
                            <div class="px-4 text-center">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Total</p>
                                <p class="text-xl font-bold text-bangala dark:text-goldspel">732</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">/1100</p>
                            </div>

                            <!-- Average -->
                            <div class="px-4 text-center">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Rata-rata</p>
                                <p class="text-xl font-bold text-gray-800 dark:text-white">66.5</p>
                            </div>

                            <!-- Rating -->
                            <div class="px-4 text-center">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Predikat</p>
                                <p
                                    class="text-sm font-medium px-2 py-1 bg-bangala/10 dark:bg-goldspel/20 text-bangala dark:text-goldspel rounded-full">
                                    CUKUP</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
