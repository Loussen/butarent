<div class="inline-flex items-center rounded-lg border border-gray-200 bg-white p-0.5 text-xs font-semibold shadow-sm" role="group" aria-label="{{ __('Language') }}">
    @foreach (['az' => 'AZ', 'en' => 'EN', 'ru' => 'RU'] as $code => $label)
        <a href="{{ route('locale.switch', $code) }}"
            class="px-2.5 py-1.5 rounded-md transition {{ app()->getLocale() === $code ? 'bg-pr-400 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100' }}">{{ $label }}</a>
    @endforeach
</div>
