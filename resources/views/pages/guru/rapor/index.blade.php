@extends('layouts.guru')
@section('title', 'Rapor Guru')
@section('description', 'Rapor Guru')
@section('content')
    <div class="max-w-6xl mx-auto space-y-6 p-4">

        <!-- Teacher Search & Info Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
            <!-- Responsive Search Bar -->
            <div class="relative">
                <div class="flex flex-col sm:flex-row sm:items-center sm:gap-3 gap-3 mb-4">
                    <div class="w-full">
                        <select id="guru"
                            class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-lg focus:ring-2 focus:ring-bangala focus:bg-white dark:focus:bg-gray-600 transition-all duration-200 text-sm">
                        </select>
                    </div>
                    <div class="w-full">
                        <select id="tahun_ajaran"
                            class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-lg focus:ring-2 focus:ring-bangala focus:bg-white dark:focus:bg-gray-600 transition-all duration-200 text-sm">
                            @foreach (tahunAjaranTerakhir() as $tahun)
                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <select id="semester"
                            class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-lg focus:ring-2 focus:ring-bangala focus:bg-white dark:focus:bg-gray-600 transition-all duration-200 text-sm">
                            <option value="ganjil" @if (semesterSekarang() == 'ganjil') selected @endif>Ganjil</option>
                            <option value="genap" @if (semesterSekarang() == 'genap') selected @endif>Genap</option>
                        </select>
                    </div>
                    <div class="w-full sm:w-auto">
                        <button id="generate-pdf"
                            class="w-full sm:w-auto text-sm bg-bangala text-white px-3 py-2 rounded-lg hover:bg-bangala/90 transition flex items-center justify-center">
                            <i class="fas fa-file-export mr-2"></i> Unduh
                        </button>
                    </div>
                </div>
            </div>

            <!-- Minimalist Teacher Info -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 transition-all duration-300" id="teacher-info">
                <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                    <!-- Teacher Details -->
                    <div class="flex-1 min-w-0">
                        <div class="mt-1.5 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2 text-sm">
                            <div class="truncate">
                                <span class="text-gray-500 dark:text-gray-400">Nama :</span>
                                <span class="font-medium text-gray-700 dark:text-gray-300 ml-1 truncate"
                                    id="nama">-</span>
                            </div>
                            <div class="truncate">
                                <span class="text-gray-500 dark:text-gray-400">NIP :</span>
                                <span class="font-medium text-gray-700 dark:text-gray-300 ml-1 truncate"
                                    id="nip">-</span>
                            </div>
                            <div class="truncate">
                                <span class="text-gray-500 dark:text-gray-400">Jabatan :</span>
                                <span class="font-medium text-gray-700 dark:text-gray-300 ml-1 truncate"
                                    id="jabatan">-</span>
                            </div>
                            <div class="truncate">
                                <span class="text-gray-500 dark:text-gray-400">Status : </span>
                                <span class="px-2 py-1 rounded-full text-xs" id="status">-</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rating Guide -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700">
            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Panduan Penilaian</h4>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-5 sm:gap-3">
                <!-- Kurang Sekali -->
                <div class="flex items-center gap-2 p-3 bg-red-50 dark:bg-red-900/20 rounded-lg">
                    <div
                        class="text-xs sm:text-sm font-bold bg-red-500 text-white px-2 py-1 rounded sm:rounded-lg sm:w-10 sm:h-10 sm:flex sm:items-center sm:justify-center">
                        ≤50
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm sm:text-base font-semibold text-red-700 dark:text-red-400 truncate">Kurang
                            Sekali</div>
                        <div class="text-xs text-red-600/80 dark:text-red-400/80 truncate">Perlu peningkatan</div>
                    </div>
                </div>

                <!-- Kurang -->
                <div class="flex items-center gap-2 p-3 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                    <div
                        class="text-xs sm:text-sm font-bold bg-orange-500 text-white px-2 py-1 rounded sm:rounded-lg sm:w-10 sm:h-10 sm:flex sm:items-center sm:justify-center">
                        51-68
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm sm:text-base font-semibold text-orange-700 dark:text-orange-400 truncate">Kurang
                        </div>
                        <div class="text-xs text-orange-600/80 dark:text-orange-400/80 truncate">Sudah memadai</div>
                    </div>
                </div>

                <!-- Cukup -->
                <div class="flex items-center gap-2 p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                    <div
                        class="text-xs sm:text-sm font-bold bg-yellow-500 text-white px-2 py-1 rounded sm:rounded-lg sm:w-10 sm:h-10 sm:flex sm:items-center sm:justify-center">
                        69-78
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm sm:text-base font-semibold text-yellow-700 dark:text-yellow-400 truncate">Cukup
                        </div>
                        <div class="text-xs text-yellow-600/80 dark:text-yellow-400/80 truncate">Memadai</div>
                    </div>
                </div>

                <!-- Baik -->
                <div class="flex items-center gap-2 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <div
                        class="text-xs sm:text-sm font-bold bg-blue-500 text-white px-2 py-1 rounded sm:rounded-lg sm:w-10 sm:h-10 sm:flex sm:items-center sm:justify-center">
                        79-88
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm sm:text-base font-semibold text-blue-700 dark:text-blue-400 truncate">Baik</div>
                        <div class="text-xs text-blue-600/80 dark:text-blue-400/80 truncate">Di atas rata-rata</div>
                    </div>
                </div>

                <!-- Sangat Baik -->
                <div class="flex items-center gap-2 p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                    <div
                        class="text-xs sm:text-sm font-bold bg-green-500 text-white px-2 py-1 rounded sm:rounded-lg sm:w-10 sm:h-10 sm:flex sm:items-center sm:justify-center">
                        ≥89
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm sm:text-base font-semibold text-green-700 dark:text-green-400 truncate">Sangat
                            Baik</div>
                        <div class="text-xs text-green-600/80 dark:text-green-400/80 truncate">Luar biasa</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6" id="data-form">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function loadData(guru, semester, tahun_ajaran) {

                const tahunAjar = tahun_ajaran.replace(/\//g, '-');

                $.ajax({
                    url: `/guru/rapor/${guru}/${semester}/${tahunAjar}`,
                    type: 'GET',
                    success: function(res) {
                        $('#data-form').html(res.data.view);
                    },
                    error: function() {
                        errorToast('Gagal memuat data.');
                    }
                });
            }

            loadSelectOptions('#guru', '{{ route('guru.guru.index') }}');

            $(document).on('click', '#generate-pdf', function(e) {
                e.preventDefault();

                const semester = $('#semester').val();
                const tahun_ajaran = $('#tahun_ajaran').val();
                const id = $('#guru').val();

                const tahunAjar = tahun_ajaran.replace(/\//g, '-');

                if (!semester || !tahunAjar || !id) {
                    alert('Semester, Tahun Ajaran, dan Guru harus dipilih.');
                    return;
                }

                const url = `/guru/rapor/${semester}/${tahunAjar}/${id}/pdf`;

                // Arahkan browser ke URL (download atau tampilkan PDF)
                window.open(url, '_blank');
            });


            function refreshGuruDetail() {
                const id = $('#guru').val();
                const semester = $('#semester').val();
                const tahun_ajaran = $('#tahun_ajaran').val();

                if (!id) {
                    console.warn('Guru belum dipilih');
                    return;
                }

                const url = `/guru/guru/${id}`;

                ajaxCall(
                    url,
                    'GET',
                    null,
                    function(res) {
                        console.log(res);
                        res = res.data;

                        // Tampilkan jabatannya
                        const jabatans = res.jabatans
                            .map(j => formatJabatan(j.jabatan.jabatan))
                            .join(', ');

                        $('#nama').text(res.nama);
                        $('#nip').text(res.nip);
                        $('#jabatan').text(jabatans);

                        // Status badge
                        const $status = $('#status');
                        if (res.status == 1) {
                            $status
                                .removeClass('bg-red-100 bg-red-900/30 text-red-800 text-red-300')
                                .addClass('bg-green-100 bg-green-900/30 text-green-800 text-green-300')
                                .text('Aktif');
                        } else {
                            $status
                                .removeClass('bg-green-100 bg-green-900/30 text-green-800 text-green-300')
                                .addClass('bg-red-100 bg-red-900/30 text-red-800 text-red-300')
                                .text('Tidak Aktif');
                        }

                        // Panggil fungsi loadData yang sudah ada
                        loadData(id, semester, tahun_ajaran);
                    },
                    function(err) {
                        console.error(err);
                    }
                );
            }

            // ONE handler untuk semua select
            $(document).on('change', '#guru, #semester, #tahun_ajaran', function(e) {
                e.preventDefault();
                refreshGuruDetail();
            });
        });
    </script>
@endsection
