<?php

use App\Models\Car;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('model');
        });

        Car::query()->orderBy('id')->each(function (Car $car) {
            $base = Str::slug(trim($car->brand.' '.$car->model)) ?: 'car-'.$car->id;
            $slug = $base;
            $i = 2;
            while (Car::where('slug', $slug)->where('id', '!=', $car->id)->exists()) {
                $slug = $base.'-'.$i;
                $i++;
            }
            $car->forceFill(['slug' => $slug])->saveQuietly();
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
