<?php

return [
    'site_name' => env('SEO_SITE_NAME', 'ButaRent'),
    'default_title' => env('SEO_DEFAULT_TITLE', 'ButaRent | Rent a Car Azerbaijan — Cheap Car Rental'),
    'default_description' => env(
        'SEO_DEFAULT_DESCRIPTION',
        'Rent a car in Azerbaijan with ButaRent. Affordable car rental, SUV, economy and luxury cars. Fast online booking, daily prices, airport pickup.'
    ),
    'default_keywords' => env(
        'SEO_DEFAULT_KEYWORDS',
        'rent a car, car rental, rent car Azerbaijan, cheap car rental, hire a car, SUV rental, airport car rental, ButaRent, avtomobil icarəsi, maşın kirayəsi, аренда авто'
    ),
    'og_image' => env('SEO_OG_IMAGE', '/images/home car.png'),
    'twitter_handle' => env('SEO_TWITTER', '@butarent'),
    'locale_map' => [
        'az' => 'az_AZ',
        'en' => 'en_US',
        'ru' => 'ru_RU',
    ],
];
