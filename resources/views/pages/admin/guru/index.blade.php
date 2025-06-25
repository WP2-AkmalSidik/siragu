@extends('layouts.admin')
@section('title', 'Guru')
@section('description', 'List Guru Mengajar')
@section('content')
    <!-- Search & Filter -->
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
    <script>
        // Fungsi untuk menampilkan modal edit
        function openEditModal(id) {
            const url = '/guru/' + id + '/edit';

            const successCallback = function(response) {
                const modal = document.getElementById('modal-data');

                const data = response.data

                $('#nip').val(data.nip);
                $('#nama').val(data.nama);
                $('#no_hp').val(data.no_hp);
                $('#email').val(data.email);
                $('#status').val(data.status);

                modal.classList.remove('hidden');
                $('#modal-title').text('Edit Guru');
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
            $('#nip').val('');
            $('#nama').val('');
            $('#no_hp').val('');
            $('#email').val('');

            $('#modal-title').text('Tambah Guru');
            const modal = document.getElementById('modal-data');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Fungsi untuk menyembunyikan modal edit
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

            $(document).on('submit', '#modal-form', function(e) {
                e.preventDefault();

                const id = $(this).data('id');

                const url = '{{ route('guru.store') }}';
                const method = 'POST'
                const formData = new FormData(this);

                if (id) {
                    const url = `/guru/${id}`;
                    formData.append('_method', 'PUT');
                }

                const successCallback = function(response) {
                    successToast(response);
                    closeModal();
                    loadData(currentPage, currentQuery);
                };

                const errorCallback = function(error) {
                    handleValidationErrors(error, "modal-form", ["nip", "nama", "email", "no_hp"]);
                };

                ajaxCall(url, method, formData, successCallback, errorCallback);
            })

            $(document).on('submit', '#hapus-kategori', function(e) {
                e.preventDefault();

                const id = $(this).data('id');

                const url = `/kategori/${id}`;
                const method = 'DELETE'

                const successCallback = function(response) {
                    handleSuccess(response);
                    closeModal("deleteModal");
                    loadData(currentPage, currentQuery);
                };

                const errorCallback = function(error) {
                    handleSimpleError(error)
                };

                ajaxCall(url, method, null, successCallback, errorCallback);
            })

            loadData(currentPage, currentQuery);
        });
    </script>
@endpush
