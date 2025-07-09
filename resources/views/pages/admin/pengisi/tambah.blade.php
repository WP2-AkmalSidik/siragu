@extends('layouts.admin')

@section('title', 'Penilaian')
@section('description', 'Form Penilaian')

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md">
        <!-- Informasi Guru yang Dinilai -->
        <form id="penilaian-form">

            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 mb-6 shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="jabatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih
                            Jabatan</label>
                        <select id="jabatan" name="jabatan_id"
                            class="block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala"></select>
                    </div>

                    <div>
                        <label for="guru" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama
                            Guru</label>
                        <select id="guru" name="user_id"
                            class="block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala"></select>
                    </div>

                    <div>
                        <label for="formulir"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Formulir</label>
                        <select id="formulir" name="form_id"
                            class="block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala"></select>
                    </div>

                    <div>
                        <label for="tahun_ajaran"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tahun
                            Ajaran</label>
                        <select id="tahun_ajaran" name="tahun_ajaran"
                            class="block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala">
                            @foreach (tahunAjaranTerakhir() as $tahun)
                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="tahun_ajaran"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Semester</label>
                        <select id="semester" name="semester"
                            class="block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg shadow-sm focus:ring-bangala focus:border-bangala">
                            <option value="genap">Genap</option>
                            <option value="ganjil">Ganjil</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Form Penilaian -->
            <div class="mb-8" id="form-penilaian"></div>

            <button type="submit"
                class="px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                Simpan
            </button>
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
                                '<p class="text-red-500">Data formulir tidak valid.</p>');
                        }
                    })
                    .catch(() => {
                        $('#form-penilaian').html('<p class="text-red-500">Gagal memuat formulir.</p>');
                    });
            });
        });

        function renderFormPenilaian(data) {
            console.log(data, 'renderFormPenilaian');

            const container = document.getElementById('form-penilaian');
            container.innerHTML = '';

            if (!data) {
                container.innerHTML = `<p class="text-gray-500">Data penilaian tidak tersedia.</p>`;
                return;
            }

            const tipe_input = data.tipe_penilaian?.tipe_input || 'select';
            const opsi = Array.isArray(data.opsi) ? data.opsi : [];

            let html = `<div class="space-y-6">`;

            // ==== PENILAIAN LANGSUNG ====
            if (Array.isArray(data.penilaian_langsung) && data.penilaian_langsung.length > 0) {
                html += `
      <div class="border border-gray-200 dark:border-gray-600 rounded-xl p-4">
        <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-4">Penilaian Langsung</h5>
        <div class="space-y-3 mb-4">
    `;

                data.penilaian_langsung.forEach(penilaian => {
                    html += `
        <div class="mb-2">
          <label class="block text-gray-700 dark:text-gray-300 mb-2">${penilaian.nama}</label>
          ${renderInputField(tipe_input, opsi, penilaian.id)}
        </div>`;
                });

                html += `</div></div>`;
            } else if (Array.isArray(data.kategori) && data.kategori.length > 0) {
                data.kategori.forEach(kategori => {
                    html += `
        <div class="border border-gray-200 dark:border-gray-600 rounded-xl p-4">
          <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">${kategori.kategori}</h5>
          ${kategori.deskripsi ? `<p class="text-sm text-gray-600 dark:text-gray-400 mb-4">${kategori.deskripsi}</p>` : ''}
      `;

                    // Penilaian di kategori
                    if (Array.isArray(kategori.penilaian) && kategori.penilaian.length > 0) {
                        html += `<div class="space-y-3 mb-4">`;
                        kategori.penilaian.forEach(penilaian => {
                            html += `
            <div class="mb-2">
              <label class="block text-gray-700 dark:text-gray-300 mb-2">${penilaian.nama}</label>
              ${renderInputField(tipe_input, opsi, penilaian.id)}
            </div>`;
                        });
                        html += `</div>`;
                    }

                    // Subkategori
                    if (Array.isArray(kategori.sub_kategori) && kategori.sub_kategori.length > 0) {
                        kategori.sub_kategori.forEach(subKategori => {
                            html += `
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 mb-3">
              <h6 class="font-medium text-gray-700 dark:text-gray-300 mb-2">${subKategori.sub_kategori}</h6>
              ${subKategori.deskripsi ? `<p class="text-sm text-gray-600 dark:text-gray-400 mb-3">${subKategori.deskripsi}</p>` : ''}
          `;

                            if (Array.isArray(subKategori.penilaian) && subKategori.penilaian.length > 0) {
                                subKategori.penilaian.forEach(penilaian => {
                                    html += `
                <div class="mb-2">
                  <label class="block text-gray-700 dark:text-gray-300 mb-2">${penilaian.nama}</label>
                  ${renderInputField(tipe_input, opsi, penilaian.id)}
                </div>`;
                                });
                            }

                            html += `</div>`; // end subKategori
                        });
                    }

                    html += `</div>`; // end kategori
                });
            } else {
                html += `<p class="text-gray-500">Tidak ada kategori penilaian yang tersedia.</p>`;
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
        <div class="mt-2 flex flex-wrap gap-2 text-xs">
          ${opsi.map(opt => `
                                                                <label class="flex items-center space-x-2">
                                                                    <input type="radio" name="penilaian[${id}]" value="${opt.value}" class="custom-radio">
                                                                    <span>${opt.label}</span>
                                                                </label>`).join('')}
        </div>`;

                case 'number':
                    return `
        <div class="mt-2 flex items-center space-x-2 text-xs">
          <input type="number" name="penilaian[${id}]" min="0" max="100" class="w-20 px-2 py-1 bg-gray-100 dark:bg-gray-600 rounded border">
          <span class="text-gray-600 dark:text-gray-400">/ 100</span>
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
        <select name="penilaian[${id}]" class="mt-2 w-full px-3 py-2 text-xs bg-gray-100 dark:bg-gray-600 rounded border focus:outline-none focus:ring-2 focus:ring-bangala">
          <option value="">Pilih opsi</option>
          ${opsi.map(opt => `<option value="${opt.value}">${opt.label}</option>`).join('')}
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
