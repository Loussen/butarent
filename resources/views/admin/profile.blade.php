@extends('layouts.myapp')
@section('content')
    <div class="mx-auto max-w-screen-md px-4 py-10">
        <div class="mb-6">
            <h1 class="font-car text-3xl font-bold text-gray-800">{{ __('Admin profile') }}</h1>
            <p class="mt-1 text-sm text-gray-500">{{ __('Update your name, email and password.') }}</p>
        </div>

        <form method="POST" action="{{ route('admin.profile.update') }}" class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="name" class="mb-2 block text-sm font-medium text-gray-900">{{ __('Name') }}</label>
                <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}"
                    class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm" required>
                @error('name')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-5">
                <label for="email" class="mb-2 block text-sm font-medium text-gray-900">{{ __('Email') }}</label>
                <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}"
                    class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm" required>
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <hr class="my-6 border-gray-200">

            <div class="mb-5">
                <label for="current_password" class="mb-2 block text-sm font-medium text-gray-900">{{ __('Current password') }}</label>
                <input type="password" id="current_password" name="current_password"
                    class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm" required autocomplete="current-password">
                <p class="mt-1 text-xs text-gray-500">{{ __('Required to save any profile changes.') }}</p>
                @error('current_password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="mb-2 block text-sm font-medium text-gray-900">{{ __('New password') }}</label>
                <input type="password" id="password" name="password"
                    class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm" autocomplete="new-password">
                <p class="mt-1 text-xs text-gray-500">{{ __('Leave blank to keep the current password.') }}</p>
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-900">{{ __('Confirm Password') }}</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm" autocomplete="new-password">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="rounded-lg bg-pr-400 px-6 py-2.5 text-sm font-semibold text-white hover:bg-pr-600">
                    {{ __('Save changes') }}
                </button>
            </div>
        </form>
    </div>
@endsection
