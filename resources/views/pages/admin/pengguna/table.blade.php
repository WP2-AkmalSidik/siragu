        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Nama</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Email</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Nomor Handphone
                        </th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Status
                        </th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($penggunas as $pengguna)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-bangala rounded-full flex items-center justify-center">
                                        <span class="text-white font-medium">{{ substr($pengguna->nama, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium">{{ $pengguna->nama }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-gray-500 dark:text-gray-300">{{ $pengguna->email }}</td>
                            <td class="py-4 px-4 text-gray-500 dark:text-gray-300">{{ $pengguna->no_hp }}</td>
                            <td class="py-4 px-4">
                                <span
                                    class="px-3 py-1 bg-{{ $pengguna->status == '1' ? 'green' : 'red' }}-100 text-{{ $pengguna->status == '1' ? 'green' : 'red' }}-800 dark:bg-{{ $pengguna->status == '1' ? 'green' : 'red' }}-900 dark:text-{{ $pengguna->status == '1' ? 'green' : 'red' }}-200 rounded-full text-sm">{{ $pengguna->status == '1' ? 'Aktif' : 'Tidak Aktif' }}</span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex space-x-2">
                                    <button
                                        class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                                        <i class="fas fa-eye text-sm"></i>
                                    </button>
                                    <button onclick="openEditModal('{{ $pengguna->id }}')"
                                        class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                                        <i class="fas fa-edit text-sm"></i>
                                    </button>
                                    <button onclick="deleteModal('{{ $pengguna->id }}')"
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
            {!! $penggunas->withQueryString()->links() !!}
        </div>
