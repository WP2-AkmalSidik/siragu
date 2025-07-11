<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

    @foreach ($targets as $target)
        <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 dark:border-gray-700">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $target->form_nama }}</h3>
                    <span
                        class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full">
                        {{ $target->tahun_ajaran }}
                    </span>
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Target Penilaian:</span>
                        <span
                            class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $target->target_nama }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Jabatan:</span>
                        <span
                            class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $target->jabatan_list }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Nilai:</span>
                        <span
                            class="text-sm font-bold text-green-600 dark:text-green-400">{{ number_format($target->rata_nilai) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Jumlah Penilaian:</span>
                        <span
                            class="text-sm font-medium text-gray-900 dark:text-gray-100 text-center">{{ $target->total_penilaian }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Tahun Ajaran:</span>
                        <span
                            class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $target->tahun_ajaran }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Semester:</span>
                        <span
                            class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ toTitleCase($target->semester) }}</span>
                    </div>
                </div>

                <div class="flex justify-end space-x-2 mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('guru.penilaian.edit.nilai', [Str::replace('/', '-', $target->tahun_ajaran), $target->semester, $target->form_id, $target->target_id]) }}"
                        class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg transition-colors">
                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                    </a>
                    <button id="delete-button"
                        data-url="{{ route('admin.pengisi.destroy.nilai', [Str::replace('/', '-', $target->tahun_ajaran), $target->semester, $target->form_id, $target->target_id]) }}"
                        class="p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded-lg transition-colors">
                        <i class="fa-solid fa-trash text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div id="paginationLinks" class="mt-8">
    {!! $targets->withQueryString()->links('vendor.pagination.tailwind') !!}
</div>
