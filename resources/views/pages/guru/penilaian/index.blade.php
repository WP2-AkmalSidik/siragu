@extends('layouts.guru')
@section('title', 'Penilaian')
@push('styles')
    <style>
        @media (max-width: 640px) {
            .mobile-stack {
                flex-direction: column !important;
                align-items: flex-start !important;
            }

            .mobile-text-center {
                text-align: center !important;
            }

            .mobile-full-width {
                width: 100% !important;
            }

            .mobile-mt-2 {
                margin-top: 0.5rem !important;
            }

            .mobile-p-3 {
                padding: 0.75rem !important;
            }

            .mobile-flex-col {
                flex-direction: column !important;
            }

            .mobile-space-y-2>*+* {
                margin-top: 0.5rem !important;
            }

            .teacher-card {
                padding: 0.75rem !important;
            }

            .teacher-info {
                flex-direction: column !important;
                gap: 0.25rem !important;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-4">
        <!-- Kepsek Profile Header -->
        {{-- <div class="flex items-center justify-between mb-6 mobile-stack mobile-space-y-2">
            <div class="mobile-full-width mobile-text-center sm:text-left">
                <h1 class="text-xl font-semibold">Daftar Guru</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">SMPIT Abu Bakar - Tahun Ajaran 2023/2024</p>
            </div>
            <div class="text-right mobile-full-width mobile-text-center sm:text-right">
                <div class="text-2xl font-bold text-bangala">21</div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Total Guru</p>
            </div>
        </div> --}}

        <!-- Search and Filter -->
        <div class="mb-6 flex items-center gap-3 mobile-flex-col">
            <div class="relative flex-grow mobile-full-width">
                <input type="text" placeholder="Cari....." id="search"
                    class="w-full pl-10 pr-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <div class="relative flex items-center gap-2 w-full">
                <select id="search-form"
                    class="flex-grow pl-10 pr-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent">
                </select>
                <button
                    class="px-4 py-2 bg-gradient-to-r from-bangala to-goldspel text-white rounded-lg hover:shadow-lg transition-all">Formulir</button>
            </div>
        </div>
        <!-- Teacher List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div id="table-penilaian">

            </div>
        </div>
    </main>
@endsection
@push('scripts')
    <script>
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
                    url: `/guru/penilaian?page=${page}&search=${encodeURIComponent(query)}&form=${encodeURIComponent(form)}`,
                    type: 'GET',
                    success: function(res) {
                        $('#table-penilaian').html(res.data.view);
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
            loadSelectOptions('#search-form', '{{ route('guru.formulir.pengisi') }}')
        });
    </script>
@endpush
