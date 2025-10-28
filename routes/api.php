<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarsApiController;

Route::get('/cars', [CarsApiController::class, 'index']);
