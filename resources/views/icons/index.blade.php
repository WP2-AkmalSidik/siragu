@extends('layouts.admin')

@section('title', 'Font Awesome Free Icons')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@section('content')
    <section class="py-6 px-4">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-bangala-800">@yield('title')</h1>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach ($icons as $icon)
                @foreach ($icon['styles'] as $style)
                    <div class="border rounded-xl shadow-sm p-4 text-center hover:shadow-md transition">
                        <i class="fa-{{ $style }} fa-{{ $icon['name'] }} text-2xl text-bangala-700"></i>
                        <div class="mt-2 text-sm text-bangala-600 truncate">
                            {{ $icon['name'] }}
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </section>
@endsection
