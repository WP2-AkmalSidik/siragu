
<!-- Summary Cards -->
<div class="grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
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

    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Guru Berprestasi</p>
                <p class="text-2xl font-bold text-goldspel">{{ $excellent_teachers }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">≥85
                    ({{ round(($excellent_teachers / count($result)) * 100) }}% dari total)</p>
            </div>
            <div class="w-10 h-10 bg-goldspel/10 rounded-full flex items-center justify-center">
                <i class="fas fa-star text-goldspel"></i>
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
<div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700 mb-6">
    <div class="p-4 border-b border-gray-100 dark:border-gray-700">
        <h2 class="text-lg font-semibold">Detail Penilaian</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Hasil penilaian per aspek</p>
    </div>
    <div class="p-4">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-100 dark:border-gray-700">
                        <th class="pb-2">Aspek Penilaian</th>
                        <th class="pb-2 text-right">Rata-rata</th>
                        <th class="pb-2 text-right">Jumlah Penilaian</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach ($result as $item)
                        <tr>
                            <td class="py-3">
                                <p class="font-medium">{{ $item->form_nama }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->keterangan }}</p>
                            </td>
                            <td class="py-3 text-right">
                                <div class="flex items-center justify-end">
                                    <span class="font-medium">{{ $item->rata_nilai }}</span>
                                    <div class="ml-2 w-16 bg-gray-100 dark:bg-gray-700 rounded-full h-2">
                                        <div class="bg-bangala h-2 rounded-full"
                                            style="width: {{ $item->rata_nilai }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 text-right">{{ $item->total_penilaian }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
