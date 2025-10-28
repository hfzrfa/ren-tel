<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create()
    {
        $cars = Car::query()->orderBy('name')->get(['id','name']);

        return view('book', [
            'cars' => $cars,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => ['required','exists:cars,id'],
            'pickup_date' => ['required','date','after_or_equal:today'],
            'pickup_time' => ['required','date_format:H:i'],
            'return_date' => ['required','date','after_or_equal:pickup_date'],
            'return_time' => ['required','date_format:H:i'],
            'pickup_method' => ['required','in:self_pickup,delivery'],
            'delivery_address' => ['nullable','string','required_if:pickup_method,delivery','max:255'],
            'full_name' => ['required','string','max:255'],
            'email' => ['required','email'],
            'phone' => ['nullable','string','max:50'],
            'pickup_location' => ['required','string','max:255'],
        ]);

        $user = Auth::user();

        $reservation = Reservation::create([
            'car_id' => $validated['car_id'],
            'user_id' => Auth::id(),
            // For security, always use authenticated user's name/email rather than trusting form values
            'full_name' => $user?->name ?? $validated['full_name'],
            'email' => $user?->email ?? $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'pickup_location' => $validated['pickup_location'],
            'pickup_date' => $validated['pickup_date'],
            'pickup_time' => $validated['pickup_time'],
            'pickup_method' => $validated['pickup_method'],
            'delivery_address' => $validated['delivery_address'] ?? null,
            'return_date' => $validated['return_date'],
            'return_time' => $validated['return_time'],
            'status' => 'pending',
        ]);

        return redirect()->route('booking.success')->with('reservation_id', $reservation->id);
    }

    public function success()
    {
        $id = session('reservation_id');
        return view('book-success', ['reservationId' => $id]);
    }
}
