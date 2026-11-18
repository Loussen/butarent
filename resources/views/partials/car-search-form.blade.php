@php
    $selectedBrandId = request('brand_id');
    $selectedModelId = request('car_model_id');
    $modelsByBrand = $brands->mapWithKeys(function ($brand) {
        return [
            $brand->id => $brand->carModels->map(fn ($model) => [
                'id' => $model->id,
                'name' => $model->name,
            ])->values(),
        ];
    });
@endphp

<form action="{{ route('carSearch') }}" class="car-search-form w-full">
    <div class="car-search-row">
        <div class="car-search-field">
            <label for="search_brand_id">{{ __('Brand') }}</label>
            <select name="brand_id" id="search_brand_id" data-placeholder="{{ __('Brand') }}">
                <option value="">{{ __('Brand') }}</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" @selected((string) $selectedBrandId === (string) $brand->id)>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="car-search-field">
            <label for="search_car_model_id">{{ __('Model') }}</label>
            <select name="car_model_id" id="search_car_model_id" data-placeholder="{{ __('Model') }}">
                <option value="">{{ __('Model') }}</option>
            </select>
        </div>

        <div class="car-search-field">
            <label for="search_min_price">{{ __('minimum price') }}</label>
            <input id="search_min_price" type="number" min="0" step="1" placeholder="0" name="min_price" value="{{ request('min_price') }}">
        </div>

        <div class="car-search-field">
            <label for="search_max_price">{{ __('maximum price') }}</label>
            <input id="search_max_price" type="number" min="0" step="1" placeholder="∞" name="max_price" value="{{ request('max_price') }}">
        </div>

        <div class="car-search-actions">
            <button type="submit">{{ __('Search') }}</button>
            @if (!empty($showAllButton) || request()->filled('brand_id') || request()->filled('car_model_id') || request()->filled('min_price') || request()->filled('max_price'))
                <a href="{{ route('cars') }}">{{ __('All') }}</a>
            @endif
        </div>
    </div>
</form>

<style>
    .car-search-row {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
        gap: 0.75rem;
    }
    .car-search-field {
        flex: 1 1 140px;
        min-width: 140px;
    }
    .car-search-field label {
        display: block;
        margin-bottom: 0.35rem;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        color: #6b7280;
    }
    .car-search-field input,
    .car-search-field select {
        display: block;
        width: 100%;
        height: 40px;
        margin: 0;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        background: #fff;
        padding: 0 0.75rem;
        font-size: 0.875rem;
        color: #111827;
        box-shadow: none;
        outline: none;
        -webkit-appearance: none;
        appearance: none;
    }
    .car-search-field input:focus,
    .car-search-field select:focus {
        border-color: #D53338;
        box-shadow: 0 0 0 2px rgba(255, 155, 0, 0.15);
    }
    .car-search-actions {
        display: flex;
        flex: 0 0 auto;
        gap: 0.5rem;
        align-items: center;
    }
    .car-search-actions button,
    .car-search-actions a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 40px;
        min-width: 96px;
        padding: 0 1rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }
    .car-search-actions button {
        border: 0;
        background: #D53338;
        color: #fff;
        cursor: pointer;
    }
    .car-search-actions button:hover { background: #a82529; }
    .car-search-actions a {
        border: 1px solid #d1d5db;
        background: #fff;
        color: #374151;
    }
    .car-search-actions a:hover { background: #f9fafb; }

    /* Tom Select: one clean border only */
    .car-search-form .ts-wrapper,
    .car-search-form .ts-wrapper.single,
    .car-search-form .ts-wrapper.multi {
        width: 100% !important;
        border: 0 !important;
        box-shadow: none !important;
        background: transparent !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    .car-search-form .ts-wrapper .ts-control {
        min-height: 40px !important;
        height: 40px !important;
        padding: 0 0.75rem !important;
        border: 1px solid #d1d5db !important;
        border-radius: 0.5rem !important;
        box-shadow: none !important;
        background: #fff !important;
        display: flex !important;
        align-items: center !important;
        outline: none !important;
    }
    .car-search-form .ts-wrapper.focus .ts-control,
    .car-search-form .ts-wrapper.input-active .ts-control {
        border-color: #D53338 !important;
        box-shadow: 0 0 0 2px rgba(255, 155, 0, 0.15) !important;
    }
    .car-search-form .ts-wrapper .ts-control input {
        min-width: 0 !important;
        border: 0 !important;
        box-shadow: none !important;
        outline: none !important;
        background: transparent !important;
    }
    .car-search-form .ts-dropdown {
        margin-top: 4px !important;
        border: 1px solid #e5e7eb !important;
        border-radius: 0.5rem !important;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08) !important;
        z-index: 40 !important;
    }
    .car-search-form .ts-dropdown .active {
        background: #fdebec !important;
        color: #111827 !important;
    }
    @media (max-width: 640px) {
        .car-search-field { flex: 1 1 100%; min-width: 100%; }
        .car-search-actions { width: 100%; }
        .car-search-actions button,
        .car-search-actions a { flex: 1; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modelsByBrand = @json($modelsByBrand);
        const brandSelect = document.getElementById('search_brand_id');
        const modelSelect = document.getElementById('search_car_model_id');
        const selectedModelId = @json($selectedModelId ? (string) $selectedModelId : null);
        const selectModelLabel = @json(__('Model'));

        const brandTs = window.createSearchableSelect(brandSelect);
        const modelTs = window.createSearchableSelect(modelSelect);

        function fillModels(brandId, keepSelected) {
            const models = modelsByBrand[brandId] || [];
            modelTs.clear(true);
            modelTs.clearOptions();
            modelTs.addOption({ value: '', text: selectModelLabel });
            models.forEach(function (model) {
                modelTs.addOption({ value: String(model.id), text: model.name });
            });
            modelTs.refreshOptions(false);
            if (keepSelected && selectedModelId) {
                modelTs.setValue(String(selectedModelId), true);
            } else {
                modelTs.setValue('', true);
            }
        }

        brandTs.on('change', function (value) {
            fillModels(value, false);
        });

        if (brandSelect.value) {
            fillModels(brandSelect.value, true);
        }
    });
</script>
