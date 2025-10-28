<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
