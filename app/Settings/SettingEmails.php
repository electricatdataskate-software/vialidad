<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SettingEmails extends Settings
{

    public static function group(): string
    {
        return 'Notifications';
    }
}