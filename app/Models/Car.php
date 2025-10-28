<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'transmission',
        'seats',
        'price_per_day',
        'location',
        'is_available',
        'image_url',
        'image_path',
        'features'
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price_per_day' => 'decimal:2',
        'features' => 'array',
    ];

    protected static function booted(): void
    {
        // Auto-generate a unique slug from the name if none provided
        static::creating(function (Car $car) {
            if (empty($car->slug) && !empty($car->name)) {
                $car->slug = static::generateUniqueSlug($car->name);
            }
        });

        // If slug is empty on update (rare), regenerate from current name
        static::updating(function (Car $car) {
            if (empty($car->slug) && !empty($car->name)) {
                $car->slug = static::generateUniqueSlug($car->name, $car->id);
            }
        });
    }

    protected static function generateUniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = Str::slug($base);
        if ($slug === '') {
            // Fallback if name cannot be slugged (e.g., non-Latin only)
            $slug = 'car';
        }

        $original = $slug;
        $i = 2;

        while (static::query()
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()
        ) {
            $slug = $original . '-' . $i;
            $i++;
        }

        return $slug;
    }

    public function scopeSearch($query, array $filters)
    {
        return $query
            ->when($filters['pickup'] ?? null, function ($q, $v) {
                $q->where('location', 'like', "%" . $v . "%");
            })
            ->when($filters['type'] ?? null, function ($q, $v) {
                $q->where('type', $v);
            })
            ->when($filters['seats'] ?? null, function ($q, $v) {
                $q->where('seats', '>=', (int) $v);
            })
            ->when($filters['max_price'] ?? null, function ($q, $v) {
                $q->where('price_per_day', '<=', (float) $v);
            })
            ->when($filters['available'] ?? null, function ($q, $v) {
                if ($v) $q->where('is_available', true);
            });
    }
}
