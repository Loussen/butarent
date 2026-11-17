<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'slug',
        'title_az',
        'title_en',
        'title_ru',
        'body_az',
        'body_en',
        'body_ru',
    ];

    public function title(?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();
        $value = $this->{'title_'.$locale} ?? null;

        return $value ?: ($this->title_en ?: $this->title_az);
    }

    public function body(?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();
        $value = $this->{'body_'.$locale} ?? null;

        return $value ?: ($this->body_en ?: $this->body_az ?: '');
    }

    public static function findBySlug(string $slug): ?self
    {
        return static::query()->where('slug', $slug)->first();
    }
}
