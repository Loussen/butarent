<div class="group relative flex h-full w-full flex-col overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
    <a class="relative mx-3 mt-3 flex h-48 overflow-hidden rounded-lg bg-gray-100" href="{{ route('car.details', $car) }}">
        <img loading="lazy" class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.03]"
            src="{{ $car->coverPath() }}" alt="{{ $car->brandName() }} {{ $car->modelName() }}" />
        @if ($car->reduce)
            <span class="absolute left-2 top-2 rounded-md bg-pr-400 px-2 py-1 text-center text-xs font-semibold text-white">
                -{{ $car->reduce }}%
            </span>
        @endif
    </a>
    <div class="flex flex-1 flex-col px-4 pb-4 pt-3">
        <a href="{{ route('car.details', $car) }}" class="hover:text-pr-500">
            <h5 class="font-car text-lg font-bold tracking-tight text-slate-900 line-clamp-1">
                {{ $car->brandName() }} {{ $car->modelName() }}
            </h5>
            <p class="mt-1 text-sm text-gray-500">{{ $car->engine }}</p>
        </a>
        <div class="mb-4 mt-3 flex items-end justify-between gap-2">
            <div>
                <p class="text-2xl font-bold text-slate-900">{{ $car->price_per_day }} <span class="text-sm font-medium text-gray-500">AZN</span></p>
                @if ($car->reduce && $car->reduce < 100)
                    <p class="text-xs text-gray-400 line-through">{{ intval(($car->price_per_day * 100) / (100 - $car->reduce)) }} AZN</p>
                @endif
            </div>
            <div class="flex items-center rounded-full bg-pr-100 px-2 py-1">
                <svg aria-hidden="true" class="h-4 w-4 text-pr-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <span class="ml-1 text-xs font-semibold text-pr-700">{{ $car->stars }}.0</span>
            </div>
        </div>
        <div class="mt-auto grid grid-cols-2 gap-2">
            <a href="{{ route('car.details', $car) }}"
                class="flex items-center justify-center rounded-lg border border-gray-300 px-3 py-2.5 text-center text-sm font-medium text-slate-800 transition hover:border-slate-900 hover:bg-slate-900 hover:text-white">{{ __('Details') }}</a>
            <a href="{{ route('car.reservation', ['car' => $car->id]) }}"
                class="flex items-center justify-center rounded-lg bg-pr-400 px-3 py-2.5 text-center text-sm font-medium text-white transition hover:bg-pr-500">{{ __('Reserve') }}</a>
        </div>
    </div>
</div>
