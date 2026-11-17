@extends('layouts.myapp')
@section('content')
    <div class="mx-auto max-w-screen-xl px-4 py-10">
        <div class="mb-8">
            <h1 class="font-car text-3xl font-bold text-gray-800">{{ __('Pages') }}</h1>
            <p class="mt-1 text-sm text-gray-500">{{ __('Edit Privacy Policy, Terms and other content pages.') }}</p>
        </div>

        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="border-b bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                    <tr>
                        <th class="px-4 py-3">{{ __('Slug') }}</th>
                        <th class="px-4 py-3">{{ __('Title') }}</th>
                        <th class="px-4 py-3 text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($pages as $page)
                        <tr>
                            <td class="px-4 py-3 font-mono text-gray-600">{{ $page->slug }}</td>
                            <td class="px-4 py-3 text-gray-900">{{ $page->title() }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('pages.edit', $page) }}"
                                    class="inline-flex rounded-md bg-blue-500 px-3 py-2 text-white hover:bg-blue-700">
                                    {{ __('Edit') }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-10 text-center text-gray-500">{{ __('No pages found.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
