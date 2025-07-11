@extends('layouts.guru')
@section('title', 'Penilaian Guru')
@section('description', 'Form Penilaian Kinerja Guru')
@push('styles')
    <style>
        /* ... (keep all your existing styles) ... */

        .loading-spinner {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            border: 3px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            border-top-color: #667eea;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush
@section('content')

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-4">

        <div class="flex items-center justify-between mb-6 mobile-stack mobile-space-y-2">
            <div class="mobile-full-width mobile-text-center sm:text-left">
                <h1 class="text-xl font-semibold">Statistik Penilaian Guru</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Analisis Kinerja Guru SMP • Semester Ganjil 2024/2025</p>
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

        <div id="report-container"></div>
    </main>

@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize chart variable
            let trendChart = null;

            // Format tahun ajaran for URL (replace / with -)
            function formatTahunAjaran(tahun) {
                return tahun.replace(/\//g, '-');
            }

            // Show error message
            function showError(message) {
                $('#report-container').html(`
                    <div class="text-center py-8 text-red-500">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        ${message}
                    </div>
                `);
            }

            // Initialize chart
            function initChart(labels, data) {
                const ctx = document.getElementById('trendChart').getContext('2d');

                if (trendChart) {
                    trendChart.destroy();
                }

                trendChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Rata-rata Nilai',
                            data: data,
                            borderColor: '#667eea',
                            backgroundColor: 'rgba(102, 126, 234, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#ef4444',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20,
                                    font: {
                                        size: 12
                                    }
                                }
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                borderColor: '#667eea',
                                borderWidth: 1,
                                cornerRadius: 8,
                                displayColors: true,
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ' + context.parsed.y.toFixed(
                                            1);
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#6b7280',
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            y: {
                                beginAtZero: false,
                                min: 70,
                                max: 100,
                                grid: {
                                    color: 'rgba(107, 114, 128, 0.1)'
                                },
                                ticks: {
                                    color: '#6b7280',
                                    font: {
                                        size: 11
                                    },
                                    callback: function(value) {
                                        return value.toFixed(0);
                                    }
                                }
                            }
                        },
                        interaction: {
                            mode: 'nearest',
                            axis: 'x',
                            intersect: false
                        },
                        elements: {
                            point: {
                                hoverBackgroundColor: '#fff'
                            }
                        }
                    }
                });
            }

            // Load data via AJAX
            function loadData(semester, tahun_ajaran) {
                const formattedTahun = formatTahunAjaran(tahun_ajaran);

                $.ajax({
                    url: `/guru/statistik/${semester}/${formattedTahun}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#report-container').html(response.data.view);

                            // Reinitialize chart with new data
                            const currentSemester = $('#semester').val();
                            const currentTahun = $('#tahun_ajaran').val();
                            const labels = [
                                'Sem Ganjil 22/23',
                                'Sem Genap 22/23',
                                'Sem Ganjil 23/24',
                                'Sem Genap 23/24',
                                `Sem ${currentSemester.charAt(0).toUpperCase() + currentSemester.slice(1)} ${currentTahun}`
                            ];

                            const data = [85.2, 86.8, 87.5, 87.2, response.data.data.overall_average];
                            initChart(labels, data);
                        } else {
                            showError(response.message || 'Gagal memuat data');
                        }
                    },
                    error: function(xhr) {
                        showError(xhr.responseJSON?.message || 'Terjadi kesalahan saat memuat data');
                    }
                });
            }

            // Event handlers
            $(document)
                .on('change', '#tahun_ajaran', function() {
                    const semester = $('#semester').val();
                    const tahun_ajaran = $(this).val();
                    loadData(semester, tahun_ajaran);
                })
                .on('change', '#semester', function() {
                    const semester = $(this).val();
                    const tahun_ajaran = $('#tahun_ajaran').val();
                    loadData(semester, tahun_ajaran);
                });

            // Initial load
            const initialTahun = $('#tahun_ajaran').val();
            const initialSemester = $('#semester').val();

            loadData(initialSemester, initialTahun);
        });
    </script>
@endpush
