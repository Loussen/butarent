@extends('layouts.myapp')
@section('content')
    <div class="grid place-items-center">
        <div class="my-12 mx-4 border bg-sec-100 p-5 md:w-1/2">
            <h1 class="mb-6 text-center font-car text-2xl font-bold text-gray-800">{{ __('Add New Admin') }}</h1>
            <form method="POST" action="{{ route('addNewAdmin') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label for="name" class="mb-2 block text-sm font-medium text-gray-900">{{ __('Name') }}</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="block w-full rounded-lg border border-gray-300 bg-pr-100 p-2.5 text-sm text-gray-900 focus:border-pr-500 focus:ring-pr-500">
                    @error('name')
                        <span class="text-red-500"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="mb-2 block text-sm font-medium text-gray-900">{{ __('Email Address') }}</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="block w-full rounded-lg border border-gray-300 bg-pr-100 p-2.5 text-sm text-gray-900 focus:border-pr-500 focus:ring-pr-500">
                    @error('email')
                        <span class="text-red-500"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-2 text-sm font-medium text-gray-900">{{ __('Choose avatar') }}</div>
                <div class="flex flex-col items-center justify-evenly px-6 py-4 text-center md:flex-row">
                    <div class="grid grid-cols-3">
                        @for ($i = 1; $i <= 6; $i++)
                            <div class="m-3">
                                <input type="radio" name="avatar_option" value="/images/avatars/avatar_{{ $i }}.jpg"
                                    id="avatar_{{ $i }}" class="hidden">
                                <label for="avatar_{{ $i }}">
                                    <img loading="lazy" class="avatar w-12" src="/images/avatars/avatar_{{ $i }}.jpg" alt="avatar {{ $i }}">
                                </label>
                            </div>
                        @endfor
                    </div>

                    <div class="mb-2 md:w-1/3">
                        <p>{{ __('OR') }}</p>
                    </div>

                    <div>
                        <input
                            class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none"
                            id="file_input" type="file" name="avatar_choose">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="password" class="mb-2 block text-sm font-medium text-gray-900">{{ __('Password') }}</label>
                    <input type="password" id="password" name="password"
                        class="block w-full rounded-lg border border-gray-300 bg-pr-100 p-2.5 text-sm text-gray-900 focus:border-pr-500 focus:ring-pr-500">
                    @error('password')
                        <span class="text-red-500"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password-confirm" class="mb-2 block text-sm font-medium text-gray-900">{{ __('Confirm Password') }}</label>
                    <input type="password" id="password-confirm" name="password_confirmation"
                        class="block w-full rounded-lg border border-gray-300 bg-pr-100 p-2.5 text-sm text-gray-900 focus:border-pr-500 focus:ring-pr-500">
                </div>

                <button type="submit"
                    class="w-full rounded-lg bg-pr-400 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-pr-600 focus:outline-none focus:ring-4 focus:ring-pr-300 sm:w-auto">
                    {{ __('Add New Admin') }}
                </button>
            </form>
        </div>
    </div>
    <script>
        var radios = document.querySelectorAll('input[type="radio"]');
        var images = document.querySelectorAll('.avatar');

        radios.forEach(function(radio, index) {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    images.forEach(function(image, imageIndex) {
                        if (imageIndex === index) {
                            image.classList.add('border', 'border-red-600', 'rounded-full', 'p-1');
                        } else {
                            image.classList.remove('border', 'border-red-600', 'rounded-full', 'p-1');
                        }
                    });
                }
            });
        });
    </script>
@endsection
