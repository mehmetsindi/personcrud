<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class UpdateHelper
{
    public static function setUpdate($model, $data)
    {
        $updatable = array_keys($model->fillFields());

        $data = array_filter($data, fn($value) => !is_null($value) || !empty($value));

        $data = array_keys($data ?? []);

        $data = explode(',', array_reduce($data, function ($a, $b) {
            return rtrim(Str::snake($b) . ',' . $a, ",");
        }));

        $data = array_diff($data, $model->getGuarded());
        $data = array_intersect($data, $updatable);

        return array_values($data);
    }

}
