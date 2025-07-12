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
                {{-- <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $guru_nama }}</p> --}}
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
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Trend Semester -->
    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700">
        <div class="p-4 border-b border-gray-100 dark:border-gray-700">
            <h2 class="text-lg font-semibold">Rata-rata Sekolah Per Semester</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Perkembangan nilai rata-rata seluruh guru</p>
        </div>
        <div class="p-4">
            <div class="chart-container" style="height: 300px;">
                <canvas id="trendChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart Per Target -->
    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700">
        <div class="p-4 border-b border-gray-100 dark:border-gray-700">
            <h2 class="text-lg font-semibold">Penilaian Anda Per Guru</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Rata-rata nilai yang Anda berikan ke setiap guru</p>
        </div>
        <div class="p-4">
            <div class="chart-container" style="height: 300px;">
                <canvas id="targetChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Top and Bottom Performers -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Top 3 -->
    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700">
        <div class="p-4 border-b border-gray-100 dark:border-gray-700 bg-green-50 dark:bg-green-900/20">
            <h2 class="text-lg font-semibold text-green-700 dark:text-green-300">
                <i class="fas fa-trophy mr-2"></i>3 Guru Terbaik
            </h2>
        </div>
        <div class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach ($top3 as $index => $target)
                <div class="p-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <span
                            class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-300 font-bold mr-3">
                            {{ $index + 1 }}
                        </span>
                        <div>
                            <p class="font-medium">{{ $target->target_nama }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $target->target_jabatan }}</p>
                        </div>
                    </div>
                    <span class="text-lg font-bold text-green-600 dark:text-green-300">
                        {{ $target->rata_nilai }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bottom 3 -->
    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700">
        <div class="p-4 border-b border-gray-100 dark:border-gray-700 bg-red-50 dark:bg-red-900/20">
            <h2 class="text-lg font-semibold text-red-700 dark:text-red-300">
                <i class="fas fa-exclamation-triangle mr-2"></i>3 Guru Terendah
            </h2>
        </div>
        <div class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach ($bottom3 as $index => $target)
                <div class="p-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <span
                            class="w-8 h-8 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-600 dark:text-red-300 font-bold mr-3">
                            {{ $index + 1 }}
                        </span>
                        <div>
                            <p class="font-medium">{{ $target->target_nama }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $target->target_jabatan }}</p>
                        </div>
                    </div>
                    <span class="text-lg font-bold text-red-600 dark:text-red-300">
                        {{ $target->rata_nilai }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Assessment Results -->
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm mb-6">
    <!-- Header -->
    <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Detail Penilaian</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Hasil penilaian yang Anda berikan ke guru lain</p>
    </div>

    <!-- Table Container -->
    <div class="p-4">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-gray-700 dark:text-gray-200">
                <thead>
                    <tr class="text-left border-b border-gray-100 dark:border-gray-700 text-xs uppercase tracking-wide">
                        <th class="pb-3">Nama Guru</th>
                        <th class="pb-3">Jabatan</th>
                        <th class="pb-3 text-center">Jumlah Penilaian</th>
                        <th class="pb-3 text-center">Rata-rata</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach ($target_data as $target)
                        <tr>
                            <td class="py-3">
                                <p class="font-medium">{{ $target->target_nama }}</p>
                            </td>
                            <td class="py-3">
                                <p class="text-gray-500 dark:text-gray-400">{{ $target->target_jabatan }}</p>
                            </td>
                            <td class="py-3 text-center">
                                {{ $target->total_penilaian }}
                            </td>
                            <td class="py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <span class="font-semibold">{{ $target->rata_nilai }}</span>
                                    <div class="w-20 h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                        <div class="h-full bg-bangala rounded-full"
                                            style="width: {{ $target->rata_nilai }}%"></div>
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
