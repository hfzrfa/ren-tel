<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property-read int $days Number of rental days
 * @property-read float $computed_total_price Calculated total price (price_per_day × days)
 */
class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id', 'user_id', 'full_name', 'email', 'phone',
        'pickup_location', 'pickup_date', 'pickup_time',
        'pickup_method', 'delivery_address',
        'return_date', 'return_time', 'status', 'total_price', 'extras'
    ];

    protected $casts = [
        'pickup_date' => 'date',
        'return_date' => 'date',
        'extras' => 'array',
        'total_price' => 'decimal:2',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * Number of rental days (minimum 1 day).
     */
    public function getDaysAttribute(): int
    {
        try {
            $start = $this->pickup_date instanceof Carbon ? $this->pickup_date : Carbon::parse($this->pickup_date);
            $end = $this->return_date instanceof Carbon ? $this->return_date : Carbon::parse($this->return_date);
        } catch (\Throwable $e) {
            return 1;
        }

        $days = $start && $end ? $start->diffInDays($end) : 0;
        return max(1, (int) $days);
    }

    /**
     * Computed total price based on car price_per_day × days.
     */
    public function getComputedTotalPriceAttribute(): float
    {
        $pricePerDay = (float) ($this->car->price_per_day ?? 0);
        return (float) ($pricePerDay * $this->days);
    }
}
