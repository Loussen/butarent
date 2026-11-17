<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Car extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::saving(function (Car $car) {
            $base = Str::slug(trim($car->brand.' '.$car->model)) ?: 'car';
            $slug = $base;
            $i = 2;
            while (static::where('slug', $slug)->when($car->exists, fn ($q) => $q->where('id', '!=', $car->id))->exists()) {
                $slug = $base.'-'.$i;
                $i++;
            }
            $car->slug = $slug;
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('slug', $value)
            ->orWhere('id', $value)
            ->firstOrFail();
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function insurance()
    {
        return $this->hasOne(Insurance::class);
    }

    public function brandRelation(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(CarImage::class)->orderBy('sort_order');
    }

    public function brandName(): string
    {
        return $this->brandRelation?->name
            ?? (string) ($this->attributes['brand'] ?? '');
    }

    public function modelName(): string
    {
        return $this->carModel?->name
            ?? (string) ($this->attributes['model'] ?? '');
    }

    public function assignBrandAndModel(Brand $brand, CarModel $carModel): void
    {
        $this->brand_id = $brand->id;
        $this->car_model_id = $carModel->id;
        $this->brand = $brand->name;
        $this->model = $carModel->name;
    }

    public function coverPath(): string
    {
        if ($this->image) {
            return $this->image;
        }

        $first = $this->relationLoaded('images')
            ? $this->images->first()
            : $this->images()->first();

        return $first?->path ?? '/images/home car.png';
    }

    public function galleryPaths(): array
    {
        $paths = $this->images->pluck('path')->filter()->values()->all();

        if ($this->image && ! in_array($this->image, $paths, true)) {
            array_unshift($paths, $this->image);
        }

        return $paths;
    }

    public function localizedDescription(): ?string
    {
        $locale = app()->getLocale();
        $fields = array_unique([
            'description_'.$locale,
            'description_az',
            'description_en',
            'description_ru',
        ]);

        foreach ($fields as $field) {
            if (! empty($this->{$field})) {
                return $this->{$field};
            }
        }

        return null;
    }
}
