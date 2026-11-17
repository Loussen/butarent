<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();

            $table->unique(['brand_id', 'name']);
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->foreignId('brand_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->foreignId('car_model_id')->nullable()->after('brand_id')->constrained('car_models')->nullOnDelete();
        });

        $cars = DB::table('cars')->select('id', 'brand', 'model')->get();
        foreach ($cars as $car) {
            $brandName = trim((string) $car->brand);
            $modelName = trim((string) $car->model);
            if ($brandName === '') {
                continue;
            }

            $brandId = DB::table('brands')->where('name', $brandName)->value('id');
            if (! $brandId) {
                $brandId = DB::table('brands')->insertGetId([
                    'name' => $brandName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $modelId = null;
            if ($modelName !== '') {
                $modelId = DB::table('car_models')
                    ->where('brand_id', $brandId)
                    ->where('name', $modelName)
                    ->value('id');

                if (! $modelId) {
                    $modelId = DB::table('car_models')->insertGetId([
                        'brand_id' => $brandId,
                        'name' => $modelName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            DB::table('cars')->where('id', $car->id)->update([
                'brand_id' => $brandId,
                'car_model_id' => $modelId,
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropConstrainedForeignId('car_model_id');
            $table->dropConstrainedForeignId('brand_id');
        });

        Schema::dropIfExists('car_models');
        Schema::dropIfExists('brands');
    }
};
