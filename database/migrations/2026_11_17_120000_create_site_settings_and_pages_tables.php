<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('group')->index();
            $table->string('type')->default('text'); // text, textarea, number, image, url
            $table->string('label');
            $table->unsignedInteger('sort_order')->default(0);
            $table->text('value_az')->nullable();
            $table->text('value_en')->nullable();
            $table->text('value_ru')->nullable();
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_az');
            $table->string('title_en');
            $table->string('title_ru');
            $table->longText('body_az')->nullable();
            $table->longText('body_en')->nullable();
            $table->longText('body_ru')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
        Schema::dropIfExists('site_settings');
    }
};
