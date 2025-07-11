@extends('layouts.guru')

@section('title', 'Penilaian Guru')
@section('description', 'Form Penilaian Kinerja Guru')

@push('styles')
@endpush

@section('content')
    <main class="max-w-6xl mx-auto px-4 py-4">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <!-- Kiri (judul dan deskripsi) -->
            <div class="text-center sm:text-left">
                <h1 class="text-xl font-semibold">Statistik Penilaian Guru</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Analisis Kinerja Guru SMP • Semester
                    <span id="smt-label">{{ ucfirst(semesterSekarang()) }}</span>
                    {{ now()->year }}/{{ now()->year + 1 }}
                </p>
            </div>

            <!-- Kanan (filter select) -->
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center sm:justify-end">
                <div class="relative">
                    <select id="tahun_ajaran"
                        class="w-full sm:w-48 pl-4 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-lg focus:ring-2 focus:ring-bangala focus:bg-white dark:focus:bg-gray-600 transition text-sm">
                        @foreach (tahunAjaranTerakhir() as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="relative">
                    <select id="semester"
                        class="w-full sm:w-40 pl-4 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-lg focus:ring-2 focus:ring-bangala focus:bg-white dark:focus:bg-gray-600 transition text-sm">
                        <option value="ganjil" @if (semesterSekarang() == 'ganjil') selected @endif>Ganjil</option>
                        <option value="genap" @if (semesterSekarang() == 'genap') selected @endif>Genap</option>
                    </select>
                </div>
            </div>
        </div>


        <div class="grid grid-cols-1 gap-4">
            <div id="report-container">

            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let trendChart = null;

            function formatTahunAjaran(tahun) {
                return tahun.replace(/\//g, '-');
            }

            function showError(message) {
                $('#report-container').html(`
                <div class="text-center py-8 text-red-500">
                    <i class="fas fa-exclamation-circle mr-2"></i>${message}
                </div>
            `);
            }

            function initChart(labels, nilaiPerSemester, overallAverage) {
                const ctx = document.getElementById('trendChart').getContext('2d');

                if (trendChart) trendChart.destroy();

                trendChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                                label: 'Rata-rata Nilai',
                                data: nilaiPerSemester,
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
                            },
                            {
                                label: 'Rata-rata Keseluruhan',
                                data: Array(labels.length).fill(overallAverage),
                                borderColor: 'rgba(255, 99, 132, 1)',
                                backgroundColor: 'transparent',
                                borderWidth: 2,
                                pointRadius: 0,
                                fill: false,
                                borderDash: [5, 5]
                            }
                        ]
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
                        }
                    }
                });
            }

            function loadData(semester, tahun_ajaran) {
                const formattedTahun = formatTahunAjaran(tahun_ajaran);

                $.ajax({
                    url: `/guru/statistik/${semester}/${formattedTahun}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#report-container').html(response.data.view);

                            const chart = response.data.chart;

                            initChart(chart.labels, chart.values, chart.overall_average);
                        } else {
                            showError(response.message || 'Gagal memuat data');
                        }
                    },
                    error: function(xhr) {
                        showError(xhr.responseJSON?.message || 'Terjadi kesalahan saat memuat data');
                    }
                });
            }

            $(document)
                .on('change', '#tahun_ajaran', function() {
                    loadData($('#semester').val(), $(this).val());
                })
                .on('change', '#semester', function() {
                    loadData($(this).val(), $('#tahun_ajaran').val());
                });

            loadData($('#semester').val(), $('#tahun_ajaran').val());
        });
    </script>
@endpush
