@extends('layouts.myapp')
@section('content')
    <div class="my-20 flex flex-col justify-center items-center mx-auto max-w-screen-xl ">
        <form class="w-full" action="{{ route('insurances.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="md:w-2/3 w-5/6 md:px-24 px-4 pb-8 mx-auto mt-2 space-y-12 bg-white border-2 border-gray-600 rounded-md">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="mt-2 text-center font-bold text-lg leading-7 text-gray-900">{{ __('Link an insurance to a car') }}</h2>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="col-span-full">
                            <label for="car" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Car') }}</label>
                            <select name="car" id="car" required
                                data-placeholder="{{ __('Select a car') }}"
                                class="js-searchable block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                <option value="">{{ __('Select a car') }}</option>
                                @forelse ($cars as $car)
                                    <option value="{{ $car->id }}">
                                        {{ $car->brand . ' ' . $car->model . ' ' . $car->engine }}
                                    </option>
                                @empty
                                    <option disabled>{{ __('All registered cars are already insured.') }}</option>
                                @endforelse
                            </select>
                            @error('car')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="sm:col-span-2 sm:col-start-1">
                            <label for="company" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Company') }}</label>
                            <div class="mt-2">
                                <input type="text" name="company" id="company"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                            </div>
                            @error('company')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="type" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Type') }}</label>
                            <div class="mt-2">
                                <select name="type" id="type"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                    <option value="Comprehensive insurance" selected>{{ __('Comprehensive insurance') }}</option>
                                    <option value="Liability coverage">{{ __('Liability coverage') }}</option>
                                    <option value="Collision insurance">{{ __('Collision insurance') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="price" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Price') }}</label>
                            <div class="mt-2">
                                <input type="text" name="price" id="price"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                            </div>
                            @error('price')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="start_date" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Started at') }}</label>
                            <div class="mt-2">
                                <input type="date" name="start_date" id="start_date"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                            </div>
                            @error('start_date')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="end_date" class="block text-sm font-medium leading-6 text-gray-900">{{ __('End at') }}</label>
                            <div class="mt-2">
                                <input type="date" name="end_date" id="end_date"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                            </div>
                            @error('end_date')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-x-6 mb-6">
                    <a href="{{ route('insurances.index') }}"
                        class="text-sm font-semibold leading-6 text-center text-gray-900 border-2 border-pr-200 p-1 w-20 rounded-md hover:bg-white bg-sec-300">{{ __('Cancel') }}</a>
                    <button type="submit"
                        class="w-1/3 rounded-md bg-pr-400 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-pr-600">{{ __('Save') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
