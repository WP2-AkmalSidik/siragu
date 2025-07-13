@extends('layouts.admin')

@section('title', 'Penilaian')
@section('description', 'Form Penilaian')

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md">
        <!-- Informasi Guru yang Dinilai -->
        <form id="penilaian-form">

            <div
                class="bg-gray-50 dark:bg-gray-700 rounded-lg p-5 mb-6 shadow-sm border border-gray-200 dark:border-gray-600">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Informasi Penilaian</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="min-w-0"> <!-- Added min-w-0 container -->
                        <label for="jabatan" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih
                            Jabatan</label>
                        <select id="jabatan" name="jabatan_id"
                            class="block w-full px-4 py-2.5 text-base border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-2 focus:ring-bangala focus:border-bangala transition-all min-w-0">
                        </select>
                    </div>

                    <div>
                        <label for="guru" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Nama
                            Guru</label>
                        <select id="guru" name="user_id"
                            class="block w-full px-4 py-2.5 text-base border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-2 focus:ring-bangala focus:border-bangala transition-all">
                        </select>
                    </div>

                    <div>
                        <label for="formulir"
                            class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Formulir
                            Penilaian</label>
                        <select id="formulir" name="form_id"
                            class="block w-full px-4 py-2.5 text-base border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-2 focus:ring-bangala focus:border-bangala transition-all">
                        </select>
                    </div>

                    <div>
                        <label for="tahun_ajaran"
                            class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Tahun Ajaran</label>
                        <select id="tahun_ajaran" name="tahun_ajaran"
                            class="block w-full px-4 py-2.5 text-base border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-2 focus:ring-bangala focus:border-bangala transition-all">
                            @foreach (tahunAjaranTerakhir() as $tahun)
                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="semester"
                            class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Semester</label>
                        <select id="semester" name="semester"
                            class="block w-full px-4 py-2.5 text-base border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-2 focus:ring-bangala focus:border-bangala transition-all">
                            <option value="genap">Genap</option>
                            <option value="ganjil">Ganjil</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Form Penilaian -->
            <div class="mb-6" id="form-penilaian"></div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-5 py-2.5 bg-bangala text-white rounded-lg hover:bg-bangala/90 focus:outline-none focus:ring-2 focus:ring-bangala focus:ring-offset-2 transition duration-200 font-medium text-base">
                    <i class="fas fa-save mr-2"></i>Simpan Penilaian
                </button>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // load initial options
            loadSelectOptions('#jabatan', '{{ route('admin.jabatan.target') }}');

            // when jabatan changes, load guru options
            $('#jabatan').on('change', function(e) {
                e.preventDefault();
                const jabatan_id = $(this).val();
                loadSelectOptions('#guru', `/admin/guru/${jabatan_id}/jabatan`);
                loadSelectOptions('#formulir', `/admin/formulir/${jabatan_id}/jabatan`);
            });

            // when formulir changes, load and render penilaian form
            $('#formulir').on('change', function(e) {
                e.preventDefault();
                const id = $(this).val();
                fetch(`/admin/formulir/${id}`)
                    .then(res => res.json())
                    .then(response => {
                        if (response && response.data) {
                            renderFormPenilaian(response.data);
                        } else {
                            $('#form-penilaian').html(
                                '<div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4"><p class="text-red-600 dark:text-red-400 text-sm">Data formulir tidak valid.</p></div>'
                            );
                        }
                    })
                    .catch(() => {
                        $('#form-penilaian').html(
                            '<div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4"><p class="text-red-600 dark:text-red-400 text-sm">Gagal memuat formulir.</p></div>'
                        );
                    });
            });
        });

        function renderFormPenilaian(data) {
            console.log(data, 'renderFormPenilaian');

            const container = document.getElementById('form-penilaian');
            container.innerHTML = '';

            if (!data) {
                container.innerHTML =
                    `<div class="bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-lg p-4"><p class="text-gray-500 dark:text-gray-400 text-sm">Data penilaian tidak tersedia.</p></div>`;
                return;
            }

            const tipe_input = data.tipe_penilaian?.tipe_input || 'select';
            const opsi = Array.isArray(data.opsi) ? data.opsi : [];

            let html = `<div class="space-y-6">`;

            // ==== PENILAIAN LANGSUNG ====
            if (Array.isArray(data.penilaian_langsung) && data.penilaian_langsung.length > 0) {
                html += `
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 border border-blue-200 dark:border-blue-700 rounded-xl p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-500 rounded-full p-2 mr-3">
                                <i class="fas fa-clipboard-check text-white text-sm"></i>
                            </div>
                            <h5 class="text-lg font-semibold text-blue-900 dark:text-blue-100">Penilaian Langsung</h5>
                        </div>
                        <div class="space-y-4">
                `;

                data.penilaian_langsung.forEach(penilaian => {
                    html += `
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-gray-600">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">${penilaian.nama}</label>
                            <div class="input-wrapper">
                                ${renderInputField(tipe_input, opsi, penilaian.id)}
                            </div>
                        </div>`;
                });

                html += `</div></div>`;
            } else if (Array.isArray(data.kategori) && data.kategori.length > 0) {
                data.kategori.forEach((kategori, index) => {
                    const colors = ['blue', 'green', 'purple', 'orange', 'teal'];
                    const color = colors[index % colors.length];

                    html += `
                        <div class="bg-gradient-to-r from-${color}-50 to-${color}-100 dark:from-${color}-900/20 dark:to-${color}-800/20 border border-${color}-200 dark:border-${color}-700 rounded-xl p-6">
                            <div class="flex items-center mb-4">
                                <div class="bg-${color}-500 rounded-full p-2 mr-3">
                                    <i class="fas fa-folder-open text-white text-sm"></i>
                                </div>
                                <div>
                                    <h5 class="text-lg font-semibold text-${color}-900 dark:text-${color}-100">${kategori.kategori}</h5>
                                    ${kategori.deskripsi ? `<p class="text-sm text-${color}-700 dark:text-${color}-300 mt-1">${kategori.deskripsi}</p>` : ''}
                                </div>
                            </div>
                    `;

                    // Penilaian di kategori
                    if (Array.isArray(kategori.penilaian) && kategori.penilaian.length > 0) {
                        html += `<div class="space-y-4 mb-4">`;
                        kategori.penilaian.forEach(penilaian => {
                            html += `
                                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-gray-600">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">${penilaian.nama}</label>
                                    <div class="input-wrapper">
                                        ${renderInputField(tipe_input, opsi, penilaian.id)}
                                    </div>
                                </div>`;
                        });
                        html += `</div>`;
                    }

                    // Subkategori
                    if (Array.isArray(kategori.sub_kategori) && kategori.sub_kategori.length > 0) {
                        kategori.sub_kategori.forEach(subKategori => {
                            html += `
                                <div class="bg-white dark:bg-gray-800 rounded-lg p-5 mb-4 shadow-sm border border-gray-200 dark:border-gray-600">
                                    <div class="flex items-center mb-3">
                                        <div class="bg-gray-400 rounded-full p-1.5 mr-2">
                                            <i class="fas fa-tags text-white text-xs"></i>
                                        </div>
                                        <div>
                                            <h6 class="font-medium text-gray-700 dark:text-gray-300">${subKategori.sub_kategori}</h6>
                                            ${subKategori.deskripsi ? `<p class="text-xs text-gray-600 dark:text-gray-400 mt-1">${subKategori.deskripsi}</p>` : ''}
                                        </div>
                                    </div>
                            `;

                            if (Array.isArray(subKategori.penilaian) && subKategori.penilaian.length > 0) {
                                html += `<div class="space-y-3">`;
                                subKategori.penilaian.forEach(penilaian => {
                                    html += `
                                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 border border-gray-200 dark:border-gray-600">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">${penilaian.nama}</label>
                                            <div class="input-wrapper">
                                                ${renderInputField(tipe_input, opsi, penilaian.id)}
                                            </div>
                                        </div>`;
                                });
                                html += `</div>`;
                            }

                            html += `</div>`; // end subKategori
                        });
                    }

                    html += `</div>`; // end kategori
                });
            } else {
                html +=
                    `<div class="bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-lg p-4"><p class="text-gray-500 dark:text-gray-400 text-sm">Tidak ada kategori penilaian yang tersedia.</p></div>`;
            }

            html += `</div>`;
            container.innerHTML = html;
        }

        function renderInputField(tipe_input, opsi = [], id = '') {
            switch (tipe_input) {
                case 'boolean':
                case 'radio':
                    if (!opsi.length) opsi = [{
                            value: '1',
                            label: 'Ya'
                        },
                        {
                            value: '0',
                            label: 'Tidak'
                        }
                    ];
                    return `
                        <div class="flex flex-wrap gap-3">
                            ${opsi.map(opt => `
                                            <label class="flex items-center space-x-2 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 cursor-pointer transition-colors duration-200">
                                                <input type="radio" name="penilaian[${id}]" value="${opt.value}" class="w-4 h-4 text-bangala bg-gray-100 border-gray-300 focus:ring-bangala dark:focus:ring-bangala dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">${opt.label}</span>
                                            </label>
                                        `).join('')}
                        </div>`;

                case 'number':
                    return `
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <input type="number" name="penilaian[${id}]" min="0" max="100" 
                                    class="w-24 px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala dark:focus:ring-bangala dark:focus:border-bangala transition-colors duration-200" 
                                    placeholder="0">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <span class="text-gray-500 dark:text-gray-400 text-sm">/ 100</span>
                                </div>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 px-3 py-2 rounded-lg">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Nilai maksimal: 100</span>
                            </div>
                        </div>`;

                case 'select':
                default:
                    if (!opsi.length) opsi = [{
                            value: '1',
                            label: '1 (Buruk)'
                        },
                        {
                            value: '2',
                            label: '2 (Cukup)'
                        },
                        {
                            value: '3',
                            label: '3 (Baik)'
                        },
                        {
                            value: '4',
                            label: '4 (Sangat Baik)'
                        }
                    ];
                    return `
                        <select name="penilaian[${id}]" class="w-full px-4 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-bangala focus:border-bangala dark:focus:ring-bangala dark:focus:border-bangala transition-colors duration-200">
                            <option value="" class="text-gray-500">Pilih nilai penilaian</option>
                            ${opsi.map(opt => `<option value="${opt.value}" class="text-gray-700 dark:text-gray-300">${opt.label}</option>`).join('')}
                        </select>`;
            }
        }

        $(document).on('submit', '#penilaian-form', function(e) {
            e.preventDefault();

            const url = '{{ route('admin.pengisi.store') }}';
            const method = 'POST';
            let formData = new FormData(this);

            const successCallback = function(res) {
                successToast(res);
                window.location.reload()
            }

            const errorCallback = function(err) {
                errorToast(err);
            }

            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }

            console.log(url, method, formData)

            ajaxCall(url, method, formData, successCallback, errorCallback)
        })
    </script>
@endpush
