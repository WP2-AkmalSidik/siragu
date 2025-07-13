        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Nama
                            Guru</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Email</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">No Handphone
                        </th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Jabatan</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Status
                        </th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($gurus as $guru)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-bangala rounded-full flex items-center justify-center">
                                        <span class="text-white font-medium">{{ substr($guru->nama, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium">{{ $guru->nama }}</p>
                                        <p class="text-medium text-gray-500">{{ $guru->nip }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-gray-500 dark:text-gray-300">{{ $guru->email }}</td>
                            <td class="py-4 px-4 text-gray-500 dark:text-gray-300">{{ $guru->no_hp }}</td>
                            <td class="py-4 px-4">
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach ($guru->jabatans as $jabatan)
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium dark:text-goldspel bg-bangala/10 dark:bg-goldspel/20 border border-bangala/20 dark:border-goldspel/30">
                                            {{ toTitleCase($jabatan->jabatan->jabatan) }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
        {{ $guru->status == '1'
            ? 'text-green-800 bg-green-100/70 dark:text-green-200 dark:bg-green-900/30 border border-green-200 dark:border-green-800'
            : 'text-red-800 bg-red-100/70 dark:text-red-200 dark:bg-red-900/30 border border-red-200 dark:border-red-800' }}">
                                    {{ $guru->status == '1' ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex space-x-2">
                                    <button onclick="openEditModal('{{ $guru->id }}')"
                                        class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                                        <i class="fas fa-edit text-sm"></i>
                                    </button>
                                    <button onclick="deleteModal('{{ $guru->id }}')"
                                        class="p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded-lg">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="paginationLinks">
            {!! $gurus->withQueryString()->links() !!}
        </div>
