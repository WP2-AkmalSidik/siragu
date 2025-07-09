<div class="overflow-x-auto">
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Formulir</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Target Penilaian</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Jabatan</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Nilai</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Jumlah Penilaian</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Tahun Ajaran</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Semester</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($targets as $target)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="py-4 px-4 text-gray-500 dark:text-gray-300">
                        {{ $target->form_nama }}
                    </td>
                    <td class="py-4 px-4 text-gray-500 dark:text-gray-300">
                        {{ $target->target_nama }}
                    </td>
                    <td class="py-4 px-4 text-gray-500 dark:text-gray-300">
                        {{ $target->jabatan_list }}
                    </td>
                    <td class="py-4 px-4 text-gray-500 dark:text-gray-300">
                        {{ number_format($target->rata_nilai) }}
                    </td>
                    <td class="py-4 px-4 text-gray-500 dark:text-gray-300 text-center">
                        {{ $target->total_penilaian }}
                    </td>
                    <td class="py-4 px-4 text-gray-500 dark:text-gray-300">
                        {{ $target->tahun_ajaran }}
                    </td>
                    <td class="py-4 px-4 text-gray-500 dark:text-gray-300">
                        {{ toTitleCase($target->semester) }}
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.pengisi.edit.nilai', [Str::replace('/', '-', $target->tahun_ajaran), $target->semester, $target->form_id, $target->target_id]) }}"
                                class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                            </a>
                            <button id="delete-button"
                                data-url="{{ route('admin.pengisi.destroy.nilai', [Str::replace('/', '-', $target->tahun_ajaran), $target->semester, $target->form_id, $target->target_id]) }}"
                                class="p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded-lg">
                                <i class="fa-solid fa-trash text-sm"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>

<div id="paginationLinks">
    {!! $targets->withQueryString()->links('vendor.pagination.tailwind') !!}
</div>
