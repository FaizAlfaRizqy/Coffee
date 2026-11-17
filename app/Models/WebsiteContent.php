<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteContent extends Model
{
    protected $fillable = [
        'section',
        'key',
        'value',
    ];

    public static function get(string $section, string $key, ?string $default = null): ?string
    {
        $content = static::where('section', $section)->where('key', $key)->first();
        return $content ? $content->value : $default;
    }

    public static function set(string $section, string $key, ?string $value): static
    {
        return static::updateOrCreate(
            ['section' => $section, 'key' => $key],
            ['value' => $value]
        );
    }
}
