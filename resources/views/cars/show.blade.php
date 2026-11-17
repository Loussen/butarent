@extends('layouts.myapp')

@php
    $photos = $car->galleryPaths();
    $carTitle = $car->brandName().' '.$car->modelName();
    $carDesc = $car->localizedDescription()
        ?: __('Rent :car online. Daily car rental from :price AZN/day.', ['car' => $carTitle, 'price' => $car->price_per_day]);
@endphp

@section('title', $carTitle . ' | ' . __('Rent a Car') . ' — ButaRent')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($carDesc), 155))
@section('meta_keywords', strtolower($carTitle) . ', rent a car, car rental, hire ' . strtolower($car->brandName()) . ', ButaRent')
@section('canonical', route('car.details', $car))
@section('og_type', 'product')
@section('og_image', $car->coverPath())

@push('jsonld')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Product',
    'name' => $carTitle,
    'description' => strip_tags($carDesc),
    'image' => url($car->coverPath()),
    'brand' => [
        '@type' => 'Brand',
        'name' => $car->brandName(),
    ],
    'offers' => [
        '@type' => 'Offer',
        'priceCurrency' => 'AZN',
        'price' => (string) $car->price_per_day,
        'availability' => strtolower((string) $car->status) === 'available'
            ? 'https://schema.org/InStock'
            : 'https://schema.org/OutOfStock',
        'url' => route('car.details', $car),
    ],
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('content')
    <div class="mx-auto max-w-screen-xl px-4 py-8 md:py-12">
        <nav class="mb-6 text-sm text-gray-500" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-pr-500">{{ __('Home') }}</a>
            <span class="mx-2">/</span>
            <a href="{{ route('cars') }}" class="hover:text-pr-500">{{ __('Rent a Car') }}</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800">{{ $carTitle }}</span>
        </nav>

        <div class="grid gap-8 md:grid-cols-2 rounded-2xl border border-gray-200 bg-white p-4 shadow-sm md:p-8">
            <div>
                @if (count($photos))
                    <div class="overflow-hidden rounded-xl bg-gray-100">
                        <img id="car-main-photo" src="{{ $photos[0] }}" alt="{{ $car->brandName() }} {{ $car->modelName() }}"
                            class="h-72 w-full object-cover md:h-96">
                    </div>
                    @if (count($photos) > 1)
                        <div class="mt-3 flex gap-2 overflow-x-auto pb-1">
                            @foreach ($photos as $index => $photo)
                                <button type="button"
                                    class="car-thumb shrink-0 overflow-hidden rounded-lg border-2 {{ $index === 0 ? 'border-pr-400' : 'border-transparent' }}"
                                    data-photo="{{ $photo }}"
                                    onclick="setMainPhoto(this)">
                                    <img src="{{ $photo }}" alt="" class="h-16 w-24 object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>

            <div class="flex flex-col">
                <div class="flex flex-wrap items-start justify-between gap-3">
                    <div>
                        <h1 class="font-car text-3xl font-bold text-gray-900 md:text-4xl">{{ $car->brandName() }} {{ $car->modelName() }}</h1>
                        <p class="mt-1 text-gray-500">{{ $car->engine }}</p>
                    </div>
                    @if ($car->reduce)
                        <span class="rounded-full bg-pr-100 px-3 py-1 text-sm font-semibold text-pr-700">-{{ $car->reduce }}%</span>
                    @endif
                </div>

                <div class="mt-5 flex items-end gap-2">
                    <p class="text-4xl font-bold text-slate-900">{{ $car->price_per_day }}</p>
                    <p class="mb-1 text-gray-500">AZN / {{ __('day') }}</p>
                </div>

                <dl class="mt-6 grid grid-cols-2 gap-3 text-sm">
                    <div class="rounded-lg bg-sec-300 px-3 py-3">
                        <dt class="text-gray-500">{{ __('Engine') }}</dt>
                        <dd class="mt-1 font-semibold text-gray-900">{{ $car->engine }}</dd>
                    </div>
                    <div class="rounded-lg bg-sec-300 px-3 py-3">
                        <dt class="text-gray-500">{{ __('Rating') }}</dt>
                        <dd class="mt-1 font-semibold text-gray-900">{{ $car->stars }}/5</dd>
                    </div>
                    <div class="rounded-lg bg-sec-300 px-3 py-3">
                        <dt class="text-gray-500">{{ __('Quantity') }}</dt>
                        <dd class="mt-1 font-semibold text-gray-900">{{ $car->quantity }}</dd>
                    </div>
                    <div class="rounded-lg bg-sec-300 px-3 py-3">
                        <dt class="text-gray-500">{{ __('Status') }}</dt>
                        <dd class="mt-1 font-semibold text-gray-900">{{ __($car->status) }}</dd>
                    </div>
                </dl>

                <div class="mt-6">
                    <h2 class="font-car text-xl font-semibold text-gray-900">{{ __('General information') }}</h2>
                    <p class="mt-2 leading-relaxed text-gray-700 whitespace-pre-line">{{ $car->localizedDescription() ?: __('No description yet.') }}</p>
                </div>

                <div class="mt-auto flex flex-col gap-3 pt-8 sm:flex-row">
                    <a href="{{ route('car.reservation', ['car' => $car->id]) }}"
                        class="inline-flex flex-1 items-center justify-center rounded-lg bg-pr-400 px-6 py-3 text-sm font-semibold text-white transition hover:bg-pr-500">{{ __('Reserve') }}</a>
                    <a href="{{ route('cars') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">{{ __('Back to cars') }}</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setMainPhoto(btn) {
            const photo = btn.getAttribute('data-photo');
            document.getElementById('car-main-photo').src = photo;
            document.querySelectorAll('.car-thumb').forEach(function (el) {
                el.classList.remove('border-pr-400');
                el.classList.add('border-transparent');
            });
            btn.classList.remove('border-transparent');
            btn.classList.add('border-pr-400');
        }
    </script>
@endsection