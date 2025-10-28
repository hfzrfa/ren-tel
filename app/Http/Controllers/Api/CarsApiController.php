<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarsApiController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['pickup','pickup_date','pickup_time','return_date','return_time','type','seats','max_price']);
        $cars = Car::query()->search($filters)->orderBy('price_per_day')->paginate(12);

        return response()->json($cars);
    }
}
