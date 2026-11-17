<?php

use App\Models\SiteSetting;

if (! function_exists('setting')) {
    function setting(string $key, ?string $default = null): ?string
    {
        try {
            return SiteSetting::getValue($key, $default);
        } catch (\Throwable $e) {
            return $default;
        }
    }
}
