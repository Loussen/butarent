@php
    $showCurrent = !empty($showCurrent);
    $inputId = $inputId ?? 'car-photos-upload';
@endphp

@if ($showCurrent)
    <div class="col-span-full">
        <label class="mb-2 block text-sm font-medium text-gray-900">{{ __('Current photos') }}</label>
        @php
            $galleryImages = !empty($car) ? $car->images : collect();
            $galleryPaths = $galleryImages->pluck('path')->filter()->all();
            $coverOnly = !empty($car) && filled($car->image) && ! in_array($car->image, $galleryPaths, true);
            $hasAnyPhoto = $coverOnly || $galleryImages->isNotEmpty();
        @endphp
        <div class="car-photos-grid">
            @if ($coverOnly)
                <div class="car-photo-item">
                    <img src="{{ $car->image }}" alt="">
                    <span class="car-photo-badge">{{ __('Cover') }}</span>
                    <button type="button" class="car-photo-remove" data-remove-cover="1">{{ __('Delete') }}</button>
                    <input type="checkbox" name="remove_cover" value="1" class="car-photo-check" hidden>
                </div>
            @endif

            @foreach ($galleryImages as $image)
                <div class="car-photo-item">
                    <img src="{{ $image->path }}" alt="">
                    @if (!empty($car->image) && $car->image === $image->path)
                        <span class="car-photo-badge">{{ __('Cover') }}</span>
                    @endif
                    <button type="button" class="car-photo-remove" data-remove-id="{{ $image->id }}">{{ __('Delete') }}</button>
                    <input type="checkbox" name="remove_images[]" value="{{ $image->id }}" class="car-photo-check" hidden>
                </div>
            @endforeach
        </div>
        @unless ($hasAnyPhoto)
            <p class="mt-2 text-sm text-gray-500">{{ __('No photos yet.') }}</p>
        @endunless
    </div>
@endif

<div class="col-span-full">
    <label class="mb-2 block text-sm font-medium text-gray-900">{{ $showCurrent ? __('Add photos') : __('Photos') }}</label>
    <label class="car-upload-box">
        <svg class="mx-auto h-10 w-10 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
        </svg>
        <div class="mt-3 flex items-center justify-center gap-1 text-sm text-gray-600">
            <span class="font-semibold text-pr-500">{{ __('Upload files') }}</span>
            <span>{{ __('or drag and drop') }}</span>
        </div>
        <p class="mt-1 text-xs text-gray-500">{{ __('PNG, JPG, GIF up to 10MB') }}</p>
        <input id="{{ $inputId }}" name="images[]" type="file" class="sr-only" multiple accept="image/*" data-car-photos-input>
    </label>

    <div class="car-photos-preview mt-3" data-car-photos-preview></div>
    <p class="mt-2 hidden text-sm text-gray-600" data-car-photos-count></p>

    @error('images')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    @error('images.*')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
</div>

<style>
    .car-photos-grid,
    .car-photos-preview {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0.75rem;
    }
    @media (min-width: 640px) {
        .car-photos-grid,
        .car-photos-preview { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    }
    @media (min-width: 768px) {
        .car-photos-grid,
        .car-photos-preview { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    }
    .car-photo-item,
    .car-photos-preview-item {
        position: relative;
        width: 100%;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        background: #f9fafb;
    }
    .car-photo-item img,
    .car-photos-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .car-photo-item.is-marked {
        outline: 2px solid #dc2626;
        outline-offset: 1px;
        opacity: 0.55;
    }
    .car-photo-badge {
        position: absolute;
        left: 0.4rem;
        top: 0.4rem;
        border-radius: 0.35rem;
        background: rgba(17, 24, 39, 0.85);
        color: #fff;
        font-size: 0.65rem;
        font-weight: 700;
        padding: 0.2rem 0.4rem;
        line-height: 1;
    }
    .car-photo-remove,
    .car-photos-preview-remove {
        position: absolute;
        right: 0.4rem;
        top: 0.4rem;
        border: 0;
        border-radius: 0.4rem;
        background: rgba(220, 38, 38, 0.95);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.3rem 0.5rem;
        cursor: pointer;
        line-height: 1;
    }
    .car-photo-remove:hover,
    .car-photos-preview-remove:hover { background: #b91c1c; }
    .car-upload-box {
        display: block;
        margin-top: 0.5rem;
        border: 1px dashed #c4c4c4;
        border-radius: 0.75rem;
        padding: 1.5rem 1rem;
        text-align: center;
        background: #fafafa;
        cursor: pointer;
    }
    .car-upload-box:hover {
        border-color: #D53338;
        background: #fef5f5;
    }
</style>

<script>
    (function () {
        if (window.__carPhotosFieldBound) return;
        window.__carPhotosFieldBound = true;

        document.addEventListener('click', function (e) {
            const btn = e.target.closest('.car-photo-remove');
            if (!btn) return;
            e.preventDefault();
            const item = btn.closest('.car-photo-item');
            const check = item.querySelector('.car-photo-check');
            if (!check) return;
            check.checked = !check.checked;
            item.classList.toggle('is-marked', check.checked);
            btn.textContent = check.checked ? @json(__('Undo')) : @json(__('Delete'));
        });

        document.addEventListener('change', function (e) {
            const input = e.target.closest('[data-car-photos-input]');
            if (!input) return;

            const wrap = input.closest('.col-span-full') || input.parentElement.parentElement.parentElement;
            const preview = wrap.querySelector('[data-car-photos-preview]');
            const countEl = wrap.querySelector('[data-car-photos-count]');
            if (!preview) return;

            preview.innerHTML = '';
            const files = Array.from(input.files || []);

            if (countEl) {
                if (files.length) {
                    countEl.classList.remove('hidden');
                    countEl.textContent = files.length + ' ' + @json(__('file(s) selected'));
                } else {
                    countEl.classList.add('hidden');
                    countEl.textContent = '';
                }
            }

            files.forEach(function (file, index) {
                if (!file.type.startsWith('image/')) return;
                const reader = new FileReader();
                reader.onload = function (ev) {
                    const item = document.createElement('div');
                    item.className = 'car-photos-preview-item';
                    item.innerHTML = '<img alt=""><button type="button" class="car-photos-preview-remove" data-index="' + index + '">' + @json(__('Remove')) + '</button>';
                    item.querySelector('img').src = ev.target.result;
                    preview.appendChild(item);
                };
                reader.readAsDataURL(file);
            });
        });

        document.addEventListener('click', function (e) {
            const btn = e.target.closest('.car-photos-preview-remove');
            if (!btn) return;
            e.preventDefault();

            const preview = btn.closest('[data-car-photos-preview]');
            const wrap = preview.closest('.col-span-full') || preview.parentElement;
            const input = wrap.querySelector('[data-car-photos-input]');
            const countEl = wrap.querySelector('[data-car-photos-count]');
            if (!input) return;

            const removeIndex = Number(btn.getAttribute('data-index'));
            const dt = new DataTransfer();
            Array.from(input.files).forEach(function (file, i) {
                if (i !== removeIndex) dt.items.add(file);
            });
            input.files = dt.files;
            input.dispatchEvent(new Event('change', { bubbles: true }));

            if (countEl && input.files.length === 0) {
                countEl.classList.add('hidden');
            }
        });
    })();
</script>
