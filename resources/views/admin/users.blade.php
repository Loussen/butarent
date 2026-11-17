@extends('layouts.myapp')
@section('content')
    <div class="mx-auto max-w-screen-xl px-4">
        <div class="mt-10 mb-2">
            <h1 class="font-car text-3xl font-bold text-gray-800">{{ __('Users') }}</h1>
            <p class="mt-1 text-sm text-gray-500">{{ __('Manage admins and clients.') }}</p>
        </div>

        {{-- Admins --}}
        <div class="mt-10">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-1 items-center justify-center sm:justify-start">
                    <hr class="mt-1 hidden h-0.5 w-16 bg-pr-500 sm:block">
                    <p class="mx-4 font-car text-lg font-bold text-gray-600">{{ __('Admins') }}</p>
                    <hr class="mt-1 hidden h-0.5 flex-1 bg-pr-500 sm:block">
                </div>
                <a href="{{ route('addAdmin') }}"
                    class="inline-flex items-center justify-center rounded-lg border-2 border-pr-500 px-4 py-2 font-car font-medium text-gray-800 transition hover:bg-pr-400 hover:text-white">
                    {{ __('Add new admin') }}
                </a>
            </div>
        </div>

        <div class="mt-6 grid gap-6 md:grid-cols-3">
            @forelse ($admins as $admin)
                <div class="mx-2 flex items-center justify-start rounded-xl border border-gray-100 bg-white shadow-sm">
                    <div class="m-3 w-1/6 overflow-hidden rounded-full">
                        <img loading="lazy" src="{{ $admin->avatar }}" alt="{{ $admin->name }}" class="h-12 w-12 object-cover">
                    </div>
                    <div class="my-3">
                        <h2 class="font-car text-xl font-semibold text-gray-900">{{ $admin->name }}</h2>
                        <h3 class="font-medium text-gray-700">{{ $admin->email }}</h3>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">{{ __('No admins found.') }}</p>
            @endforelse
        </div>

        {{-- Clients --}}
        <div class="mt-12">
            <div class="flex items-center justify-center">
                <hr class="mt-1 h-0.5 w-1/4 bg-pr-500">
                <p class="mx-8 font-car text-lg font-bold text-gray-600">{{ __('Clients') }}</p>
                <hr class="mt-1 h-0.5 w-1/4 bg-pr-500">
            </div>
        </div>

        <div class="mb-12 mt-6 w-full overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="w-full overflow-x-auto">
                <table class="w-full table-auto whitespace-nowrap text-center">
                    <thead>
                        <tr class="border-b bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="px-4 py-3 text-center">{{ __('Client') }}</th>
                            <th class="px-4 py-3 text-center">{{ __('Name') }}</th>
                            <th class="px-4 py-3 text-center">{{ __('Email') }}</th>
                            <th class="px-4 py-3 text-center">{{ __('Joined at') }}</th>
                            <th class="px-4 py-3 text-center">{{ __('Reservations') }}</th>
                            <th class="px-4 py-3 text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y bg-white">
                        @forelse ($clients as $client)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    <img loading="lazy" src="{{ $client->avatar }}" alt="{{ $client->name }}"
                                        class="mx-auto h-10 w-10 rounded-full object-cover">
                                </td>
                                <td class="px-4 py-3 text-sm">{{ $client->name }}</td>
                                <td class="px-4 py-3 text-sm">{{ $client->email }}</td>
                                <td class="px-4 py-3 text-sm">
                                    {{ Carbon\Carbon::parse($client->created_at)->format('Y-m-d') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-center">
                                    @if (($client->reservations_count ?? 0) > 0)
                                        <span class="font-bold">{{ $client->reservations_count }}</span>
                                        {{ __('reservation') }}
                                    @else
                                        {{ __('No active reservations') }}
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('userDetails', ['user' => $client->id]) }}"
                                        class="inline-flex rounded-md bg-blue-500 px-3 py-2 text-white transition hover:bg-blue-700">
                                        {{ __('Details') }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-10 text-center text-gray-500">{{ __('No clients found.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="my-8 flex w-full justify-center">
                {{ $clients->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
@endsection
