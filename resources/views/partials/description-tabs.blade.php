@php
    $descriptionAz = old('description_az', $car->description_az ?? '');
    $descriptionEn = old('description_en', $car->description_en ?? '');
    $descriptionRu = old('description_ru', $car->description_ru ?? '');
@endphp

<div class="col-span-full">
    <label class="block text-sm font-medium leading-6 text-gray-900">{{ __('General information') }}</label>

    <div class="mt-2 overflow-hidden rounded-lg border border-gray-200 bg-white">
        <div class="flex border-b border-gray-200 bg-gray-50" role="tablist">
            <button type="button" data-desc-tab="az"
                class="desc-tab flex-1 px-3 py-2.5 text-sm font-semibold text-pr-600 border-b-2 border-pr-400 bg-white">
                AZ
            </button>
            <button type="button" data-desc-tab="en"
                class="desc-tab flex-1 px-3 py-2.5 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-800">
                EN
            </button>
            <button type="button" data-desc-tab="ru"
                class="desc-tab flex-1 px-3 py-2.5 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-800">
                RU
            </button>
        </div>

        <div class="p-3">
            <div data-desc-panel="az" class="desc-panel">
                <textarea name="description_az" id="description_az" rows="5"
                    placeholder="{{ __('General information') }} (AZ)"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm">{{ $descriptionAz }}</textarea>
            </div>
            <div data-desc-panel="en" class="desc-panel hidden">
                <textarea name="description_en" id="description_en" rows="5"
                    placeholder="{{ __('General information') }} (EN)"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm">{{ $descriptionEn }}</textarea>
            </div>
            <div data-desc-panel="ru" class="desc-panel hidden">
                <textarea name="description_ru" id="description_ru" rows="5"
                    placeholder="{{ __('General information') }} (RU)"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm">{{ $descriptionRu }}</textarea>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        const tabs = document.querySelectorAll('.desc-tab');
        const panels = document.querySelectorAll('.desc-panel');

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                const lang = tab.getAttribute('data-desc-tab');

                tabs.forEach(function (el) {
                    el.classList.remove('text-pr-600', 'border-pr-400', 'bg-white', 'font-semibold');
                    el.classList.add('text-gray-500', 'border-transparent', 'font-medium');
                });
                tab.classList.add('text-pr-600', 'border-pr-400', 'bg-white', 'font-semibold');
                tab.classList.remove('text-gray-500', 'border-transparent', 'font-medium');

                panels.forEach(function (panel) {
                    panel.classList.toggle('hidden', panel.getAttribute('data-desc-panel') !== lang);
                });
            });
        });
    })();
</script>
