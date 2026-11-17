<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $cars = Car::query()
            ->where('status', 'available')
            ->orderByDesc('updated_at')
            ->get(['id', 'slug', 'updated_at']);

        $urls = [
            ['loc' => route('home'), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => route('cars'), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => route('location'), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('contact_us'), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('privacy_policy'), 'changefreq' => 'yearly', 'priority' => '0.3'],
            ['loc' => route('terms_conditions'), 'changefreq' => 'yearly', 'priority' => '0.3'],
        ];

        foreach ($cars as $car) {
            $urls[] = [
                'loc' => route('car.details', $car),
                'lastmod' => optional($car->updated_at)->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
