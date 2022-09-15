<?php

namespace App\Helpers;
use Illuminate\Support\Str;
class SlugGenerator {

    public static function generateSlug(): string
    {
        $rand = base64_encode(random_bytes(12));
        $milliseconds = round(microtime(true) * 1000);

        return  Str::slug($milliseconds.$rand);
    }

}
