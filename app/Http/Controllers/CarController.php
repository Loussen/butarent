<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with(['brandRelation', 'carModel'])->orderByDesc('id')->paginate(8);

        return view('admin.cars', compact('cars'));
    }

    public function create()
    {
        $brands = Brand::with('carModels')->orderBy('name')->get();

        return view('admin.createCar', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'car_model_id' => [
                'required',
                Rule::exists('car_models', 'id')->where(fn ($q) => $q->where('brand_id', $request->brand_id)),
            ],
            'engine' => 'required',
            'quantity' => 'required',
            'price_per_day' => 'required',
            'status' => 'required',
            'reduce' => 'required',
            'stars' => 'required',
            'description_az' => 'nullable|string|max:5000',
            'description_en' => 'nullable|string|max:5000',
            'description_ru' => 'nullable|string|max:5000',
            'images' => 'required|array|min:1|max:12',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $brand = Brand::findOrFail($request->brand_id);
        $carModel = CarModel::findOrFail($request->car_model_id);

        $car = new Car;
        $car->assignBrandAndModel($brand, $carModel);
        $car->engine = $request->engine;
        $car->quantity = $request->quantity;
        $car->price_per_day = $request->price_per_day;
        $car->status = $request->status;
        $car->reduce = $request->reduce;
        $car->stars = $request->stars;
        $car->description_az = $request->description_az;
        $car->description_en = $request->description_en;
        $car->description_ru = $request->description_ru;
        $car->save();

        $paths = $this->storeUploadedImages($request, $car);
        $car->image = $paths[0] ?? null;
        $car->save();

        return redirect()->route('cars.index')->with('success', __('Car created successfully.'));
    }

    public function show(Car $car)
    {
        //
    }

    public function edit(Car $car)
    {
        $car = Car::with('images')->findOrFail($car->id);
        $brands = Brand::with('carModels')->orderBy('name')->get();

        return view('admin.updateCar', compact('car', 'brands'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'car_model_id' => [
                'required',
                Rule::exists('car_models', 'id')->where(fn ($q) => $q->where('brand_id', $request->brand_id)),
            ],
            'engine' => 'required',
            'quantity' => 'required',
            'price_per_day' => 'required',
            'insurance_status' => 'required',
            'status' => 'required',
            'reduce' => 'required',
            'stars' => 'required',
            'description_az' => 'nullable|string|max:5000',
            'description_en' => 'nullable|string|max:5000',
            'description_ru' => 'nullable|string|max:5000',
            'images' => 'nullable|array|max:12',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'integer',
        ]);

        $car = Car::findOrFail($car->id);
        $brand = Brand::findOrFail($request->brand_id);
        $carModel = CarModel::findOrFail($request->car_model_id);

        $car->assignBrandAndModel($brand, $carModel);
        $car->engine = $request->engine;
        $car->quantity = $request->quantity;
        $car->price_per_day = $request->price_per_day;
        $car->status = $request->status;
        $car->reduce = $request->reduce;
        $car->stars = $request->stars;
        $car->description_az = $request->description_az;
        $car->description_en = $request->description_en;
        $car->description_ru = $request->description_ru;

        if ($request->boolean('remove_cover')) {
            $this->deleteStoredImage($car->image);
            $car->image = null;
        }

        if ($request->filled('remove_images')) {
            $images = CarImage::where('car_id', $car->id)
                ->whereIn('id', $request->remove_images)
                ->get();

            foreach ($images as $image) {
                $this->deleteStoredImage($image->path);
                if ($car->image === $image->path) {
                    $car->image = null;
                }
                $image->delete();
            }
        }

        $paths = $this->storeUploadedImages($request, $car);
        if (! $car->image && isset($paths[0])) {
            $car->image = $paths[0];
        }

        if (! $car->image) {
            $car->image = $car->images()->value('path');
        }

        $car->save();

        return redirect()->route('cars.index')->with('success', __('Car updated successfully.'));
    }

    public function destroy(Car $car)
    {
        $car = Car::with('images')->findOrFail($car->id);
        $this->deleteStoredImage($car->image);
        foreach ($car->images as $image) {
            $this->deleteStoredImage($image->path);
        }
        $car->delete();

        return redirect()->route('cars.index')->with('success', __('Car deleted successfully.'));
    }

    private function storeUploadedImages(Request $request, Car $car): array
    {
        $paths = [];
        $files = $request->file('images', []);
        if (! is_array($files)) {
            return $paths;
        }

        $order = (int) $car->images()->max('sort_order');

        foreach ($files as $image) {
            if (! $image) {
                continue;
            }

            $order++;
            $imageName = Str::slug($car->brand.'-'.$car->model).'-'.Str::random(10).'.'.$image->extension();
            $stored = $image->storeAs('images/cars', $imageName);
            $publicPath = '/'.$stored;

            $car->images()->create([
                'path' => $publicPath,
                'sort_order' => $order,
            ]);

            $paths[] = $publicPath;
        }

        return $paths;
    }

    private function deleteStoredImage(?string $path): void
    {
        if (! $path) {
            return;
        }

        Storage::disk('local')->delete('images/cars/'.basename($path));
    }
}
