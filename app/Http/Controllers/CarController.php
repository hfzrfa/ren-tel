<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['pickup','pickup_date','pickup_time','return_date','return_time','type','seats','max_price']);

        $types = Car::query()
            ->where('is_available', true)
            ->whereNotNull('type')
            ->distinct()
            ->orderBy('type')
            ->pluck('type');

        // For now, we ignore date availability constraints; could be enhanced with reservation overlaps check.
        $cars = Car::query()
            ->where('is_available', true)
            ->search($filters)
            ->orderBy('price_per_day')
            ->limit(30)
            ->get();

        return view('welcome', [
            'cars' => $cars,
            'filters' => $filters,
            'types' => $types,
        ]);
    }

    public function all(Request $request)
    {
        $filters = $request->only(['pickup','pickup_date','pickup_time','return_date','return_time','type','seats','max_price']);

        $types = Car::query()
            ->where('is_available', true)
            ->whereNotNull('type')
            ->distinct()
            ->orderBy('type')
            ->pluck('type');

        $cars = Car::query()
            ->where('is_available', true)
            ->search($filters)
            ->orderBy('price_per_day')
            ->paginate(12)
            ->withQueryString();

        return view('cars.index', [
            'cars' => $cars,
            'filters' => $filters,
            'types' => $types,
        ]);
    }
}
