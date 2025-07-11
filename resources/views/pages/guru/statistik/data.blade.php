<!-- Summary Cards -->
<div class="grid grid-cols-1 xs:grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Rata-rata Keseluruhan</p>
                <p class="text-2xl font-bold text-bangala">{{ $overall_average }}</p>
                <p class="text-xs text-green-600 dark:text-green-400 flex items-center mt-1">
                    <i class="fas fa-arrow-up mr-1"></i> +2.1 dari semester lalu
                </p>
            </div>
            <div class="w-10 h-10 bg-bangala/10 rounded-full flex items-center justify-center">
                <i class="fas fa-chart-line text-bangala"></i>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Nilai Tertinggi</p>
                <p class="text-2xl font-bold text-green-600">{{ $highest_score }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $guru_nama }}</p>
            </div>
            <div class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center">
                <i class="fas fa-trophy text-green-600"></i>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Nilai Terendah</p>
                <p class="text-2xl font-bold text-red-600">{{ $lowest_score }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Perlu Pembinaan</p>
            </div>
            <div class="w-10 h-10 bg-red-100 dark:bg-red-900/20 rounded-full flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
        </div>
    </div>
</div>

<!-- Chart Section -->
<div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700 mb-6">
    <div class="p-4 border-b border-gray-100 dark:border-gray-700">
        <h2 class="text-lg font-semibold">Trend Penilaian Per Semester</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Pergerakan rata-rata nilai kinerja guru</p>
    </div>
    <div class="p-4">
        <div class="chart-container">
            <canvas id="trendChart"></canvas>
        </div>
    </div>
</div>

<!-- Assessment Results -->
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm mb-6">
    <!-- Header -->
    <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Detail Penilaian</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Hasil penilaian per aspek</p>
    </div>

    <!-- Table Container -->
    <div class="p-4">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-gray-700 dark:text-gray-200">
                <thead>
                    <tr class="text-left border-b border-gray-100 dark:border-gray-700 text-xs uppercase tracking-wide">
                        <th class="pb-3">Aspek Penilaian</th>
                        <th class="pb-3 text-center">Jumlah Aspek Penilaian</th>
                        <th class="pb-3 text-center">Rata-rata</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach ($result as $item)
                        <tr>
                            <!-- Aspek Penilaian -->
                            <td class="py-3 w-full max-w-xs">
                                <div>
                                    <p class="font-medium text-gray-800 dark:text-white">{{ $item->form_nama }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $item->keterangan }}</p>
                                </div>
                            </td>

                            <!-- Jumlah Penilaian -->
                            <td class="py-3 text-center whitespace-nowrap">
                                {{ $item->total_penilaian }}
                            </td>

                            <!-- Rata-rata -->
                            <td class="py-3 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <span class="font-semibold">{{ $item->rata_nilai }}</span>
                                    <div class="w-20 h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                        <div class="h-full bg-bangala rounded-full"
                                            style="width: {{ $item->rata_nilai }}%"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
