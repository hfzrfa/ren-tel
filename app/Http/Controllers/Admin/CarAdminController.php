<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CarAdminController extends Controller
{
    public function index(Request $request)
    {
        $cars = Car::query()->orderByDesc('created_at')->paginate(15);
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:sedan,suv,luxury,ev,van,pickup',
            'transmission' => 'required|in:automatic,manual',
            'seats' => 'required|integer|min:2|max:9',
            'price_per_day' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'is_available' => 'nullable|boolean',
            'image_url' => 'nullable|url',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_available'] = (bool)($data['is_available'] ?? false);
        Car::create($data);

        return redirect()->route('admin.cars.index')->with('status', 'Car created');
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:sedan,suv,luxury,ev,van,pickup',
            'transmission' => 'required|in:automatic,manual',
            'seats' => 'required|integer|min:2|max:9',
            'price_per_day' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'is_available' => 'nullable|boolean',
            'image_url' => 'nullable|url',
        ]);
        $data['slug'] = Str::slug($data['name']);
        $data['is_available'] = (bool)($data['is_available'] ?? false);
        $car->update($data);
        return redirect()->route('admin.cars.index')->with('status', 'Car updated');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index')->with('status', 'Car deleted');
    }
}
