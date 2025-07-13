@extends('layouts.admin')
@section('title', 'Pengguna')
@section('description', 'Data Pengisian Penilaian')
@section('content')
    <!-- Search & Filter -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Pengisian</h3>
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <div class="relative flex-1 min-w-[200px]">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Cari nama guru..." id="search"
                        class="pl-10 pr-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-bangala">
                </div>
                <div class="relative flex-1 min-w-[200px]">
                    <select id="search-form"
                        class="pl-10 pr-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-bangala">
                        <option value="">Pilih Formulir</option>
                    </select>
                </div>
                <a href="{{ route('admin.pengisi.create') }}"
                    class="px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala whitespace-nowrap text-center">
                    Tambah
                </a>
            </div>
        </div>

        <div id="table-pengisi">

        </div>

        @include('pages.admin.pengisi.modal')

    </div>
@endsection
@push('scripts')
    <script>
        // Fungsi untuk menampilkan modal edit

        function showTargetDetailModal(targetId) {
            fetch(`/admin/target/${targetId}/detail?pengisi_id={{ auth()->user()->id }}`)
                .then(response => response.json())
                .then(data => {
                    let html = `
                <div class="mb-4">
                    <h4 class="font-bold">${data.target.nama}</h4>
                    <p class="text-gray-600">${data.target.jabatan_list} |
                    Total Penilaian: ${data.target.total_penilaian} |
                    Rata-rata: ${data.target.rata_nilai.toFixed(2)}</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="text-left py-2 px-4">Form Penilaian</th>
                                <th class="text-left py-2 px-4">Nilai</th>
                                <th class="text-left py-2 px-4">Kategori</th>
                                <th class="text-left py-2 px-4">Tahun Ajaran</th>
                                <th class="text-left py-2 px-4">Semester</th>
                                <th class="text-left py-2 px-4">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            ${data.nilai.map(item => `
                                                                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                                                                <td class="py-2 px-4">${item.penilaian.form.nama}</td>
                                                                                                <td class="py-2 px-4">${item.nilai}</td>
                                                                                                <td class="py-2 px-4">
                                                                                                    ${item.penilaian.kategori?.kategori || '-'} /
                                                                                                    ${item.penilaian.subKategori?.sub_kategori || '-'}
                                                                                                </td>
                                                                                                <td class="py-2 px-4">${item.tahun_ajaran}</td>
                                                                                                <td class="py-2 px-4">${item.semester}</td>
                                                                                                <td class="py-2 px-4">${new Date(item.created_at).toLocaleDateString()}</td>
                                                                                            </tr>
                                                                                        `).join('')}
                        </tbody>
                    </table>
                </div>
            `;

                    document.getElementById('targetDetailModalContent').innerHTML = html;
                    document.getElementById('targetDetailModal').classList.remove('hidden');
                });
        }

        function closeTargetDetailModal() {
            document.getElementById('targetDetailModal').classList.add('hidden');
        }

        function openEditModal(id) {
            const url = '/admin/pengisi/' + id + '/edit';

            const successCallback = function(response) {
                const modal = document.getElementById('modal-data');
                const data = response.data
                $('#modal-form').attr('data-id', id);

                $('#nama').val(data.nama);
                $('#no_hp').val(data.no_hp);
                $('#email').val(data.email);
                $('#status').val(data.status);

                modal.classList.remove('hidden');
                $('#modal-title').text('Edit Penilaian');
                document.body.style.overflow = 'hidden';
            };

            const errorCallback = function(error) {
                errorToast(error);
            };

            ajaxCall(url, "GET", null, successCallback, errorCallback);
        }

        // Fungsi untuk menyembunyikan modal edit
        function closeEditModal() {
            const modal = document.getElementById('modal-data');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Fungsi untuk menampilkan modal edit
        function openModal() {
            // Kosongkan semua input
            $('#nama').val('');
            $('#no_hp').val('');
            $('#email').val('');

            $('#modal-title').text('Tambah Penilaian');
            const modal = document.getElementById('modal-data');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function deleteModal(id) {
            $('#form-delete').attr('data-id', id);
            const form_id = $('#form-delete').attr('data-id');
            console.log(id, form_id);
            const modal = document.getElementById('modal-delete');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Fungsi untuk menyembunyikan modal edit
        function closeModalDelete() {
            const modal = document.getElementById('modal-delete');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function closeModal() {
            const modal = document.getElementById('modal-data');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Tutup modal dengan ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        $(document).ready(function() {
            console.log('ready')
            // Debounce untuk search input
            let debounceTimeout;
            const debounceDelay = 500;

            // State
            let currentPage = 1;
            let currentQuery = '';
            let currentForm = '';
            console.log(currentPage, currentQuery);

            // Fungsi Load Data
            function loadData(page = 1, query = '', form = '') {
                $.ajax({
                    url: `/admin/pengisi?page=${page}&search=${encodeURIComponent(query)}&form=${encodeURIComponent(form)}`,
                    type: 'GET',
                    success: function(res) {
                        $('#table-pengisi').html(res.data.view);
                        $('#paginationLinks').html(res.data.pagination);
                        // update state
                        currentPage = page;
                        currentQuery = query;
                        currentForm = form;
                    },
                    error: function() {
                        errorToast('Gagal memuat data.');
                    }
                });
            }
            // Event: Search input (debounced)
            $('#search').on('keyup', function() {
                clearTimeout(debounceTimeout);

                const query = $(this).val();
                currentQuery = query;

                debounceTimeout = setTimeout(() => {
                    loadData(1, currentQuery, currentForm);
                }, debounceDelay);
            });

              $(document).on('click', '#delete-button', function(e) {
                e.preventDefault();

                const url = $(this).data('url');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    theme: 'dark',
                    showCancelButton: true,
                    confirmButtonColor: '#913013',
                    cancelButtonColor: '#c19e5e',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const successCallback = function(res) {
                            successToast(res);
                            loadData(currentPage, currentQuery, currentForm);
                        }

                        const errorCallback = function(err) {
                            errorToast(err);
                        }

                        ajaxCall(url, 'DELETE', null, successCallback, errorCallback);
                    }
                });
            });


            // Event: Klik link pagination
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();

                const href = $(this).attr('href');
                const urlParams = new URLSearchParams(href.split('?')[1]);
                const page = urlParams.get('page') || 1;
                console.log(href, urlParams, page);

                loadData(page, currentQuery, currentForm);
            });

            $(document).on('click', '#button-tambah', function(e) {
                e.preventDefault();
                openModal("modal-data");
            })

            $(document).on('submit', '#modal-form', function(e) {
                e.preventDefault();

                const id = $(this).data('id');
                let url = '{{ route('admin.pengisi.store') }}';
                const method = 'POST';
                const formData = new FormData(this);

                if (id) {
                    url = `/admin/pengisi/${id}`; // Ganti URL untuk update
                    formData.append('_method', 'PUT'); // Spoofing method PUT
                }

                const successCallback = function(response) {
                    successToast(response);
                    closeModal();
                    $('#modal-form').removeAttr('data-id');
                    loadData(currentPage, currentQuery, currentForm);
                };

                const errorCallback = function(error) {
                    console.log(error);
                    $('#modal-form').removeAttr('data-id');
                    handleValidationErrors(error, "modal-form", ["nama", "email", "no_hp"]);
                };

                ajaxCall(url, method, formData, successCallback, errorCallback);
            });

            $(document).on('submit', '#form-delete', function(e) {
                e.preventDefault();

                const id = $(this).attr('data-id');

                const url = `/admin/pengisi/${id}`;
                const method = 'DELETE'

                const successCallback = function(response) {
                    handleSuccess(response);
                    closeModalDelete();
                    $('#form-delete').removeAttr('data-id');
                    loadData(currentPage, currentQuery, currentForm);
                };

                const errorCallback = function(error) {
                    closeModalDelete();
                    $('#form-delete').removeAttr('data-id');
                    handleSimpleError(error)
                };

                ajaxCall(url, method, null, successCallback, errorCallback);
            })

            $(document).on('change', '#search-form', function(e) {
                e.preventDefault();

                let form = $(this).val();

                currentForm = form;

                loadData(currentPage, currentQuery, currentForm)
            })
            $(document).on('change', '#search', function(e) {
                e.preventDefault();

                let search = $(this).val();

                currentQuery = search;

                loadData(currentPage, currentQuery, currentForm)
            })

            loadData(currentPage, currentQuery, currentForm);
            loadSelectOptions('#search-form', '{{ route('admin.formulir.pengisi') }}')
        });
    </script>
@endpush
