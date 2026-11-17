@extends('layouts.myapp')
@section('content')
    <div class="mx-auto max-w-screen-xl px-4">
        <div class="my-12 flex flex-col rounded-md bg-white p-6 md:flex-row">
            <div class="flex flex-col gap-8 md:w-1/4 md:border-r md:border-gray-900">
                <div class="flex justify-center">
                    <img loading="lazy" class="w-[150px]" src="{{ $user->avatar }}" alt="{{ $user->name }}">
                </div>
                <div class="text-center md:text-start">
                    <h2 class="text-lg font-medium text-gray-900">
                        <span class="font-car text-lg font-normal text-gray-500">{{ __('Name') }}:</span>
                        {{ $user->name }}
                    </h2>
                    <h2 class="text-lg font-medium text-gray-900">
                        <span class="font-car text-lg font-normal text-gray-500">{{ __('Email') }}:</span>
                        {{ $user->email }}
                    </h2>
                    <h2 class="text-lg font-medium text-green-600">
                        <span class="font-car text-lg font-normal text-gray-500">{{ __('Active Reservations') }}:</span>
                        {{ $user->reservations->where('status', 'Active')->count() }}
                    </h2>
                    <h2 class="text-lg font-medium text-yellow-500">
                        <span class="font-car text-lg font-normal text-gray-500">{{ __('Pending Reservations') }}:</span>
                        {{ $user->reservations->where('status', 'Pending')->count() }}
                    </h2>
                    <h2 class="text-lg font-medium text-gray-900">
                        <span class="font-car text-lg font-normal text-gray-500">{{ __('Ended Reservations') }}:</span>
                        {{ $user->reservations->where('status', 'Ended')->count() }}
                    </h2>
                    <h2 class="text-lg font-medium text-red-600">
                        <span class="font-car text-lg font-normal text-gray-500">{{ __('Canceled Reservations') }}:</span>
                        {{ $user->reservations->where('status', 'Canceled')->count() }}
                    </h2>
                    <h2 class="text-lg font-medium text-pr-400">
                        <span class="font-car text-lg font-normal text-gray-500">{{ __('Total Reservations') }}:</span>
                        {{ $user->reservations->count() }}
                    </h2>
                </div>
            </div>

            <div class="mt-8 md:mt-0 md:w-3/4">
                @forelse ($user->reservations as $reservation)
                    <div class="mb-4 flex justify-center rounded-lg bg-gray-200 md:m-6">
                        <div class="m-3 hidden h-[250px] w-[350px] overflow-hidden rounded-md p-1 md:block">
                            <img loading="lazy" class="h-full w-full rounded-md object-cover"
                                src="{{ $reservation->car->coverPath() }}" alt="{{ $reservation->car->brand }} {{ $reservation->car->model }}">
                        </div>
                        <div class="m-3 w-full p-1 md:w-[500px]">
                            <h2 class="mt-2 font-car text-2xl font-medium text-gray-800">
                                {{ $reservation->car->brand }} {{ $reservation->car->model }} {{ $reservation->car->engine }}
                            </h2>
                            <div class="mt-4 flex justify-start gap-5 md:gap-10">
                                <div class="flex items-center gap-2">
                                    <p class="text-lg font-medium">{{ __('From') }}:</p>
                                    <p class="text-lg font-semibold text-pr-600">
                                        {{ Carbon\Carbon::parse($reservation->start_date)->format('Y-m-d') }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <p class="text-lg font-medium">{{ __('To') }}:</p>
                                    <p class="text-lg font-semibold text-pr-600">
                                        {{ Carbon\Carbon::parse($reservation->end_date)->format('Y-m-d') }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <p class="text-lg font-medium">{{ __('Price') }}:</p>
                                    <p class="text-lg font-semibold text-pr-600">{{ $reservation->total_price }} <span class="text-black">AZN</span></p>
                                </div>
                            </div>
                            <div class="mt-8 flex justify-start gap-6 md:gap-16">
                                <div class="flex items-center gap-2 md:gap-2">
                                    <p class="text-lg font-medium">{{ __('Payment') }}:</p>
                                    <span class="rounded-md px-3 py-1 text-sm text-white
                                        {{ $reservation->payment_status == 'Pending' ? 'bg-yellow-300' : '' }}
                                        {{ $reservation->payment_status == 'Canceled' ? 'bg-red-500' : '' }}
                                        {{ $reservation->payment_status == 'Paid' ? 'bg-green-500' : '' }}">
                                        {{ __($reservation->payment_status) }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <p class="text-lg font-medium">{{ __('Reservation') }}:</p>
                                    <span class="rounded-md px-3 py-1 text-sm text-white
                                        {{ $reservation->status == 'Pending' ? 'bg-yellow-300' : '' }}
                                        {{ $reservation->status == 'Ended' ? 'bg-black' : '' }}
                                        {{ $reservation->status == 'Active' ? 'bg-green-500' : '' }}
                                        {{ $reservation->status == 'Canceled' ? 'bg-red-500' : '' }}">
                                        {{ __($reservation->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="mx-auto mt-3 h-[250px] w-[350px] overflow-hidden rounded-md p-1 md:hidden">
                                <img loading="lazy" class="h-full w-full rounded-md object-cover"
                                    src="{{ $reservation->car->coverPath() }}" alt="">
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="p-6 text-center text-gray-500">{{ __('No reservations found.') }}</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
