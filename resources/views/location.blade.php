@extends('layouts.myapp')

@section('title', __('Car rental location') . ' | ButaRent — ' . __('Rent a Car'))
@section('meta_description', __('Find our car rental office location. Easy pickup and drop-off for your rent a car booking.'))
@section('meta_keywords', 'car rental location, rent a car office, car pickup, ButaRent location')
@section('canonical', route('location'))

@section('content')
    <div class="mx-auto max-w-screen-xl ">
        <div class="flex md:flex-row flex-col justify-around  items-center px-6 pt-6">
            <div class="md:m-12 p-6 md:w-1/2">
                <img loading="lazy" src="{{ setting('location.image_1', '/images/shop1.png') }}" alt="{{ __('Car rental location') }}">
            </div>
            <div class=" relative md:m-12 m-6 md:w-1/2 md:p-6">
                <p>{{ setting('location.text_1', __('Welcome to our car rental shop in the heart of the city. The location is easy to reach for both residents and travelers.')) }}</p>
                <br>
                <p>{{ setting('location.text_2', __('The shop is close to major transport hubs, so pickup and drop-off stay simple. Our staff will greet you and keep the rental process smooth.')) }}</p>
            </div>
        </div>
        <div class="flex md:flex-row flex-col justify-around  items-center px-6 pt-6">
            <div class="md:m-12 p-6 md:w-1/2 md:order-last ">
                <img loading="lazy" src="{{ setting('location.image_2', '/images/shop_2.jpg') }}" alt="{{ __('Car rental location') }}">
            </div>
            <div class=" relative md:m-12 m-6 md:w-1/2 md:p-6">
                <p>{{ setting('location.text_3', __('The neighborhood has restaurants, cafes, and shops a short distance away, useful before or after your rental.')) }}</p>
                <br>
                <p>{{ setting('location.text_4', __('Parking is available on site, so you can leave your own car and drive away in the rental.')) }}</p>
            </div>
        </div>
        <div class=" p-3 mb-8">
            <iframe
                src="{{ setting('location.map_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3464.9188930414984!2d-8.984100424763344!3d29.722108575087578!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb6b1b1966dcdef%3A0x2bf9c55ec4ef96f9!2sIsta%20Tafraout!5e0!3m2!1sen!2sma!4v1686498234799!5m2!1sen!2sma') }}"
                class="w-full h-96" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
@endsection
