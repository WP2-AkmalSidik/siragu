@extends('layouts.guru')
@section('title', 'Dashboard')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')

    <main class="max-w-6xl mx-auto px-4 py-4">

        <!-- Teacher Profile Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-y-4 mb-6">
            <!-- Text Bagian Kiri -->
            <div class="text-sm md:text-base">
                <input type="hidden" id="jabatan" value='@json(auth()->user()->jabatans->pluck('jabatan.jabatan'))'>
                <h1 class="text-lg md:text-xl font-semibold">Halo, {{ auth()->user()->nama }}</h1>
                <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400">
                    @foreach (auth()->user()->jabatans as $jabatan)
                        {{ toTitleCase($jabatan->jabatan->jabatan) . ', ' }}
                    @endforeach
                </p>
            </div>



            <!-- Filter Dropdown Bagian Kanan -->
            <div class="grid mt-2 grid-cols-2 gap-3 md:flex md:gap-4 md:justify-end">
                <!-- Tahun Ajaran -->
                <div class="relative">
                    <select id="tahun_ajaran"
                        class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-lg focus:ring-2 focus:ring-bangala focus:bg-white dark:focus:bg-gray-600 transition-all duration-200 text-xs md:text-sm">
                        @foreach (tahunAjaranTerakhir() as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                    <i
                        class="fa-solid fa-calendar-days absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-xs md:text-sm"></i>
                </div>

                <!-- Semester -->
                <div class="relative">
                    <select id="semester"
                        class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-lg focus:ring-2 focus:ring-bangala focus:bg-white dark:focus:bg-gray-600 transition-all duration-200 text-xs md:text-sm">
                        <option value="ganjil" @if (semesterSekarang() == 'ganjil') selected @endif>Ganjil</option>
                        <option value="genap" @if (semesterSekarang() == 'genap') selected @endif>Genap</option>
                    </select>
                    <i
                        class="fa-solid fa-calendar-week absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-xs md:text-sm"></i>
                </div>
            </div>
        </div>
        <div id="report-container"></div>
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

            function initTargetChart(labels, values) {
                const ctx = document.getElementById('targetChart').getContext('2d');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Rata-rata Nilai',
                            data: values,
                            backgroundColor: '#667eea',
                            borderColor: '#667eea',
                            borderWidth: 1,
                            borderRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return 'Rata-rata: ' + context.parsed.y.toFixed(1);
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
                                min: 0,
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
                        }
                    }
                });
            }

            function initChart(labels, nilaiPerSemester, overallAverage) {

                console.log(nilaiPerSemester, overallAverage)
                const ctx = document.getElementById('trendChart').getContext('2d');

                if (trendChart) trendChart.destroy();

                trendChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Rata-rata Sekolah',
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
                        }, ]
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
                                min: 0,
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

                const tahunAjar = tahun_ajaran.replace(/\//g, '-');

                const jabatanRaw = $('#jabatan').val();
                const jabatanArray = JSON.parse(jabatanRaw);

                // Cek apakah ada 'kepala_sekolah' atau 'wakasek'
                const adaKepalaOrWakasek = jabatanArray.includes('kepala_sekolah') || jabatanArray.includes(
                    'wakasek');

                console.log(adaKepalaOrWakasek)

                let url;

                if (adaKepalaOrWakasek) {
                    url = `/guru/dashboard/${semester}/${tahunAjar}`
                } else {
                    url = `/guru/rapor/${semester}/${tahunAjar}`
                }

                console.log(url);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(res) {
                        if (adaKepalaOrWakasek) {
                            if (res.success) {
                                $('#report-container').html(res.data.view);

                                const chart = res.data.chart;

                                console.log(res.chart_target)

                                initChart(chart.labels, chart.values, chart.overall_average);
                                initTargetChart(res.data.chart_target.labels, res.data
                                    .chart_target.values);

                            } else {
                                showError(res.message || 'Gagal memuat data');
                            }
                        } else{
                            $('#report-container').html(res.data.view);
                        }
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
