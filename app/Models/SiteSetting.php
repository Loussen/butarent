<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'group',
        'type',
        'label',
        'sort_order',
        'value_az',
        'value_en',
        'value_ru',
    ];

    public static function getValue(string $key, ?string $default = null): ?string
    {
        $settings = static::cached();
        $row = $settings[$key] ?? null;

        if (! $row) {
            return $default;
        }

        $locale = app()->getLocale();
        $column = 'value_'.$locale;
        $value = $row[$column] ?? null;

        if ($value === null || $value === '') {
            $value = $row['value_en'] ?? $row['value_az'] ?? null;
        }

        return ($value === null || $value === '') ? $default : $value;
    }

    public static function cached(): array
    {
        return Cache::rememberForever('site_settings', function () {
            return static::query()
                ->orderBy('sort_order')
                ->get()
                ->keyBy('key')
                ->map(fn (self $s) => $s->only([
                    'key', 'group', 'type', 'label', 'sort_order',
                    'value_az', 'value_en', 'value_ru',
                ]))
                ->all();
        });
    }

    public static function clearCache(): void
    {
        Cache::forget('site_settings');
    }

    protected static function booted(): void
    {
        static::saved(fn () => static::clearCache());
        static::deleted(fn () => static::clearCache());
    }
}
