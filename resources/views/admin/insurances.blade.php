@extends('layouts.myapp')
@section('content')
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl ">
        <div class="flex flex-col flex-1 w-full">
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid mb-32 ">
                    <div class="mt-10 mb-2">
                        <h1 class="font-car text-3xl font-bold text-gray-800">{{ __('Insurances') }}</h1>
                        <p class="mt-1 text-sm text-gray-500">{{ __('Manage car insurance policies.') }}</p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6 mb-8 mt-8 ">
                        <div class="flex items-center p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                            <div class="p-3 mr-4 bg-blue-400 rounded-full ">
                                <svg style="fill: #fff" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                    <path d="M135.2 117.4L109.1 192H402.9l-26.1-74.6C372.3 104.6 360.2 96 346.6 96H165.4c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32H346.6c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2V400v48c0 17.7-14.3 32-32 32H448c-17.7 0-32-14.3-32-32V400H96v48c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V400 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-lg font-medium text-gray-500 ">{{ __('Total Cars') }}</p>
                                <p class="text-lg font-semibold text-gray-700">{{ $cars->count() }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                            <div class="p-3 mr-4 bg-green-400 rounded-full ">
                                <svg style="fill: #fff" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                    <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-lg font-medium text-gray-500 ">{{ __('Insured cars') }}</p>
                                <p class="text-lg font-semibold text-gray-700">{{ $cars->where('insu_id', '!=', null)->count() }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                            <div class="p-3 mr-4 bg-red-500 rounded-full ">
                                <svg style="fill: #fff" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-lg font-medium text-gray-500 ">{{ __('Uninsured cars') }}</p>
                                <p class="text-lg font-semibold text-gray-700">{{ $cars->where('insu_id', null)->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mx-auto max-w-screen-xl">
                        <a href="{{ route('insurances.create') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-pr-400 px-4 py-3 font-bold text-white transition hover:bg-pr-500">
                            <svg style="fill: #fff" xmlns="http://www.w3.org/2000/svg" height="1.25em" viewBox="0 0 448 512">
                                <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                            </svg>
                            {{ __('Insure a new car') }}
                        </a>
                    </div>

                    <div class="mt-12">
                        <div class="flex align-middle justify-center">
                            <hr class=" mt-8 h-0.5 w-1/2 bg-pr-500">
                            <p class="my-2 mx-8 p-2 font-car font-bold text-gray-600 text-lg ">{{ __('Insurance list') }}</p>
                            <hr class=" mt-8 h-0.5 w-1/2 bg-pr-500">
                        </div>
                    </div>

                    <div class="w-full overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                                        <th class="px-4 py-3">{{ __('Car') }}</th>
                                        <th class="px-4 py-3">{{ __('Insurance Company') }}</th>
                                        <th class="px-4 py-3">{{ __('Type') }}</th>
                                        <th class="px-4 py-3">{{ __('Started at') }}</th>
                                        <th class="px-4 py-3">{{ __('End at') }}</th>
                                        <th class="px-4 py-3">{{ __('Duration') }}</th>
                                        <th class="px-4 py-3">{{ __('Price') }}</th>
                                        <th class="px-4 py-3">{{ __('Status') }}</th>
                                        <th class="px-4 py-3">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y">
                                    @forelse ($insurances as $insu)
                                        <tr class="text-gray-700">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <div class="relative hidden w-8 h-8 mr-3 overflow-hidden rounded md:block">
                                                        <img loading="lazy" class="object-cover w-full h-full"
                                                            src="{{ $insu->car?->coverPath() ?? ($insu->car->image ?? '') }}" alt="" />
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold">{{ $insu->car->brand ?? '' }} {{ $insu->car->model ?? '' }}</p>
                                                        <p class="text-xs text-gray-600">{{ $insu->car->engine ?? '' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm">{{ $insu->company }}</td>
                                            <td class="px-4 py-3 text-sm">{{ __($insu->type) }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $insu->start_date }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $insu->end_date }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                @if ($insu->end_date > $insu->start_date)
                                                    {{ Carbon\Carbon::parse($insu->end_date)->diffInDays(Carbon\Carbon::parse($insu->start_date)) }}
                                                    {{ __('days') }}
                                                @else
                                                    —
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-sm">{{ $insu->price }} AZN</td>
                                            <td class="px-4 py-3 text-xs">
                                                @if ($insu->status == 'Active')
                                                    <p class="rounded-lg bg-green-100 text-green-700 text-center p-1">{{ __($insu->status) }}</p>
                                                @else
                                                    <p class="rounded-lg bg-red-100 text-red-700 text-center p-1">{{ __($insu->status) }}</p>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">
                                                <form action="{{ route('insurances.destroy', ['insurance' => $insu->id]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm(@json(__('Delete this insurance?')))">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="font-medium text-red-600 hover:underline">{{ __('Remove') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="px-4 py-10 text-center text-gray-500">{{ __('No insurances found.') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex justify-center my-12 w-full">
                        {{ $insurances->links('pagination::tailwind') }}
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
