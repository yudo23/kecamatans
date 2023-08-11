<?php

namespace App\Helpers;

use App\Models\Page;
use Illuminate\Support\Str;

class SlugHelper
{
    public static function generate($model = Page::class, $title, $field)
    {

        $slug = Str::slug($title);
        $duplikat = true;
        do {
            $existSlug = new $model;
            $existSlug = $existSlug->where($field, $slug);
            $existSlug = $existSlug->first();

            if ($existSlug) {
                $slug = Str::slug($title) . "-" . rand();
                $duplikat = false;
            } else {
                $duplikat = true;
            }
        } while ($duplikat != true);

        return $slug;
    }
}
