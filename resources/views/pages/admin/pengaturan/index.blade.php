@extends('layouts.admin')
@section('title', 'Pengaturan Aplikasi')
@section('description', 'Mengubah nama aplikasi, nama sekolah logo dan juga keterangan aplikasi.')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <style>
        /* Cropper container styles */
        .cropper-container {
            max-width: 100%;
            margin: 0 auto;
        }

        .cropper-modal {
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Preview image styles */
        #image-preview {
            max-width: 100%;
            height: auto;
            display: block;
        }

        #image-to-crop {
            max-width: 100%;
            max-height: 100%;
            display: block;
            margin: 0 auto;
        }

        /* Cropper action buttons */
        .cropper-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
            justify-content: center;
        }

        /* Fixed modal positioning - centered properly */
        #cropper-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        /* Show modal when not hidden */
        #cropper-modal:not(.hidden) {
            display: flex;
        }

        /* Ukuran modal cropper yang lebih compact dan centered */
        .cropper-modal-container {
            max-width: 90vw;
            width: 500px;
            max-height: 90vh;
            margin: 0 auto;
            position: relative;
            transform: none;
            /* Remove any transform that might cause offset */
        }

        /* Ukuran image cropper */
        .cropper-image-container {
            max-height: 60vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Tombol aksi */
        .cropper-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 15px;
        }

        /* Mobile-specific styles */
        @media (max-width: 640px) {
            .mobile-stack {
                flex-direction: column;
            }

            .mobile-space-y-2>*+* {
                margin-top: 0.5rem;
            }

            .mobile-full-width {
                width: 100%;
            }

            .mobile-text-center {
                text-align: center;
            }

            .mobile-flex-col {
                flex-direction: column;
            }

            .mobile-gap-2 {
                gap: 0.5rem;
            }

            .mobile-p-4 {
                padding: 1rem;
            }

            .mobile-mb-4 {
                margin-bottom: 1rem;
            }

            .cropper-actions {
                flex-direction: column;
            }

            .cropper-actions button {
                width: 100%;
            }

            /* Responsive untuk mobile */
            .cropper-modal-container {
                width: 95vw;
                max-width: 95vw;
                padding: 10px;
                margin: 0;
            }

            .cropper-image-container {
                max-height: 50vh;
            }

            #cropper-modal {
                padding: 0.5rem;
            }
        }

        /* Ensure modal is truly centered */
        .cropper-modal-container {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    </style>
@endpush

@section('content')
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
        <div class="w-full sm:w-auto text-center sm:text-left">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Edit Pengaturan</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Kelola informasi aplikasi ini.</p>
        </div>
    </div>

    <!-- Profile Edit Form -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Logo Aplikasi -->
        <div class="order-1 lg:order-none">
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                <h2 class="font-semibold text-lg mb-4 text-gray-800 dark:text-white">Logo Aplikasi</h2>

                <div class="flex flex-col items-center text-center">
                    <!-- Current logo preview -->
                    <div class="relative mb-4">
                        <img id="image-preview"
                            src="{{ Str::endsWith($data->logo, ['logo.png', 'logo.jpg', 'logo.jpeg']) ? asset($data->logo) : asset($data->logo) }}"
                            alt="Logo Aplikasi"
                            class="w-64 h-64 object-contain border border-gray-200 dark:border-gray-600 rounded-lg shadow-sm">
                    </div>

                    <!-- Hidden file input -->
                    <input type="file" id="logo-upload" accept="image/*" class="hidden">

                    <!-- Upload button -->
                    <button id="upload-btn" type="button"
                        class="px-4 py-2 bg-bangala hover:bg-bangala/90 text-white rounded-lg font-medium transition-colors">
                        <i class="fas fa-upload mr-2"></i>
                        Unggah Logo Baru
                    </button>

                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                        Format: JPG, PNG (max. 2MB)<br>
                        Disarankan: Rasio 1:1 (persegi)
                    </p>

                    <!-- Cropper modal -->
                    <div id="cropper-modal"
                        class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden items-center justify-center p-4">
                        <div class="cropper-modal-container bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                            <div class="flex justify-between items-center p-4 border-b dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Edit Logo</h3>
                                <button id="close-cropper"
                                    class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <div class="p-4 cropper-image-container">
                                <img id="image-to-crop" src="" alt="Logo yang akan dipotong">
                            </div>

                            <div class="p-4 border-t dark:border-gray-700">
                                <div class="cropper-actions">
                                    <button id="crop-btn"
                                        class="px-4 py-2 bg-bangala hover:bg-bangala/90 text-white rounded-lg">
                                        <i class="fas fa-crop mr-2"></i> Potong & Simpan
                                    </button>
                                    <button id="cancel-crop"
                                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg">
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Informasi Aplikasi -->
        <div class="lg:col-span-2">
            <div
                class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 shadow-sm h-full flex flex-col justify-between">
                <div>
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
                        <h2 class="font-semibold text-lg text-gray-800 dark:text-white">Informasi Aplikasi</h2>
                        <button type="submit" form="form-profile"
                            class="bg-bangala hover:bg-bangala/90 text-white px-6 py-2.5 rounded-lg font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-bangala focus:ring-offset-2">
                            Simpan Perubahan
                        </button>
                    </div>

                    <form id="form-profile" class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @csrf
                        <!-- Nama Aplikasi -->
                        <div>
                            <label for="nama_aplikasi"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama
                                Aplikasi</label>
                            <input type="text" id="nama_aplikasi" name="nama_aplikasi"
                                value="{{ old('nama_aplikasi', $data->nama_aplikasi ?? '') }}"
                                class="w-full px-3.5 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent transition-all">
                        </div>
                        <!-- Nama Sekolah -->
                        <div>
                            <label for="nama_sekolah"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama
                                Sekolah</label>
                            <input type="text" id="nama_sekolah" name="nama_sekolah"
                                value="{{ old('nama_sekolah', $data->nama_sekolah ?? '') }}"
                                class="w-full px-3.5 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent transition-all">
                        </div>
                        <div class="md:col-span-2">
                            <label for="singkatan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Kepanjangan
                                Aplikasi</label>
                            <input type="text" id="singkatan" name="singkatan"
                                value="{{ old('singkatan', $data->singkatan ?? '') }}"
                                class="w-full px-3.5 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent transition-all">
                        </div>
                        <!-- Keterangan Aplikasi -->
                        <div class="md:col-span-2">
                            <label for="keterangan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Keterangan
                                Aplikasi</label>
                            <textarea id="keterangan" name="keterangan"
                                class="w-full px-3.5 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent transition-all">{{ old('keterangan', $data->keterangan ?? '') }}</textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
        $(document).ready(function() {
            let cropper;

            // Initialize file input
            $('#upload-btn').on('click', function() {
                $('#logo-upload').click();
            });

            // Handle file selection
            $('#logo-upload').on('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    // Check file size (max 2MB)
                    if (e.target.files[0].size > 2 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ukuran file terlalu besar',
                            theme: 'dark',
                            text: 'Maksimal ukuran file 2MB',
                            confirmButtonColor: '#913013'
                        });
                        return;
                    }

                    // Check file type
                    const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    if (!validTypes.includes(e.target.files[0].type)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Format tidak valid',
                            theme: 'dark',
                            text: 'Hanya format JPG, JPEG, atau PNG yang diperbolehkan',
                            confirmButtonColor: '#913013'
                        });
                        return;
                    }

                    // Show cropper modal
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        $('#image-to-crop').attr('src', event.target.result);
                        $('#cropper-modal').removeClass('hidden');
                        document.body.style.overflow = 'hidden'; // Prevent scrolling

                        // Initialize cropper
                        const image = document.getElementById('image-to-crop');
                        cropper = new Cropper(image, {
                            aspectRatio: 1,
                            viewMode: 3,
                            responsive: true,
                            cropBoxMovable: true,
                            cropBoxResizable: true,
                            toggleDragModeOnDblclick: false,
                            minContainerWidth: 300,
                            minContainerHeight: 300,
                            ready: function() {
                                const cropper = this.cropper;

                                // Ambil ukuran container dan gambar
                                const containerData = cropper.getContainerData();
                                const imageData = cropper.getImageData();

                                // Tentukan ukuran crop box (rasio 1:1)
                                const size = Math.min(containerData.width, containerData
                                    .height, imageData.naturalWidth, imageData
                                    .naturalHeight);

                                // Set crop box di tengah
                                // cropper.setCropBoxData({
                                //     width: size,
                                //     height: size,
                                //     left: (containerData.width - size) / 2,
                                //     top: (containerData.height - size) / 2
                                // });
                            }
                        });
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
            });

            // Handle crop button
            $('#crop-btn').on('click', function() {
                if (cropper) {
                    // Get cropped canvas
                    const canvas = cropper.getCroppedCanvas({
                        width: 1024,
                        height: 1024,
                        minWidth: 256,
                        minHeight: 256,
                        maxWidth: 2048,
                        maxHeight: 2048,
                        imageSmoothingEnabled: true,
                        imageSmoothingQuality: 'high',
                    });

                    if (canvas) {
                        // Convert canvas to blob
                        canvas.toBlob(function(blob) {
                            // Create a URL for the cropped image
                            const url = URL.createObjectURL(blob);

                            // Update preview
                            $('#image-preview').attr('src', url);

                            // Create a new File object from the blob
                            const file = new File([blob], 'logo.png', {
                                type: 'image/png'
                            });

                            // Create a new FileList and set it to the input
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file);
                            $('#logo-upload').prop('files', dataTransfer.files);

                            // Close cropper
                            $('#cropper-modal').addClass('hidden');
                            document.body.style.overflow = ''; // Re-enable scrolling
                            cropper.destroy();

                            // Show success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Gambar berhasil dipotong',
                                theme: 'dark',
                                showConfirmButton: false,
                                confirmButtonColor: '#913013',
                                timer: 1500,
                                timerProgressBar: true
                            });
                        }, 'image/png');
                    }
                }
            });

            // Handle cancel crop
            $('#cancel-crop, #close-cropper').on('click', function() {
                $('#cropper-modal').addClass('hidden');
                document.body.style.overflow = ''; // Re-enable scrolling
                if (cropper) {
                    cropper.destroy();
                }
                // Reset file input
                $('#logo-upload').val('');
            });

            // Handle form submission
            $('#form-profile').on('submit', function(e) {
                e.preventDefault();

                const url = '{{ route('admin.pengaturan.update') }}';
                const formData = new FormData(this);

                // Append the logo file if it exists
                if ($('#logo-upload')[0].files[0]) {
                    formData.append('logo', $('#logo-upload')[0].files[0]);
                }

                formData.append('_method', 'PUT');

                // Show loading indicator
                const submitBtn = $(this).find('button[type="submit"]');
                submitBtn.prop('disabled', true);
                submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...');

                // AJAX call
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        successToast(response);
                        submitBtn.prop('disabled', false);
                        submitBtn.html('Simpan Perubahan');
                    },
                    error: function(xhr) {
                        errorToast(xhr.responseJSON?.message || 'Terjadi kesalahan');
                        submitBtn.prop('disabled', false);
                        submitBtn.html('Simpan Perubahan');
                    }
                });
            });
        });
    </script>
@endpush
