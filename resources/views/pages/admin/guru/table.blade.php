        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Nama
                            Guru</th>
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
                                        <p class="text-medium text-gray-500">{{ $guru->nip }}</p>
                                        <p class="font-medium">{{ $guru->nama }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">Jabatan</td>
                            <td class="py-4 px-4">
                                <span
                                    class="px-3 py-1 bg-{{ $guru->status == '1' ? 'green' : 'red' }}-100 text-{{ $guru->status == '1' ? 'green' : 'red' }}-800 dark:bg-{{ $guru->status == '1' ? 'green' : 'red' }}-900 dark:text-{{ $guru->status == '1' ? 'green' : 'red' }}-200 rounded-full text-sm">{{ $guru->status == '1' ? 'Aktif' : 'Tidak Aktif' }}</span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex space-x-2">
                                    <button
                                        class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                                        <i class="fas fa-eye text-sm"></i>
                                    </button>
                                    <button onclick="openEditModal('{{ $guru->id }}')"
                                        class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                                        <i class="fas fa-edit text-sm"></i>
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
