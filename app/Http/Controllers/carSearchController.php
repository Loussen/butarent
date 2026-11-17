<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Http\Request;

class carSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = Car::with(['images', 'brandRelation', 'carModel']);

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->filled('car_model_id')) {
            $query->where('car_model_id', $request->car_model_id);
        }

        if ($request->filled('min_price')) {
            $minPrice = is_numeric($request->min_price) ? $request->min_price : 0;
            $query->where('price_per_day', '>=', $minPrice);
        }

        if ($request->filled('max_price')) {
            $maxPrice = is_numeric($request->max_price) ? $request->max_price : PHP_INT_MAX;
            $query->where('price_per_day', '<=', $maxPrice);
        }

        $query->where('status', '=', 'available');

        $cars = $query->paginate(9);
        $cars->appends($request->except('page'));

        $brands = Brand::with('carModels')->orderBy('name')->get();

        return view('cars.searchedCars', compact('cars', 'brands'));
    }
}
