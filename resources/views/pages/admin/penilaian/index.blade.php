@extends('layouts.admin')
@section('title', 'Penilaian Guru')
@section('description', 'Form Penilaian Guru')
@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md">
        <!-- Informasi Guru yang Dinilai -->
        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 mb-6">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-bangala rounded-full flex items-center justify-center">
                    <span class="text-white font-medium">SA</span>
                </div>
                <div>
                    <h4 class="font-medium text-gray-900 dark:text-white">Nama Guru:</h4>
                    <input type="text" id="teacher-name" placeholder="Pilih nama guru"
                        class="bg-transparent border-b border-gray-300 dark:border-gray-600 focus:outline-none focus:border-bangala w-full py-1">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Mata Pelajaran: <span id="teacher-subject" class="text-gray-700 dark:text-gray-300">-</span></p>
                </div>
            </div>
        </div>

        <!-- Form Penilaian -->
        <form id="teacher-evaluation-form">
            <!-- Bagian 1: Kompetensi Pedagogik -->
            <div class="mb-8">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 border-b pb-2 border-gray-200 dark:border-gray-700">1. Kompetensi Pedagogik</h4>

                <!-- Pertanyaan 1.1 -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">1.1. Penguasaan terhadap karakteristik peserta didik</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                        <div>
                            <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Sub 1.1.1 Memahami karakteristik peserta didik</label>
                            <select name="pedagogik_1_1_1" class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                                <option value="">Pilih Nilai</option>
                                <option value="1">1 (Buruk)</option>
                                <option value="2">2 (Cukup)</option>
                                <option value="3">3 (Baik)</option>
                                <option value="4">4 (Sangat Baik)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Sub 1.1.2 Menganalisis kebutuhan belajar peserta didik</label>
                            <select name="pedagogik_1_1_2" class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                                <option value="">Pilih Nilai</option>
                                <option value="1">1 (Buruk)</option>
                                <option value="2">2 (Cukup)</option>
                                <option value="3">3 (Baik)</option>
                                <option value="4">4 (Sangat Baik)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Pertanyaan 1.2 -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">1.2. Penguasaan teori belajar dan prinsip-prinsip pembelajaran</label>
                    <select name="pedagogik_1_2" class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala mb-2">
                        <option value="">Pilih Nilai</option>
                        <option value="1">1 (Buruk)</option>
                        <option value="2">2 (Cukup)</option>
                        <option value="3">3 (Baik)</option>
                        <option value="4">4 (Sangat Baik)</option>
                    </select>
                </div>
            </div>

            <!-- Bagian 2: Kompetensi Kepribadian -->
            <div class="mb-8">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 border-b pb-2 border-gray-200 dark:border-gray-700">2. Kompetensi Kepribadian</h4>

                <!-- Pertanyaan 2.1 -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">2.1. Bersikap sesuai dengan norma agama, hukum, sosial, dan kebudayaan nasional</label>
                    <select name="kepribadian_2_1" class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala mb-2">
                        <option value="">Pilih Nilai</option>
                        <option value="1">1 (Buruk)</option>
                        <option value="2">2 (Cukup)</option>
                        <option value="3">3 (Baik)</option>
                        <option value="4">4 (Sangat Baik)</option>
                    </select>
                </div>

                <!-- Pertanyaan 2.2 -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">2.2. Menunjukkan pribadi yang dewasa dan teladan</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Sub 2.2.1 Keteladanan dalam berperilaku</label>
                            <select name="kepribadian_2_2_1" class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                                <option value="">Pilih Nilai</option>
                                <option value="1">1 (Buruk)</option>
                                <option value="2">2 (Cukup)</option>
                                <option value="3">3 (Baik)</option>
                                <option value="4">4 (Sangat Baik)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Sub 2.2.2 Etos kerja</label>
                            <select name="kepribadian_2_2_2" class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                                <option value="">Pilih Nilai</option>
                                <option value="1">1 (Buruk)</option>
                                <option value="2">2 (Cukup)</option>
                                <option value="3">3 (Baik)</option>
                                <option value="4">4 (Sangat Baik)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian 3: Kompetensi Sosial -->
            <div class="mb-8">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 border-b pb-2 border-gray-200 dark:border-gray-700">3. Kompetensi Sosial</h4>

                <!-- Pertanyaan 3.1 -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">3.1. Berkomunikasi secara efektif dengan peserta didik</label>
                    <select name="sosial_3_1" class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala mb-2">
                        <option value="">Pilih Nilai</option>
                        <option value="1">1 (Buruk)</option>
                        <option value="2">2 (Cukup)</option>
                        <option value="3">3 (Baik)</option>
                        <option value="4">4 (Sangat Baik)</option>
                    </select>
                </div>

                <!-- Pertanyaan 3.2 -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">3.2. Berkomunikasi secara efektif dengan sesama guru dan tenaga kependidikan</label>
                    <select name="sosial_3_2" class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala mb-2">
                        <option value="">Pilih Nilai</option>
                        <option value="1">1 (Buruk)</option>
                        <option value="2">2 (Cukup)</option>
                        <option value="3">3 (Baik)</option>
                        <option value="4">4 (Sangat Baik)</option>
                    </select>
                </div>
            </div>

            <!-- Bagian 4: Kompetensi Profesional -->
            <div class="mb-8">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 border-b pb-2 border-gray-200 dark:border-gray-700">4. Kompetensi Profesional</h4>

                <!-- Pertanyaan 4.1 -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">4.1. Penguasaan materi pelajaran</label>
                    <select name="profesional_4_1" class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala mb-2">
                        <option value="">Pilih Nilai</option>
                        <option value="1">1 (Buruk)</option>
                        <option value="2">2 (Cukup)</option>
                        <option value="3">3 (Baik)</option>
                        <option value="4">4 (Sangat Baik)</option>
                    </select>
                </div>

                <!-- Pertanyaan 4.2 -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">4.2. Pengembangan keprofesian melalui tindakan reflektif</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Sub 4.2.1 Melakukan penelitian tindakan kelas</label>
                            <select name="profesional_4_2_1" class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                                <option value="">Pilih Nilai</option>
                                <option value="1">1 (Buruk)</option>
                                <option value="2">2 (Cukup)</option>
                                <option value="3">3 (Baik)</option>
                                <option value="4">4 (Sangat Baik)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Sub 4.2.2 Mengikuti perkembangan ilmu pengetahuan</label>
                            <select name="profesional_4_2_2" class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                                <option value="">Pilih Nilai</option>
                                <option value="1">1 (Buruk)</option>
                                <option value="2">2 (Cukup)</option>
                                <option value="3">3 (Baik)</option>
                                <option value="4">4 (Sangat Baik)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Catatan dan Submit -->
            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 mb-6">
                <label class="block text-gray-700 dark:text-gray-300 mb-2">Catatan Tambahan</label>
                <textarea name="catatan" rows="3" class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala"></textarea>

                <div class="flex justify-between items-center mt-4">
                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Total Nilai:</span>
                        <span id="total-nilai" class="ml-2 text-lg font-bold text-goldspel">0</span>
                    </div>
                    <button type="submit" class="px-6 py-2 bg-bangala text-white rounded-lg hover:bg-bangala/90 transition">
                        <i class="fas fa-save mr-2"></i>Simpan Penilaian
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
