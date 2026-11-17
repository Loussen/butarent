@extends('layouts.myapp')
@section('content')
    <div class="mx-auto my-10 max-w-screen-xl px-4">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="font-car text-3xl font-bold text-gray-900">{{ __('Cars') }}</h1>
                <p class="mt-1 text-sm text-gray-500">{{ __('Manage fleet cars, photos and pricing.') }}</p>
            </div>
            <a href="{{ route('cars.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-lg bg-pr-400 px-4 py-2.5 font-semibold text-white shadow-sm transition hover:bg-pr-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ __('Add New Car') }}
            </a>
        </div>

        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                        <tr>
                            <th class="px-4 py-3">{{ __('Image') }}</th>
                            <th class="px-4 py-3">{{ __('Brand') }}</th>
                            <th class="px-4 py-3">{{ __('Model') }}</th>
                            <th class="px-4 py-3">{{ __('Engine') }}</th>
                            <th class="px-4 py-3">{{ __('Price per day') }}</th>
                            <th class="px-4 py-3">{{ __('Quantity') }}</th>
                            <th class="px-4 py-3">{{ __('Insurance') }}</th>
                            <th class="px-4 py-3">{{ __('Status') }}</th>
                            <th class="px-4 py-3">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($cars as $car)
                            <tr class="hover:bg-gray-50/80">
                                <td class="px-4 py-3">
                                    <div class="overflow-hidden rounded-md border border-pr-200" style="width:72px;height:54px;">
                                        <img loading="lazy" src="{{ $car->coverPath() }}" alt="" style="width:72px;height:54px;object-fit:cover;display:block;">
                                    </div>
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $car->brandName() }}</td>
                                <td class="px-4 py-3">{{ $car->modelName() }}</td>
                                <td class="px-4 py-3">{{ $car->engine }}</td>
                                <td class="px-4 py-3 font-semibold text-gray-900">{{ $car->price_per_day }}</td>
                                <td class="px-4 py-3">{{ $car->quantity }}</td>
                                <td class="px-4 py-3">
                                    @if ($car->insu_id != null)
                                        <span class="inline-flex rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">{{ __('Active') }}</span>
                                    @else
                                        <span class="inline-flex rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">{{ __('Not Active') }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex rounded-full bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-700">{{ __($car->status) }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('cars.edit', ['car' => $car->id]) }}"
                                            class="font-medium text-pr-600 hover:underline">{{ __('Edit') }}</a>
                                        <form action="{{ route('cars.destroy', ['car' => $car->id]) }}" method="POST"
                                            onsubmit="return confirm(@json(__('Delete this car?')))">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 hover:underline">{{ __('Remove') }}</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-4 py-10 text-center text-gray-500">{{ __('no car found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 mb-10 flex w-full justify-center">
            {{ $cars->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
