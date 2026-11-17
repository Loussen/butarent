@extends('layouts.myapp')
@section('content')
    <div class="mx-auto max-w-screen-xl px-4 py-10">
        <div class="mb-8 flex items-center justify-between gap-4">
            <div>
                <h1 class="font-car text-3xl font-bold text-gray-800">{{ __('Edit page') }}</h1>
                <p class="mt-1 font-mono text-sm text-gray-500">{{ $page->slug }}</p>
            </div>
            <a href="{{ route('pages.index') }}" class="text-sm text-pr-500 hover:underline">{{ __('Back') }}</a>
        </div>

        <form method="POST" action="{{ route('pages.update', $page) }}" id="page-edit-form" class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            @csrf
            @method('PUT')

            <div class="mb-4 flex gap-2" id="page-lang-tabs">
                <button type="button" data-lang="az" class="page-lang-tab rounded-md bg-pr-400 px-3 py-1 text-xs font-semibold text-white">AZ</button>
                <button type="button" data-lang="en" class="page-lang-tab rounded-md bg-gray-200 px-3 py-1 text-xs font-semibold text-gray-700">EN</button>
                <button type="button" data-lang="ru" class="page-lang-tab rounded-md bg-gray-200 px-3 py-1 text-xs font-semibold text-gray-700">RU</button>
            </div>

            @foreach (['az', 'en', 'ru'] as $lang)
                <div class="page-lang-panel space-y-4" data-lang="{{ $lang }}" @if ($lang !== 'az') style="display:none" @endif>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-900">{{ __('Title') }} ({{ strtoupper($lang) }})</label>
                        <input type="text" name="title_{{ $lang }}" value="{{ old('title_'.$lang, $page->{'title_'.$lang}) }}"
                            class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm" required>
                        @error('title_'.$lang)
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-900">{{ __('Content') }} ({{ strtoupper($lang) }})</label>
                        <textarea id="body_{{ $lang }}" name="body_{{ $lang }}" class="page-editor" rows="16">{{ old('body_'.$lang, $page->{'body_'.$lang}) }}</textarea>
                    </div>
                </div>
            @endforeach

            <div class="mt-6 flex justify-end">
                <button type="submit" class="rounded-lg bg-pr-400 px-6 py-2.5 text-sm font-semibold text-white hover:bg-pr-600">
                    {{ __('Save changes') }}
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.0/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                selector: 'textarea.page-editor',
                license_key: 'gpl',
                height: 420,
                menubar: false,
                branding: false,
                promotion: false,
                plugins: 'lists link image table code autoresize',
                toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table | removeformat | code',
                content_style: 'body { font-family: Rubik, Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6; } h3 { font-size: 1.25rem; margin: 1rem 0 0.5rem; } p { margin: 0 0 0.75rem; }',
                convert_urls: false,
                relative_urls: false,
                setup: function (editor) {
                    editor.on('change input undo redo', function () {
                        editor.save();
                    });
                }
            });

            function showLang(lang) {
                document.querySelectorAll('#page-lang-tabs .page-lang-tab').forEach(function (b) {
                    const on = b.getAttribute('data-lang') === lang;
                    b.classList.toggle('bg-pr-400', on);
                    b.classList.toggle('text-white', on);
                    b.classList.toggle('bg-gray-200', !on);
                    b.classList.toggle('text-gray-700', !on);
                });

                document.querySelectorAll('.page-lang-panel').forEach(function (panel) {
                    const on = panel.getAttribute('data-lang') === lang;
                    panel.style.display = on ? '' : 'none';
                });

                // Fix editor width after becoming visible
                setTimeout(function () {
                    const ed = tinymce.get('body_' + lang);
                    if (ed) {
                        ed.fire('ResizeEditor');
                        ed.focus(false);
                    }
                }, 50);
            }

            document.querySelectorAll('#page-lang-tabs .page-lang-tab').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    showLang(btn.getAttribute('data-lang'));
                });
            });

            document.getElementById('page-edit-form').addEventListener('submit', function () {
                if (window.tinymce) {
                    tinymce.triggerSave();
                }
            });
        });
    </script>
@endsection
