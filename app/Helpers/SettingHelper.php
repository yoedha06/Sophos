<?php

namespace App\Helpers;

use App\Models\Setting;

class SettingHelper
{
    public static function data()
    {
        return cache()->rememberForever('settings', fn () => new Setting());
    }

    public static function clearCache()
    {
        cache()->forget('settings');
    }

    public static function setByKey($key, $value)
    {
        Setting::updateOrCreate(['key' => $key], ['value' => $value]);

        self::clearCache();
    }
}
