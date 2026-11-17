@extends('layouts.myapp')

@section('title', __('Rent a Car') . ' | ' . __('All rental cars') . ' — ButaRent')
@section('meta_description', __('Browse our car rental fleet. Rent economy, SUV and luxury cars online with daily prices and fast booking.'))
@section('meta_keywords', 'rent a car, car rental fleet, hire a car, cheap rental cars, SUV rental, ButaRent')
@section('canonical', route('cars'))

@section('content')
    <div class="mx-auto max-w-screen-xl px-4 pt-6">
        <div class="mb-5">
            <h1 class="font-car text-2xl font-bold text-gray-900 md:text-3xl">{{ __('Rent a Car') }} — {{ __('All rental cars') }}</h1>
            <p class="mt-1 text-sm text-gray-500">{{ __('Find the right car for your trip.') }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white px-4 py-4">
            @include('partials.car-search-form', ['brands' => $brands])
        </div>

        <div class="cars-grid mt-6 mb-8">
            @forelse ($cars as $car)
                @include('cars.card', ['car' => $car])
            @empty
                <div class="cars-grid-empty py-20 text-center">
                    <p class="font-car text-2xl text-gray-600">{{ __('no car found') }}</p>
                    <a href="{{ route('cars') }}" class="mt-4 inline-block text-pr-500 hover:underline">{{ __('All') }}</a>
                </div>
            @endforelse
        </div>

        <style>
            .cars-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1.25rem;
            }
            @media (min-width: 640px) {
                .cars-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            }
            @media (min-width: 1024px) {
                .cars-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
            }
            .cars-grid-empty { grid-column: 1 / -1; }
        </style>

        <div class="mb-12 flex w-full justify-center">
            {{ $cars->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
