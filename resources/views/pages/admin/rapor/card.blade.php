<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @php
        $totalNilai = 0;
        $penilaian = 0;
    @endphp
    @foreach ($result as $form)
        @php
            $totalNilai += $form->rata_nilai;
            $penilaian += 1;
        @endphp
        <div
            class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all duration-200">
            <div class="flex items-center space-x-3 mb-4">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $form->form_nama }}</h3>
                </div>
            </div>

            <div class="space-y-4">
                <div class="relative">
                    <div min="0" max="100"
                        class="w-full px-4 py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-center text-2xl font-bold transition-all duration-200">
                        {{ $form->rata_nilai }}
                    </div>
                    <span
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 font-medium">/100</span>
                </div>
            </div>
        </div>
    @endforeach
</div>
@php
    $totalNilai = $totalNilai / $penilaian;
    // Determine color based on score range
    if ($totalNilai <= 50) {
        $colorClass = 'text-red-500 dark:text-red-400';
        $bgClass = 'bg-red-500';
        $label = 'Kurang Sekali';
    } elseif ($totalNilai <= 68) {
        $colorClass = 'text-orange-500 dark:text-orange-400';
        $bgClass = 'bg-orange-500';
        $label = 'Kurang';
    } elseif ($totalNilai <= 78) {
        $colorClass = 'text-yellow-500 dark:text-yellow-400';
        $bgClass = 'bg-yellow-500';
        $label = 'Cukup';
    } elseif ($totalNilai <= 88) {
        $colorClass = 'text-blue-500 dark:text-blue-400';
        $bgClass = 'bg-blue-500';
        $label = 'Baik';
    } else {
        $colorClass = 'text-green-500 dark:text-green-400';
        $bgClass = 'bg-green-500';
        $label = 'Sangat Baik';
    }
@endphp

<div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-xs border border-gray-100 dark:border-gray-700">
    <div class="flex items-center justify-between gap-4">
        <!-- Left Side - Title -->
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 {{ $bgClass }} rounded-lg flex items-center justify-center text-white">
                <i class="fas fa-chalkboard-teacher text-lg"></i>
            </div>
            <div>
                <h1 class="text-lg font-semibold text-gray-800 dark:text-white">Rapor Guru</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">Semester {{ $form->semester }} •
                    {{ $form->tahun_ajaran }}
                </p>
            </div>
        </div>

        <!-- Right Side - Score -->
        <div class="flex items-center gap-3">
            <div class="text-right">
                <div class="text-2xl font-bold {{ $colorClass }}" id="total-score">
                    {{ number_format($totalNilai, 2) }}
                </div>
                <p class="text-xs {{ $colorClass }}">{{ $label }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Total Nilai</p>
            </div>
        </div>
    </div>
</div>
