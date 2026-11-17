@php
    $selectedBrandId = old('brand_id', $car->brand_id ?? null);
    $selectedModelId = old('car_model_id', $car->car_model_id ?? null);
    $modelsByBrand = $brands->mapWithKeys(function ($brand) {
        return [
            $brand->id => $brand->carModels->map(fn ($model) => [
                'id' => $model->id,
                'name' => $model->name,
            ])->values(),
        ];
    });
@endphp

<div class="sm:col-span-3">
    <label for="brand_id" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Brand') }}</label>
    <div class="mt-2">
        <select name="brand_id" id="brand_id" required data-placeholder="{{ __('Select brand') }}"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
            <option value="">{{ __('Select brand') }}</option>
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}" @selected((string) $selectedBrandId === (string) $brand->id)>{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>
    @error('brand_id')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
</div>

<div class="sm:col-span-3">
    <label for="car_model_id" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Model') }}</label>
    <div class="mt-2">
        <select name="car_model_id" id="car_model_id" required data-placeholder="{{ __('Select model') }}"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
            <option value="">{{ __('Select model') }}</option>
        </select>
    </div>
    @error('car_model_id')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modelsByBrand = @json($modelsByBrand);
        const brandSelect = document.getElementById('brand_id');
        const modelSelect = document.getElementById('car_model_id');
        const selectedModelId = @json($selectedModelId ? (string) $selectedModelId : null);
        const selectModelLabel = @json(__('Select model'));

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
