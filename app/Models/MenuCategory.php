<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sort_order',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(MenuProduct::class)->orderBy('sort_order', 'asc');
    }

    public function availableProducts(): HasMany
    {
        return $this->hasMany(MenuProduct::class)
            ->where('is_available', true)
            ->orderBy('sort_order', 'asc');
    }
}
