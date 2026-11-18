<div class="car-card group">
    <a class="car-card-media" href="{{ route('car.details', $car) }}">
        <img loading="lazy" src="{{ $car->coverPath() }}" alt="{{ $car->brandName() }} {{ $car->modelName() }}">
        @if ($car->reduce)
            <span class="car-card-badge">-{{ $car->reduce }}%</span>
        @endif
    </a>
    <div class="car-card-body">
        <a href="{{ route('car.details', $car) }}" class="car-card-title-link">
            <h5 class="car-card-title">{{ $car->brandName() }} {{ $car->modelName() }}</h5>
            <p class="car-card-engine">{{ $car->engine }}</p>
        </a>
        <div class="car-card-meta">
            <div>
                <p class="car-card-price">{{ $car->price_per_day }} <span>AZN</span></p>
                @if ($car->reduce && $car->reduce < 100)
                    <p class="car-card-old-price">{{ intval(($car->price_per_day * 100) / (100 - $car->reduce)) }} AZN</p>
                @endif
            </div>
            <div class="car-card-rating">
                <svg aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <span>{{ $car->stars }}.0</span>
            </div>
        </div>
        <div class="car-card-actions">
            <a href="{{ route('car.details', $car) }}" class="car-card-btn car-card-btn-ghost">{{ __('Details') }}</a>
            <a href="{{ route('car.reservation', ['car' => $car->id]) }}" class="car-card-btn car-card-btn-primary">{{ __('Reserve') }}</a>
        </div>
    </div>
</div>

@once
<style>
    .car-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 100%;
        overflow: hidden;
        border: 1px solid #f3f4f6;
        border-radius: 0.75rem;
        background: #fff;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .car-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }
    .car-card-media {
        position: relative;
        display: block;
        margin: 0.75rem 0.75rem 0;
        aspect-ratio: 16 / 10;
        height: auto;
        overflow: hidden;
        border-radius: 0.5rem;
        background: #f3f4f6;
    }
    .car-card-media img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform .3s ease;
    }
    .car-card:hover .car-card-media img {
        transform: scale(1.03);
    }
    .car-card-badge {
        position: absolute;
        left: 0.5rem;
        top: 0.5rem;
        border-radius: 0.375rem;
        background: #D53338;
        color: #fff;
        font-size: 0.75rem;
        font-weight: 600;
        line-height: 1;
        padding: 0.35rem 0.5rem;
    }
    .car-card-body {
        display: flex;
        flex: 1 1 auto;
        flex-direction: column;
        padding: 0.85rem 1rem 1rem;
    }
    .car-card-title-link { text-decoration: none; color: inherit; }
    .car-card-title-link:hover .car-card-title { color: #c02b30; }
    .car-card-title {
        margin: 0;
        font-family: Rubik, ui-sans-serif, system-ui, sans-serif;
        font-size: 1.125rem;
        font-weight: 700;
        line-height: 1.3;
        color: #0f172a;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .car-card-engine {
        margin: 0.35rem 0 0;
        font-size: 0.875rem;
        color: #6b7280;
        min-height: 1.25rem;
    }
    .car-card-meta {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 0.5rem;
        margin: 0.85rem 0 1rem;
        min-height: 3.25rem;
    }
    .car-card-price {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1.1;
        color: #0f172a;
    }
    .car-card-price span {
        font-size: 0.875rem;
        font-weight: 500;
        color: #6b7280;
    }
    .car-card-old-price {
        margin: 0.2rem 0 0;
        font-size: 0.75rem;
        color: #9ca3af;
        text-decoration: line-through;
    }
    .car-card-rating {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        border-radius: 9999px;
        background: #fdebec;
        padding: 0.25rem 0.5rem;
        color: #D53338;
        flex-shrink: 0;
    }
    .car-card-rating svg {
        width: 1rem;
        height: 1rem;
        display: block;
    }
    .car-card-rating span {
        font-size: 0.75rem;
        font-weight: 600;
        color: #8f1f23;
    }
    .car-card-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
        margin-top: auto;
    }
    .car-card-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 2.6rem;
        border-radius: 0.5rem;
        padding: 0.55rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        text-align: center;
        transition: background .15s ease, color .15s ease, border-color .15s ease;
    }
    .car-card-btn-ghost {
        border: 1px solid #d1d5db;
        color: #1e293b;
        background: #fff;
    }
    .car-card-btn-ghost:hover {
        border-color: #0f172a;
        background: #0f172a;
        color: #fff;
    }
    .car-card-btn-primary {
        border: 1px solid #D53338;
        background: #D53338;
        color: #fff;
    }
    .car-card-btn-primary:hover {
        background: #c02b30;
        border-color: #c02b30;
    }
</style>
@endonce
