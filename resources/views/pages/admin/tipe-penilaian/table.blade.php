        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">No</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Nama Tipe
                            Penilaian</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Tipe Input</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($tipes as $tipe)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="py-4 px-4 text-gray-500 dark:text-gray-300">
                                {{ $loop->iteration}}</td>
                            <td class="py-4 px-4 text-gray-500 dark:text-gray-300">{{ $tipe->nama }}</td>
                            <td class="py-4 px-4 text-gray-500 dark:text-gray-300">{{ $tipe->tipe_input }}</td>
                            <td class="py-4 px-4">
                                <div class="flex space-x-2">
                                    <button
                                        class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                                        <i class="fas fa-eye text-sm"></i>
                                    </button>
                                    <button onclick="openEditModal('{{ $tipe->id }}')"
                                        class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                                        <i class="fas fa-edit text-sm"></i>
                                    </button>
                                    <button onclick="deleteModal('{{ $tipe->id }}')"
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
