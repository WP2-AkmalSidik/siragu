@extends('layouts.admin')

@section('title', 'Edit Penilaian')
@section('description', 'Form Edit Penilaian')

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden">
        <!-- Header Info -->
        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="space-y-1">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Target Penilaian</p>
                    <p class="font-semibold text-gray-900 dark:text-white">{{ $nilais->first()->target->nama }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ toTitleCase($nilais->first()->penilaian->form->target->jabatan->jabatan) ?? '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Formulir</p>
                    <p class="font-semibold text-gray-900 dark:text-white">{{ $nilais->first()->penilaian->form->nama }}</p>
                </div>

                <div class="space-y-1">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Periode</p>
                    <p class="font-semibold text-gray-900 dark:text-white">
                        {{ $nilais->first()->tahun_ajaran }} - {{ ucfirst($nilais->first()->semester) }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <form id="edit-nilai-form" action="{{ route('admin.pengisi.update.save') }}" method="POST"
            class="divide-y divide-gray-200 dark:divide-gray-700">
            @csrf
            @method('PUT')

            @php
                $grouped = $nilais
                    ->groupBy(function ($item) {
                        return $item->penilaian->kategori->kategori ?? 'Tanpa Kategori';
                    })
                    ->map(function ($items) {
                        return $items->groupBy(function ($item) {
                            return $item->penilaian->subKategori->sub_kategori ?? 'Tanpa Sub Kategori';
                        });
                    });
            @endphp

            @foreach ($grouped as $kategori => $subGroup)
                <!-- Category Section -->
                <section class="py-5 px-6">
                    @if ($kategori !== 'Tanpa Kategori')
                        <h3
                            class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4 px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded-md inline-block">
                            {{ $kategori }}
                        </h3>
                    @endif

                    <div class="space-y-6 ml-4">
                        @foreach ($subGroup as $subKategori => $items)
                            <!-- Subcategory Section -->
                            <div class="border-l-4 border-gray-300 dark:border-gray-600 pl-4">
                                @if ($subKategori !== 'Tanpa Sub Kategori')
                                    <h4 class="text-md font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                        {{ $subKategori }}
                                    </h4>
                                @endif

                                <!-- Items List -->
                                <div class="space-y-4">
                                    @foreach ($items as $nilai)
                                        @php
                                            $penilaian = $nilai->penilaian;
                                            $tipeInput = $penilaian->form->tipe->tipe_input ?? 'select';
                                        @endphp

                                        <div
                                            class="p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                                            <h5 class="font-medium text-gray-800 dark:text-gray-200 mb-3">
                                                {{ $penilaian->nama }}
                                            </h5>

                                            <!-- Input Field -->
                                            <div>
                                                @if (in_array($tipeInput, ['radio', 'select']))
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nilai</label>
                                                    <select name="nilai[{{ $nilai->id }}]"
                                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700">
                                                        @foreach ($penilaian->form->tipe->opsi as $opsi)
                                                            <option value="{{ $opsi->value }}"
                                                                {{ $nilai->nilai == $opsi->value ? 'selected' : '' }}>
                                                                {{ $opsi->label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @elseif($tipeInput === 'number')
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nilai
                                                        (0-100)</label>
                                                    <input type="number" name="nilai[{{ $nilai->id }}]" min="0"
                                                        max="100" value="{{ $nilai->nilai }}"
                                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700">
                                                @else
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nilai</label>
                                                    <textarea name="nilai[{{ $nilai->id }}]" rows="3"
                                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700">{{ $nilai->nilai }}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach

            <!-- Form Footer -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 text-right">
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Batal
                </a>
                <button type="submit"
                    class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#edit-nilai-form').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const formData = new FormData(this);

                ajaxCall(
                    form.attr('action'),
                    form.attr('method'),
                    formData,
                    function(res) {
                        successToast(res);
                    },
                    function(err) {
                        errorToast(err);
                    }
                );
            });
        });
    </script>
@endpush
