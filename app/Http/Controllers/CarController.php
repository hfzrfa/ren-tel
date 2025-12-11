<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['pickup','pickup_date','pickup_time','return_date','return_time','type','seats','max_price']);

        // For now, we ignore date availability constraints; could be enhanced with reservation overlaps check.
        $cars = Car::query()
            ->search($filters)
            ->orderBy('price_per_day')
            ->limit(30)
            ->get();

        return view('welcome', [
            'cars' => $cars,
            'filters' => $filters,
        ]);
    }

    public function all(Request $request)
    {
        $filters = $request->only(['pickup','pickup_date','pickup_time','return_date','return_time','type','seats','max_price']);

        $cars = Car::query()
            ->search($filters)
            ->orderBy('price_per_day')
            ->paginate(12)
            ->withQueryString();

        return view('cars.index', [
            'cars' => $cars,
            'filters' => $filters,
        ]);
    }
}
