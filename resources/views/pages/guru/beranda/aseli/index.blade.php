@extends('layouts.guru')
@section('title', 'Dashboard')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')

    <main class="max-w-6xl mx-auto px-4 py-4">

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="border-b border-gray-100 dark:border-gray-700 px-4 py-3">
                <h2 class="font-semibold flex items-center">
                    <i class="fas fa-history text-bangala mr-2"></i>
                    Aktivitas Terkini
                </h2>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                <div class="px-4 py-3 flex items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/20 flex items-center justify-center text-green-600 dark:text-green-400 mr-3">
                        <i class="fas fa-check text-xs"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm">Mengisi formulir penilaian kesolehan</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Hari ini, 14:30</p>
                    </div>
                </div>
                <div class="px-4 py-3 flex items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400 mr-3">
                        <i class="fas fa-edit text-xs"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm">Rapor semester Genap Sudah diisi</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Kemarin, 16:45</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Teacher Profile Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl font-semibold">Halo, {{ auth()->user()->nama }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    @foreach (auth()->user()->jabatans as $jabatan)
                        {{ toTitleCase($jabatan->jabatan->jabatan) . ', ' }}
                    @endforeach
                </p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold text-bangala">80%</div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Progress Penilaian</p>
            </div>
        </div>

        <!-- Quick Actions Grid -->
        <div class="grid grid-cols-4 gap-3 mb-6">
            <!-- Supervisi Kelas -->
            <a href="/super-visi"
                class="dashboard-card bg-white dark:bg-gray-800 rounded-lg p-3 text-center shadow-xs border border-gray-100 dark:border-gray-700 hover:border-bangala transition-colors">
                <div
                    class="w-10 h-10 bg-blue-100 dark:bg-blue-900/20 rounded-full flex items-center justify-center text-blue-600 dark:text-blue-400 mx-auto mb-2">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <span class="text-xs font-medium">Supervisi</span>
            </a>

            <!-- Kesolehan Guru -->
            <a href="/kesolehan"
                class="dashboard-card bg-white dark:bg-gray-800 rounded-lg p-3 text-center shadow-xs border border-gray-100 dark:border-gray-700 hover:border-green-500 transition-colors">
                <div
                    class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center text-green-600 dark:text-green-400 mx-auto mb-2">
                    <i class="fas fa-pray"></i>
                </div>
                <span class="text-xs font-medium">Kesolehan</span>
            </a>

            <!-- Raport -->
            <a href="#"
                class="dashboard-card bg-white dark:bg-gray-800 rounded-lg p-3 text-center shadow-xs border border-gray-100 dark:border-gray-700 hover:border-purple-500 transition-colors">
                <div
                    class="w-10 h-10 bg-purple-100 dark:bg-purple-900/20 rounded-full flex items-center justify-center text-purple-600 dark:text-purple-400 mx-auto mb-2">
                    <i class="fas fa-file-alt"></i>
                </div>
                <span class="text-xs font-medium">Raport</span>
            </a>

            <!-- Jadwal Mengajar -->
            <a href="#"
                class="dashboard-card bg-white dark:bg-gray-800 rounded-lg p-3 text-center shadow-xs border border-gray-100 dark:border-gray-700 hover:border-yellow-500 transition-colors">
                <div
                    class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900/20 rounded-full flex items-center justify-center text-yellow-600 dark:text-yellow-400 mx-auto mb-2">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <span class="text-xs font-medium">Jadwal</span>
            </a>
        </div>
        <!-- Report Card Preview -->
        <div id="report-container"></div>
        <!-- Recent Activity -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="border-b border-gray-100 dark:border-gray-700 px-4 py-3">
                <h2 class="font-semibold flex items-center">
                    <i class="fas fa-history text-bangala mr-2"></i>
                    Aktivitas Terkini
                </h2>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                <div class="px-4 py-3 flex items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/20 flex items-center justify-center text-green-600 dark:text-green-400 mr-3">
                        <i class="fas fa-check text-xs"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm">Mengisi formulir penilaian kesolehan</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Hari ini, 14:30</p>
                    </div>
                </div>
                <div class="px-4 py-3 flex items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400 mr-3">
                        <i class="fas fa-edit text-xs"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm">Rapor semester Genap Sudah diisi</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Kemarin, 16:45</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function loadData(guru, semester, tahun_ajaran) {

                const tahunAjar = tahun_ajaran.replace(/\//g, '-');

                $.ajax({
                    url: `/admin/rapor/${guru}/${semester}/${tahunAjar}`,
                    type: 'GET',
                    success: function(res) {
                        $('#data-form').html(res.data.view);
                    },
                    error: function() {
                        errorToast('Gagal memuat data.');
                    }
                });
            }

            loadSelectOptions('#guru', '{{ route('admin.guru.index') }}');

            $(document).on('change', '#guru', function(e) {
                e.preventDefault();
                const id = $(this).val();
                const semester = $('#semester').val();
                const tahun_ajaran = $('#tahun_ajaran').val();

                const url = `/admin/guru/${id}`;

                const successCallback = function(res) {
                    console.log(res)

                    res = res.data;

                    let jabatans = res.jabatans.map(j => formatJabatan(j.jabatan.jabatan)).join(', ');

                    $('#nama').text(res.nama);
                    $('#nip').text(res.nip);
                    $('#jabatan').text(jabatans);

                    let status;

                    if (res.status == 1) {
                        $('#status')
                            .removeClass('bg-red-100 bg-red-900/30 text-red-800 text-red-300')
                            .addClass('bg-green-100 bg-green-900/30 text-green-800 text-green-300');
                        status = 'Aktif';
                    } else {
                        $('#status')
                            .removeClass('bg-green-100 bg-green-900/30 text-green-800 text-green-300')
                            .addClass('bg-red-100 bg-red-900/30 text-red-800 text-red-300');
                        status = 'Tidak Aktif';
                    }

                    $('#status').text(status);
                    loadData(id, semester, tahun_ajaran);
                }

                const errorCallback = function(err) {
                    console.error(err);
                }

                ajaxCall(url, 'GET', null, successCallback, errorCallback);

            })

        });
    </script>
@endpush
