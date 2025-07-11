@extends('layouts.guru')
@section('title', 'Dashboard')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')

    <main class="max-w-6xl mx-auto px-4 py-4">

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
            <div class="flex gap-4 justify-end mb-4">
                <div class="relative">
                    <select id="tahun_ajaran"
                        class="w-48 pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-lg focus:ring-2 focus:ring-bangala focus:bg-white dark:focus:bg-gray-600 transition-all duration-200 text-sm">
                        @foreach (tahunAjaranTerakhir() as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                    {{-- <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i> --}}
                </div>

                <div class="relative">
                    <select id="semester"
                        class="w-40 pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-lg focus:ring-2 focus:ring-bangala focus:bg-white dark:focus:bg-gray-600 transition-all duration-200 text-sm">
                        <option value="ganjil" @if (semesterSekarang() == 'ganjil') selected @endif>Ganjil</option>
                        <option value="genap" @if (semesterSekarang() == 'genap') selected @endif>Genap</option>
                    </select>
                </div>
            </div>

        </div>

        <!-- Quick Actions Grid -->
        {{-- <div class="grid grid-cols-4 gap-3 mb-6">
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
        </div> --}}
        <!-- Report Card Preview -->
        <div id="report-container"></div>
    </main>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function loadData(semester, tahun_ajaran) {

                const tahunAjar = tahun_ajaran.replace(/\//g, '-');

                $.ajax({
                    url: `/guru/rapor/${semester}/${tahunAjar}`,
                    type: 'GET',
                    success: function(res) {
                        $('#report-container').html(res.data.view);
                    },
                    error: function() {
                        errorToast('Gagal memuat data.');
                    }
                });
            }

            $(document).on('change', '#tahun_ajaran', function(e) {
                e.preventDefault();
                const id = $(this).val();
                const semester = $('#semester').val();
                const tahun_ajaran = $('#tahun_ajaran').val();
                loadData(semester, tahun_ajaran);
            })

            $(document).on('change', '#semester', function(e) {
                e.preventDefault();
                const id = $(this).val();
                const semester = $('#semester').val();
                const tahun_ajaran = $('#tahun_ajaran').val();
                loadData(semester, tahun_ajaran);
            })

            const tahun_ajaran = $('#tahun_ajaran').val();
            const semester = $('#semester').val();

            loadData(semester, tahun_ajaran);
        });
    </script>
@endpush
