    <!-- Form List -->
    <div class="grid gap-6">
        @foreach ($forms as $form)
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md dashboard-card">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-4 space-y-2 lg:space-y-0">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $form->nama }}</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Dibuat: {{ $form->created_at->format('d F Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Penilai: {{ toTitleCase($form->pengisi->jabatan->jabatan) }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Yang Ditilai: {{ toTitleCase($form->target->jabatan->jabatan) }}
                        </p>
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="viewForm({{ $form->id }})"
                            class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button onclick="editForm({{ $form->id }})"
                            class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteForm({{ $form->id }})"
                            class="p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded-lg">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <!-- Kategori Preview -->
                <div class="space-y-3">
                    @if ($form->penilaianLangsung->count() > 0)
                        <div class="border-l-4 border-indigo-500 pl-4">
                            <h5 class="font-medium text-gray-800 dark:text-gray-200">Penilaian Langsung</h5>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ $form->penilaianLangsung->count() }} Penilaian
                            </p>
                        </div>
                    @endif

                    @foreach ($form->kategori as $index => $kategori)
                        <div class="border-l-4 {{ $index % 2 == 0 ? 'border-bangala' : 'border-goldspel' }} pl-4">
                            <h5 class="font-medium text-gray-800 dark:text-gray-200">{{ $kategori->kategori }}</h5>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ $kategori->penilaian->count() }} Penilaian •
                                {{ $kategori->subKategori->sum(function ($sub) {return $sub->penilaian->count();}) }}
                                Sub-Kategori
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
