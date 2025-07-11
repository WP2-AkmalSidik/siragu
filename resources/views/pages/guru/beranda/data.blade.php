        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-6 overflow-hidden">
            <div class="border-b border-gray-100 dark:border-gray-700 px-4 py-3 flex justify-between items-center">
                <h2 class="font-semibold flex items-center">
                    <i class="fas fa-file-contract text-bangala mr-2"></i>
                    Rapot Kinerja Guru
                </h2>
                <a href="{{ route('guru.dashboard.rapor.pdf', ['semester' => Str::lower($semester), 'tahun_ajaran' => $tahun_ajaran]) }}"
                    class="text-sm bg-bangala text-white px-3 py-1 rounded-lg hover:bg-bangala/90 transition flex items-center">
                    <i class="fas fa-file-export mr-2"></i> Unduh
                </a>
            </div>

            <div class="p-4">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-medium">Semester {{ $semester }} {{ $tahun_ajaran }}</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Nama Guru: {{ $guru_nama }}
                        </p>
                    </div>
                </div>

                <!-- Assessment Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left border-b border-gray-200 dark:border-gray-700">
                                <th class="pb-2 font-medium">No</th>
                                <th class="pb-2 font-medium">Aspek Penilaian</th>
                                <th class="pb-2 font-medium text-center">Nilai</th>
                                <th class="pb-2 font-medium text-center">Kategori</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                            @php
                                $totalForm = 0;
                                $totalNilai = 0;
                            @endphp

                            @foreach ($result as $index => $form)
                                @php

                                    $totalForm += 1;
                                    $totalNilai += $form->rata_nilai;
                                    // Determine status based on score
                                    $score = $form->rata_nilai;
                                    $status = '-';
                                    $bgColor = '';
                                    $textColor = '';

                                    if (!is_null($score) && $score !== '-') {
                                        if ($score >= 80) {
                                            $status = 'BAIK';
                                            $bgColor = 'bg-green-100 dark:bg-green-900/20';
                                            $textColor = 'text-green-800 dark:text-green-300';
                                        } elseif ($score >= 60) {
                                            $status = 'CUKUP';
                                            $bgColor = 'bg-yellow-100 dark:bg-yellow-900/20';
                                            $textColor = 'text-yellow-800 dark:text-yellow-300';
                                        } else {
                                            $status = 'KURANG';
                                            $bgColor = 'bg-red-100 dark:bg-red-900/20';
                                            $textColor = 'text-red-800 dark:text-red-300';
                                        }
                                    }

                                    // Check if this is a sub-item (contains 'a.', 'b.', etc.)
                                    $isSubItem = preg_match('/^[a-z]\./', $form->form_nama);
                                @endphp

                                <tr>
                                    <td class="{{ $isSubItem ? 'pl-8 py-2 text-gray-500' : 'py-3 font-medium' }}">
                                        {{ $isSubItem ? substr($form->form_nama, 0, 2) : $index + 1 }}
                                    </td>
                                    <td class="{{ $isSubItem ? 'py-2' : 'py-3' }}">
                                        {{ $isSubItem ? substr($form->form_nama, 2) : $form->form_nama }}
                                    </td>
                                    <td class="{{ $isSubItem ? 'py-2 text-center' : 'py-3 text-center font-bold' }}">
                                        {{ $score ?? '-' }}
                                    </td>
                                    <td class="{{ $isSubItem ? 'py-2 text-center' : 'py-3 text-center' }}">
                                        @if ($score !== '-' && !is_null($score))
                                            <span
                                                class="px-2 py-1 {{ $bgColor }} {{ $textColor }} rounded-full text-xs">
                                                {{ $status }}
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                @php
                    $rataRataGlobal = $totalForm > 0 ? $totalNilai / $totalForm : 0;

                    $globalStatus = '-';
                    $globalBgColor = '';
                    $globalTextColor = '';

                    if ($rataRataGlobal >= 80) {
                        $globalStatus = 'BAIK';
                        $globalBgColor = 'bg-green-100 dark:bg-green-900/20';
                        $globalTextColor = 'text-green-800 dark:text-green-300';
                    } elseif ($rataRataGlobal >= 60) {
                        $globalStatus = 'CUKUP';
                        $globalBgColor = 'bg-yellow-100 dark:bg-yellow-900/20';
                        $globalTextColor = 'text-yellow-800 dark:text-yellow-300';
                    } else {
                        $globalStatus = 'KURANG';
                        $globalBgColor = 'bg-red-100 dark:bg-red-900/20';
                        $globalTextColor = 'text-red-800 dark:text-red-300';
                    }
                @endphp
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-xs border border-gray-100 dark:border-gray-700 p-4 mt-4">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <!-- Left Section - Title -->
                        <div>
                            <h3 class="font-medium text-gray-800 dark:text-white">Ringkasan Penilaian</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Total nilai seluruh aspek</p>
                        </div>

                        <!-- Right Section - Metrics -->
                        <div class="flex divide-x divide-gray-200 dark:divide-gray-700">
                            <!-- Total Score -->
                            <div class="px-4 text-center">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Total</p>
                                <p class="text-xl font-bold text-bangala dark:text-goldspel">{{ $totalNilai }}</p>
                            </div>

                            <!-- Average -->
                            <!-- Average -->
                            <div class="px-4 text-center">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Rata-rata</p>
                                <p class="text-xl font-bold text-gray-800 dark:text-white">
                                    {{ number_format($rataRataGlobal, 2) }}
                                </p>
                            </div>

                            <!-- Rating -->
                            <div class="px-4 text-center">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Predikat</p>
                                <p
                                    class="text-sm font-medium px-2 py-1 {{ $globalBgColor }} {{ $globalTextColor }} rounded-full">
                                    {{ $globalStatus }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
