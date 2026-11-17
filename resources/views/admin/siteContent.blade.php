@extends('layouts.myapp')
@section('content')
    @php
        $activeTab = old('active_tab', request('tab', array_key_first($groups)));
        if (! array_key_exists($activeTab, $groups)) {
            $activeTab = array_key_first($groups);
        }
    @endphp

    <div class="mx-auto max-w-screen-xl px-4 py-10">
        <div class="mb-6">
            <h1 class="font-car text-3xl font-bold text-gray-800">{{ __('Site content') }}</h1>
            <p class="mt-1 text-sm text-gray-500">{{ __('Edit homepage, contact and location texts in AZ / EN / RU.') }}</p>
        </div>

        <form method="POST" action="{{ route('siteContent.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="active_tab" id="active_tab" value="{{ $activeTab }}">

            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                <div class="flex flex-wrap gap-1 border-b border-gray-200 bg-gray-50 p-2" role="tablist">
                    @foreach ($groups as $groupKey => $groupLabel)
                        <button type="button"
                            class="site-tab rounded-lg px-3 py-2 text-sm font-semibold transition
                                {{ $groupKey === $activeTab ? 'bg-pr-400 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}"
                            data-tab="{{ $groupKey }}"
                            role="tab"
                            aria-selected="{{ $groupKey === $activeTab ? 'true' : 'false' }}">
                            {{ $groupLabel }}
                        </button>
                    @endforeach
                </div>

                @foreach ($groups as $groupKey => $groupLabel)
                    @php $rows = $settings->get($groupKey, collect()); @endphp
                    <div class="site-tab-panel space-y-6 p-5"
                        data-tab-panel="{{ $groupKey }}"
                        @if ($groupKey !== $activeTab) style="display:none" @endif>

                        @if ($rows->isEmpty())
                            <p class="text-sm text-gray-500">{{ __('No fields in this section.') }}</p>
                        @else
                            @foreach ($rows as $setting)
                                <div class="border-b border-gray-100 pb-5 last:border-0 last:pb-0">
                                    <label class="mb-2 block text-sm font-medium text-gray-800">{{ __($setting->label) }}</label>

                                    @if ($setting->type === 'image')
                                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                                            @if ($setting->value_en || $setting->value_az)
                                                <img src="{{ $setting->value_en ?: $setting->value_az }}" alt=""
                                                    class="h-20 w-32 rounded-lg border border-gray-200 object-cover">
                                            @endif
                                            <div class="flex-1 space-y-2">
                                                <input type="file" name="settings_files[{{ $setting->id }}]" accept="image/*"
                                                    class="block w-full text-sm text-gray-700">
                                                <input type="text" name="settings[{{ $setting->id }}][path]"
                                                    value="{{ $setting->value_en ?: $setting->value_az }}"
                                                    placeholder="{{ __('Or paste image path / URL') }}"
                                                    class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm">
                                            </div>
                                        </div>
                                    @elseif (in_array($setting->type, ['url', 'number'], true))
                                        <input type="text" name="settings[{{ $setting->id }}][value]"
                                            value="{{ $setting->value_en ?: $setting->value_az }}"
                                            class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm">
                                        @if ($setting->type === 'url')
                                            <p class="mt-1 text-xs text-gray-500">{{ __('Same URL used for all languages.') }}</p>
                                        @endif
                                    @else
                                        <div class="mb-2 flex gap-2" data-lang-tabs>
                                            <button type="button" data-lang="az" class="lang-tab rounded-md bg-pr-400 px-3 py-1 text-xs font-semibold text-white">AZ</button>
                                            <button type="button" data-lang="en" class="lang-tab rounded-md bg-gray-200 px-3 py-1 text-xs font-semibold text-gray-700">EN</button>
                                            <button type="button" data-lang="ru" class="lang-tab rounded-md bg-gray-200 px-3 py-1 text-xs font-semibold text-gray-700">RU</button>
                                        </div>
                                        @foreach (['az', 'en', 'ru'] as $lang)
                                            <div class="lang-panel" data-lang-panel="{{ $lang }}" @if ($lang !== 'az') style="display:none" @endif>
                                                @if ($setting->type === 'textarea')
                                                    <textarea name="settings[{{ $setting->id }}][value_{{ $lang }}]" rows="3"
                                                        class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm">{{ $setting->{'value_'.$lang} }}</textarea>
                                                @else
                                                    <input type="text" name="settings[{{ $setting->id }}][value_{{ $lang }}]"
                                                        value="{{ $setting->{'value_'.$lang} }}"
                                                        class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm">
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endforeach

                <div class="flex justify-end border-t border-gray-100 bg-gray-50 px-5 py-4">
                    <button type="submit"
                        class="rounded-lg bg-pr-400 px-6 py-2.5 text-sm font-semibold text-white hover:bg-pr-600">
                        {{ __('Save changes') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        (function () {
            const activeInput = document.getElementById('active_tab');
            const tabs = document.querySelectorAll('.site-tab');
            const panels = document.querySelectorAll('.site-tab-panel');

            function activateTab(key) {
                tabs.forEach(function (btn) {
                    const on = btn.getAttribute('data-tab') === key;
                    btn.classList.toggle('bg-pr-400', on);
                    btn.classList.toggle('text-white', on);
                    btn.classList.toggle('bg-white', !on);
                    btn.classList.toggle('text-gray-700', !on);
                    btn.setAttribute('aria-selected', on ? 'true' : 'false');
                });
                panels.forEach(function (panel) {
                    panel.style.display = panel.getAttribute('data-tab-panel') === key ? '' : 'none';
                });
                if (activeInput) activeInput.value = key;
                const url = new URL(window.location.href);
                url.searchParams.set('tab', key);
                window.history.replaceState({}, '', url);
            }

            tabs.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    activateTab(btn.getAttribute('data-tab'));
                });
            });

            document.querySelectorAll('[data-lang-tabs]').forEach(function (langTabs) {
                const wrap = langTabs.parentElement;
                langTabs.querySelectorAll('.lang-tab').forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        const lang = btn.getAttribute('data-lang');
                        langTabs.querySelectorAll('.lang-tab').forEach(function (b) {
                            b.classList.remove('bg-pr-400', 'text-white');
                            b.classList.add('bg-gray-200', 'text-gray-700');
                        });
                        btn.classList.add('bg-pr-400', 'text-white');
                        btn.classList.remove('bg-gray-200', 'text-gray-700');
                        wrap.querySelectorAll('[data-lang-panel]').forEach(function (panel) {
                            panel.style.display = panel.getAttribute('data-lang-panel') === lang ? '' : 'none';
                        });
                    });
                });
            });
        })();
    </script>
@endsection
