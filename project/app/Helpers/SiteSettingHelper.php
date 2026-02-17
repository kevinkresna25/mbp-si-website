<?php

use App\Models\SiteSetting;

if (!function_exists('site_setting')) {
    /**
     * Get a site setting value by key.
     */
    function site_setting(string $key, ?string $default = null): ?string
    {
        $settings = SiteSetting::allCached();

        return $settings[$key] ?? $default;
    }
}
