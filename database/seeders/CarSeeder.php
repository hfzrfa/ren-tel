<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [];

        foreach ($cars as $c) {
            Car::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                array_merge($c, ['is_available' => true, 'features' => ['ac' => true, 'bluetooth' => true]])
            );
        }
    }
}
