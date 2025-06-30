@extends('layouts.admin')
@section('title', 'Tipe Penilaian')
@section('description', 'Tipe Penilaian')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <!-- Search & Filter -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 space-y-4 md:space-y-0">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Tipe Penilaian</h3>
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                <div class="relative">
                </div>
                <button id="button-tambah-tipe-penilaian" onclick="openModal('modal-data')"
                    class="px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                    Tambah
                </button>
            </div>
        </div>

        <div id="table-tipe-penilaian">

        </div>

        @include('pages.admin.tipe-penilaian.modal')

    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 space-y-4 md:space-y-0">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Guru</h3>
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Cari nama guru..." id="search"
                        class="pl-10 pr-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-bangala">
                </div>
                <button id="button-tambah"
                    class="px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                    Tambah
                </button>
            </div>
        </div>

        <div id="table-guru">

        </div>

        @include('pages.admin.guru.modal')

    </div>
@endsection
@push('scripts')
    <!-- CSS Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        let modalOpen;

        // Fungsi untuk menampilkan modal edit
        function openEditModal(id) {
            const url = '/tipe-penilaian/' + id;

            const successCallback = function(response) {
                const modal = document.getElementById('modal-data');
                modalOpened = 'modal-data';
                const data = response.data
                $('#modal-form').attr('data-id', id);

                $('#nip').val(data.nip);
                $('#nama').val(data.nama);
                $('#no_hp').val(data.no_hp);
                $('#email').val(data.email);
                $('#status').val(data.status);

                const jabatanId = data.jabatans.map(jabatan => jabatan_id);
                loadSelectOptions('#jabatan_id', '{{ route('jabatan.index') }}', jabatanId, true);

                modal.classList.remove('hidden');
                $('#modal-title').text('Edit Guru');
                document.body.style.overflow = 'hidden';
            };

            const errorCallback = function(error) {
                errorToast(error);
                modalOpened = 'modal-data';
            };

            ajaxCall(url, "GET", null, successCallback, errorCallback);
        }

        // Fungsi untuk menyembunyikan modal edit
        function closeEditModal() {
            const modal = document.getElementById('modal-data');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            modalOpened = '';
        }

        // Fungsi untuk menampilkan modal edit
        function openModal(modalId) {
            // Kosongkan semua input
            $('#nama').val('');
            $('#tipe_input').val('');

            $('#modal-title').text('Tambah Tipe Penilaian');
            const modal = document.getElementById(modalId);
            modalOpened = modalId;
            modal.classList.remove('hidden');
            // document.body.style.overflow = 'hidden';

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
            modalOpened = 'modal-delete';
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modalOpened = modalId;
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Tutup modal dengan ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (modalOpened != '') {
                    closeModal(modalOpened);
                }
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
            console.log(currentPage, currentQuery);

            // Fungsi Load Data
            function loadData(page = 1, query = '') {
                $.ajax({
                    url: `/guru?page=${page}&search=${encodeURIComponent(query)}`,
                    type: 'GET',
                    success: function(res) {
                        $('#table-guru').html(res.data.view);
                        $('#paginationLinks').html(res.data.pagination);
                        // update state
                        currentPage = page;
                        currentQuery = query;
                    },
                    error: function() {
                        errorToast('Gagal memuat data.');
                    }
                });
            }

            function loadDataTipePenilaian() {
                $.ajax({
                    url: `/tipe-penilaian`,
                    type: 'GET',
                    success: function(res) {
                        $('#table-tipe-penilaian').html(res.data.view);
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
                    loadData(1, currentQuery);
                }, debounceDelay);
            });

            // Event: Klik link pagination
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();

                const href = $(this).attr('href');
                const urlParams = new URLSearchParams(href.split('?')[1]);
                const page = urlParams.get('page') || 1;
                console.log(href, urlParams, page);

                loadData(page, currentQuery);
            });

            $(document).on('click', '#button-tambah', function(e) {
                e.preventDefault();
                openModal("modal-data");
            })

            $(document).on('click', '#button-tambah-jabatan', function(e) {
                e.preventDefault();
                console.log('button-tambah-jabatan', 'open tambah jabatan')
                openModal("modal-data-jabatan");
            })

            $(document).on('submit', '#modal-form', function(e) {
                e.preventDefault();

                const id = $(this).data('id');
                let url = '{{ route('tipe-penilaian.store') }}';
                const method = 'POST';
                const formData = new FormData(this);

                if (id) {
                    url = `/tipe-penilaian/${id}`; // Ganti URL untuk update
                    formData.append('_method', 'PUT'); // Spoofing method PUT
                }

                const successCallback = function(response) {
                    successToast(response);
                    closeModal('modal-data');
                    $('#modal-form').removeAttr('data-id');
                    loadData(currentPage, currentQuery);
                    loadDataTipePenilaian();
                };

                const errorCallback = function(error) {
                    console.log(error);
                    $('#modal-form').removeAttr('data-id');
                    handleValidationErrors(error, "modal-form", ["nama", "tipe_input"]);
                };

                ajaxCall(url, method, formData, successCallback, errorCallback);
            });

            $(document).on('submit', '#form-delete', function(e) {
                e.preventDefault();

                const id = $(this).attr('data-id');

                const url = `/guru/${id}`;
                const method = 'DELETE'

                const successCallback = function(response) {
                    handleSuccess(response);
                    closeModalDelete();
                    $('#form-delete').removeAttr('data-id');
                    loadData(currentPage, currentQuery);
                    loadDataTipePenilaian();
                };

                const errorCallback = function(error) {
                    closeModalDelete();
                    $('#form-delete').removeAttr('data-id');
                    handleSimpleError(error)
                };

                ajaxCall(url, method, null, successCallback, errorCallback);
            })

            loadDataTipePenilaian();
            loadData(currentPage, currentQuery);
        });
    </script>
@endpush
