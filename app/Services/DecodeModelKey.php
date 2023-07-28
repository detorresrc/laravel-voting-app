<?php

namespace App\Services;

use Illuminate\Support\Facades\App;

class DecodeModelKey
{
    public static function decode($value)
    {
        if (ctype_digit($value) || is_int($value)) {
            try {
                return App::make('fakeid')->decode((int) $value);
            } catch (\Exception $e) {}
        }

        return false;
    }
}
